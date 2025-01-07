<?php 

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $state_details = State::select('*');

            if ($search) {
                $state_details->Where('name', 'like', '%' . "$search" . '%')
                    ->orWhere('service', 'like', '%' . "$search" . '%')
                    ->orWhere('discription', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $state_details->orderBy($sortColumn, $sortOrder);

            $data = $state_details->paginate($perPage);

            return response()->json($data);

        }

        return view('admin.state.index');

    }

    public function create()
    {
        return view('admin.state.create');
    }

    public function store(Request $request)
    {
        try{
            $validateArray = [
                'state_name' => 'required|string',
            ];
            $validateMessage = [
              'state_name.required' => 'Please enter State.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $create = [
                  'state' => $request->state_name,
              ];
              $state = State::create($create);
              if($state){
                DB::commit();
                return redirect('admin/state/')->with('success','New State created successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("StateController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($state)
    {
        $state = State::findOrFail($state);
        return view('admin.state.create',compact('state'));
    }

    public function update(Request $request)
    {
        try{
            $validateArray = [
                'state_name' => 'required|string',
            ];
            $validateMessage = [
              'state_name.required' => 'Please enter State.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $update = [
                  'state' => $request->state_name,
              ];
              $state = State::findOrFail($request->state_id);
              $state->update($update);
              if($state){
                DB::commit();
                return redirect('admin/state/')->with('success','State Updated successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("StateController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($state)
    {
        $state = State::findOrFail($state);
        $state->delete();

        return $state;
    }
}
