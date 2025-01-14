<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $user_details = Customers::select('*')->with('service')->with('cities')->latest();

            if ($search) {
                $user_details->Where('name', 'like', '%' . "$search" . '%')
                    ->orWhere('tel', 'like', '%' . "$search" . '%')
                    ->orWhere('age', 'like', '%' . "$search" . '%')
                    ->orWhere('email', 'like', '%' . "$search" . '%')
                    ->orWhere('income', 'like', '%' . "$search" . '%')
                    ->orWhere('services', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $user_details->orderBy($sortColumn, $sortOrder);

            $data = $user_details->paginate($perPage);

            $data->transform(function ($item) {
                $item->service_name = $item->service->service_name ?? 'Service not found';
                $item->cities = $item->cities->city ?? 'City not found';
                unset($item->service);
                unset($item->city);
                return $item;
            });

            return response()->json($data);
        }

        return view('admin.customer.index');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name' => 'required|string',
                'tel' => 'required|digits:10',
                'age' => 'required|integer|min:18',
                'email' => 'required|email',
                'income' => 'required|integer',
                'services' => 'required|integer',
                'city' => 'required|integer',
            ], [
                'name.required' => 'Please enter your full name.',
                'tel.required' => 'Please enter your mobile number.',
                'tel.digits' => 'The mobile number must be 10 digits.',
                'age.required' => 'Please enter your age.',
                'age.integer' => 'Age must be a valid integer.',
                'age.max' => 'The Minimum allowed age is 18.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email address.',
                'income.required' => 'Please enter your monthly income.',
                'income.integer' => 'Income must be a valid integer.',
                'services.required' => 'Please select a service.',
                'services.integer' => 'Service selection must be a valid integer.',
                'city.required' => 'Please select a city.',
                'city.integer' => 'City selection must be a valid integer.',
            ]);

            $customer = Customers::create($validatedData);
            if ($customer) {
                DB::commit();
                return response()->json(['message' => 'Data saved successfully']);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['errors' => $errors], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function delete($customer)
    {
        $customer = Customers::findOrFail($customer);
        $customer->delete();

        return $customer;
    }

    public function edit($customer)
    {
        $agent = Agent::select('*')->get();
        $statuses = [
            1 => 'Pending',
            2 => 'Document Verification',
            3 => 'Submit Agent',
            4 => 'Reject',
            5 => 'Complete'
        ];
        $customer = Customers::with('service')->with('cities')->findOrFail($customer);
        return view('admin.customer.create', compact('customer', 'agent', 'statuses'));
    }

    public function view($customer)
    {
        $agent = Agent::select('*')->get();
        $customer = Customers::with('service')->with('cities')->findOrFail($customer);
        return view('admin.customer.view', compact('customer','agent'));
    }


    public function update(Request $request)
    {
        try {
            $validateArray = [
                'status' => 'required|string',
            ];
            $validateMessage = [
                'status.required' => 'Please select status.',
            ];

            $validator = Validator::make($request->all(), $validateArray, $validateMessage);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            } else {
                DB::beginTransaction();

                $update = [
                    'loan_status' => $request->status,
                ];

                $customer = Customers::findOrFail($request->customer_id);

                if ($customer->reason_to_reject === null) {
                    $update['reason_to_reject'] = $request->reason;
                }
                if ($customer->loan_amount === null) {
                    $update['loan_amount'] = $request->amount;
                }
                if ($customer->assign_to === null) {
                    $update['assign_to'] = $request->agent;
                }
                if ($customer->expected_amount === null) {
                    $update['expected_amount'] = $request->expected_amount;
                }
                if ($request->hasfile('documents')) {
                    $fileNames = [];
                    foreach ($request->file('documents') as $file) {
                        $name = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/documents'), $name);
                        $fileNames[] = $name;
                    }
                    $update['documents'] = implode(',', $fileNames);
                }
                $customer = Customers::findOrFail($request->customer_id);
                $customer->update($update);
                if ($customer) {
                    DB::commit();
                    return redirect('admin/customers/')->with('success', 'Customer Updated successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            Log::error("ReviewController (edit) : ", ["Exception" => $bug, "\nTraceAsString" => $e->getTraceAsString()]);
            return redirect()->back()->with('error', $bug);
        }
    }
}
