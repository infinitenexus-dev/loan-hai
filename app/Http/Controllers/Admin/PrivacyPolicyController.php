<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $privacy_details = PrivacyPolicy::select('*');

            if ($search) {
                $review_details->Where('description', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $privacy_details->orderBy($sortColumn, $sortOrder);

            $data = $privacy_details->paginate($perPage);

            return response()->json($data);

        }

        return view('admin.privacy.index');

    }


    public function edit()
    {
        $pivacypolicy = PrivacyPolicy::first();
        return view('admin.privacy.create',compact('pivacypolicy'));
    }

    public function update(Request $request)
    {
        try{
            $validateArray = [
                'privacypolicy_description' => 'required|string',
            ];
            $validateMessage = [
              'privacypolicy_description.required' => 'Please enter Discription.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $update = [
                  'description' => $request->privacypolicy_description,
              ];
              $Pivacypolicy = PrivacyPolicy::findOrFail($request->privacypolicy_id);
              $Pivacypolicy->update($update);
              if($Pivacypolicy){
                DB::commit();
                return redirect('admin/privacypolicy/')->with('success','PrivacyPolicy Updated successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("PrivacyPolicyController (edit) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function showFrontend(){
        $pivacypolicy = PrivacyPolicy::first();
        return view('frontend.pivacypolicyview', compact('pivacypolicy'));
    }

}