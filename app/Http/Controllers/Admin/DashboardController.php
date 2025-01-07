<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use App\Models\Customers;
use Carbon\Carbon;
use DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $perPage = $request->input('per_page', 10);
            $sortColumn = $request->input('sort_column', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $search = $request->input('search');

            $today = Carbon::today()->format('Y-m-d');
            $user_details = Customers::whereDate('created_at', $today)->with('service');

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
                unset($item->service);
                return $item;
            });

            return response()->json($data);
        }

        $user = Customers::latest()->get();
        $totaluser = $user->count();

        $today = Carbon::today()->format('Y-m-d');
        $userCountToday = Customers::whereDate('created_at', $today)->count();
        $contactCount = ContactMessage::get()->count();
        $contactCountToday = ContactMessage::whereDate('created_at', $today)->count();

        return view('admin.dashboard.index', compact('totaluser', 'userCountToday', 'contactCountToday', 'contactCount'));
    }

    public function getServiceName($user)
    {
        $service = $user->services;
        if($service == 1){
            $services = 'test';
        }elseif($service == 2){
            $services = 'test2';
        }
        return $services;
    }


     // this is for customer
     public function usercontact(Request $request)
     {
         if ($request->ajax()) {

            $contact = ContactMessage::get();

             return Datatables::of($contact)
                 ->addColumn('id', function ($contact) {
                     return $contact->id;
                 })
                 ->addColumn('name', function ($contact) {
                     return $contact->name;
                 })
                 ->addColumn('tel', function ($contact) {
                     return $contact->tel;
                 })
                 ->addColumn('email', function ($contact) {
                     return $contact->email;
                 })
                 ->addColumn('message', function ($contact) {
                     return $contact->message;
                 })
                 ->toJson();
         }

         return view('loan_haii_admin.usercontact');
     }
}
