<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $user_details = Service::select('*');

            if ($search) {
                $user_details->Where('service_name', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $user_details->orderBy($sortColumn, $sortOrder);

            $data = $user_details->paginate($perPage);

            return response()->json($data);

        }

        return view('admin.service.index');
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {

        try{
            $validateArray = [
              'service_name' => 'required',
            ];
            $validateMessage = [
              'service_name.required' => 'Please enter service name.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $create = [
                  'service_name' => $request->service_name
              ];
              $service = Service::create($create);
              if($service){
                DB::commit();
                return redirect('admin/services/')->with('success','New service created successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("ServiceController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }

    }

    public function edit($id)
    {
        $service = Service::where('id',$id)->first();
        return view('admin.service.create', compact('service'));
    }

    public function update(Request $request)
    {
        Service::where('id',$request->service_id)->update(["service_name"=>$request->service_name]);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function delete($id)
    {
       $service = Service::where('id',$id)->delete();
        return $service;
    }
}
