<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use DataTables;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $review_details = Review::select('*')->with('ServiceName');

            if ($search) {
                $review_details->Where('name', 'like', '%' . "$search" . '%')
                    ->orWhere('service', 'like', '%' . "$search" . '%')
                    ->orWhere('discription', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $review_details->orderBy($sortColumn, $sortOrder);

            $data = $review_details->paginate($perPage);

            $data->transform(function ($item) {
                $item->service_name = $item->ServiceName->service_name ?? 'Service not found';
                unset($item->ServiceName);
                return $item;
            });

            return response()->json($data);

        }

        return view('admin.review.index');

    }

    public function create()
    {
        $services = Service::select('*')->get();
        return view('admin.review.create',compact('services'));
    }

    public function store(Request $request)
    {
        try{
            $validateArray = [
                'review_name' => 'required|string',
                'service_id' => 'required|integer',
                'review_discription' => 'required|string',
            ];
            $validateMessage = [
              'review_name.required' => 'Please enter Name.',
              'service_id.required' => 'Please Select Service.',
              'review_discription.required' => 'Please enter Discription.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $create = [
                  'name' => $request->review_name,
                  'service' => $request->service_id,
                  'description' => $request->review_discription,
              ];
              $review = Review::create($create);
              if($review){
                DB::commit();
                return redirect('admin/review/')->with('success','New Review created successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("ReviewController (store) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($review)
    {
        $review = Review::findOrFail($review);
        $services = Service::all();
        return view('admin.review.create',compact('review','services'));
    }

    public function update(Request $request)
    {
        try{
            $validateArray = [
                'review_name' => 'required|string',
                'service_id' => 'required|integer',
                'review_discription' => 'required|string',
            ];
            $validateMessage = [
              'review_name.required' => 'Please enter Name.',
              'service_id.required' => 'Please Select Service.',
              'review_discription.required' => 'Please enter Discription.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
              return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
              DB::beginTransaction();
              $update = [
                  'name' => $request->review_name,
                  'service' => $request->service_id,
                  'description' => $request->review_discription,
              ];
              $review = Review::findOrFail($request->review_id);
              $review->update($update);
              if($review){
                DB::commit();
                return redirect('admin/review/')->with('success','Review Updated successfully');
              }
            }
        }catch (\Exception $e){
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("ReviewController (edit) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($review)
    {
        $review = Review::findOrFail($review);
        $review->delete();

        return $review;
    }
}
