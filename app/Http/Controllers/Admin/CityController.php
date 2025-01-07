<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $city_details = City::query();

            if ($search) {
                $city_details->Where('state', 'like', '%' . "$search" . '%')
                    ->orWhere('city', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $city_details->orderBy($sortColumn, $sortOrder);

            $data = $city_details->with('stateName')->paginate($perPage);

            $data->transform(function ($item) {
                $item->state_name = $item->stateName->state  ?? 'City not found';
                unset($item->stateName);
                return $item;
            });

            return response()->json($data);

        }

        return view('admin.city.index');

    }

    public function create()
    {
        $states = State::select('*')->get();
        return view('admin.city.create',compact('states'));
    }

    public function store(Request $request)
    {
        try{
            $validateArray = [
                'city_name' => 'required',
                'city_state' => 'required',
            ];
            $validateMessage = [
              'city_name.required' => 'Please enter City.',
              'city_state.required' => 'Please enter State.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $create = [
                  'city' => $request->city_name,
                  'state' => $request->city_state,
              ];
              $city = City::create($create);
              if($city){
                DB::commit();
                return redirect('admin/city/')->with('success','New city created successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("StateController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($city)
    {
        $city = City::findOrFail($city);
        $states = State::select('*')->get();
        return view('admin.city.create',compact('city','states'));
    }

    public function update(Request $request)
    {
        try{
            $validateArray = [
                'city_name' => 'required',
                'city_state' => 'required',
            ];
            $validateMessage = [
              'city_name.required' => 'Please enter City.',
              'city_state.required' => 'Please enter State.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $update = [
                  'city' => $request->city_name,
                  'state' => $request->city_state,
              ];
              $city = City::findOrFail($request->city_id);
              $city->update($update);
              if($city){
                DB::commit();
                return redirect('admin/city/')->with('success','city Updated successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("StateController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }

    }

    public function delete($city)
    {
        $city = City::findOrFail($city);
        $city->delete();

        return $city;
    }
}
