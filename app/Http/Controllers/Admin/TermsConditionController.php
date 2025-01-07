<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TermsCondition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DataTables;

class TermsConditionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $tearms_details = TermsCondition::select('*');

            if ($search) {
                $tearms_details->Where('description', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $tearms_details->orderBy($sortColumn, $sortOrder);

            $data = $tearms_details->paginate($perPage);

            return response()->json($data);

        }

        return view('admin.tearms.index');

    }

    public function edit()
    {
        $termscondtion = TermsCondition::first();
        return view('admin.tearms.create',compact('termscondtion'));
    }

    public function update(Request $request)
    {
        try{
            $validateArray = [
                'tearms_description' => 'required|string',
            ];
            $validateMessage = [
              'tearms_description.required' => 'Please enter Discription.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $update = [
                  'description' => $request->tearms_description,
              ];
              $TermsCondition = TermsCondition::findOrFail($request->termscondtion_id);
              $TermsCondition->update($update);
              if($TermsCondition){
                DB::commit();
                return redirect('admin/termscondition/')->with('success','TermsCondition Updated successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("TermsConditionController (edit) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    function showFrontend(){
        $termscondtion = TermsCondition::first();
        return view('frontend.tearmsconditionview', compact('termscondtion'));
    }

}
