<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $contact_details = ContactMessage::select('*');

            if ($search) {
                $contact_details->Where('name', 'like', '%' . "$search" . '%')
                    ->orWhere('email', 'like', '%' . "$search" . '%')
                    ->orWhere('message', 'like', '%' . "$search" . '%');
            }

            // Apply sorting
            $contact_details->orderBy($sortColumn, $sortOrder);

            $data = $contact_details->paginate($perPage);

            return response()->json($data);

        }

        return view('admin.contact.index');

    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'contact_name' => 'required|string',
                'contact_email' => 'required|email',
                'contact_message' => 'required|string',
            ], [
                'contact_name.required' => 'Please enter your full name.',
                'contact_email.required' => 'Please enter your email address.',
                'contact_email.email' => 'Please enter a valid email address.',
                'contact_message.required' => 'Please enter your message.',
            ]);

           $data = [
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'message' => $request->contact_message,
           ];

           $contact = ContactMessage::create($data);
            if($contact){
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
        $customers = ContactMessage::findOrFail($customer);
        $customers->delete();

        return $customers;
    }
}