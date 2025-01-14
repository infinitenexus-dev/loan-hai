<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\State;
use App\Models\City;
use App\Models\Service;
use DataTables;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $agent_details = Agent::query();

            if ($search) {
                $agent_details->Where('name', 'like', '%' . "$search" . '%')
                    ->orWhere('number', 'like', '%' . "$search" . '%')
                    ->orWhere('address', 'like', '%' . "$search" . '%')
                    ->orWhere('city', 'like', '%' . "$search" . '%')
                    ->orWhere('state', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $agent_details->orderBy($sortColumn, $sortOrder);

            $data = $agent_details->with('stateName')->with('cityName')->paginate($perPage);

            $data->transform(function ($item) {
                if ($item->stateName) {
                    $item->state_name = $item->stateName->state ?? 'State not found';
                    unset($item->stateName);
                } else {
                    $item->state_name = 'N/A';
                }

                if ($item->cityName) {
                    $item->city_name = $item->cityName->city ?? 'City not found';
                    unset($item->cityName);
                } else {
                    $item->city_name = 'N/A';
                }

                return $item;
            });

            return response()->json($data);
        }

        return view('admin.agents.index');
    }

    public function create(Request $request)
    {
        $stateId = $request->input('state_id');
        if ($stateId) {
            $cities = City::where('state', $stateId)->get();
            return response()->json($cities);
        }
        $states = State::select('*')->get();
        $services = Service::all();
        return view('admin.agents.create', compact('states', 'services'));
    }

    public function store(Request $request)
    {
        try {
            $validateArray = [
                'agent_name' => 'required|string',
                'agent_number' => 'required|integer',
                'agent_address' => 'required|string',
                'agent_city' => 'required|integer',
                'agent_state' => 'required|integer',
                'services' => 'required',
            ];
            $validateMessage = [
                'agent_name.required' => 'Please enter Name.',
                'agent_number.required' => 'Please enter Phone Numer.',
                'agent_address.required' => 'Please enter Address.',
                'agent_city.required' => 'Please enter City.',
                'agent_state.required' => 'Please enter State.',
                'services' => 'Please Select Service',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
                DB::beginTransaction();
                $fileNames = [];
                if ($request->hasfile('document')) {
                    foreach ($request->file('document') as $file) {
                        $name = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/agent/documents'), $name);
                        $fileNames[] = $name;
                    }
                }
                $create = [
                    'name' => $request->agent_name,
                    'number' => $request->agent_number,
                    'address' => $request->agent_address,
                    'city' => $request->agent_city,
                    'state' => $request->agent_state,
                    'services' => implode(',', $request->services),
                    'document' => implode(',', $fileNames),
                ];
                $agents = Agent::create($create);
                if ($agents) {
                    DB::commit();
                    return redirect('admin/agent/')->with('success', 'New Agent created successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("AgentController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit(Request $request, $agent)
    {
        $agent = Agent::findOrFail($agent);
        $states = State::all();
        $services = Service::all();
        $city = City::where('state', $agent->state)->get();
        $agentServices = $agent->services ? explode(',', $agent->services) : [];
        return view('admin.agents.create', compact('agent', 'city', 'states', 'agentServices', 'services'));
    }

    public function update(Request $request)
    {
        try {
            $validateArray = [
                'agent_name' => 'required|string',
                'agent_number' => 'required|integer',
                'agent_address' => 'required|string',
                'agent_city' => 'required|integer',
                'agent_state' => 'required|integer',
                'services' => 'required',
            ];
            $validateMessage = [
                'agent_name.required' => 'Please enter Name.',
                'agent_number.required' => 'Please enter Phone Numer.',
                'agent_address.required' => 'Please enter Address.',
                'agent_city.required' => 'Please enter City.',
                'agent_state.required' => 'Please enter State.',
                'services' => 'Please Select Service',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
                DB::beginTransaction();
                $update = [
                    'name' => $request->agent_name,
                    'number' => $request->agent_number,
                    'address' => $request->agent_address,
                    'city' => $request->agent_city,
                    'state' => $request->agent_state,
                    'services' => implode(',', $request->services),
                ];
                if ($request->hasfile('document')) {
                    $fileNames = [];
                    foreach ($request->file('document') as $file) {
                        $name = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/agent/documents'), $name);
                        $fileNames[] = $name;
                    }
                    $update['document'] = implode(',', $fileNames);
                }
                $agents = Agent::findOrFail($request->agent_id);
                $agents->update($update);
                if ($agents) {
                    DB::commit();
                    return redirect('admin/agent/')->with('success', 'Agent Updated successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("AgentController (edit) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($agents)
    {
        $Agents = Agent::findOrFail($agents);
        $Agents->delete();
        return $Agents;
    }
}
