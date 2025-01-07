<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 
class ChangePasswordController extends Controller
{
    public function changePassword()
    {
        return view('auth.change-password');
    }
 
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        Auth::logout();

        return redirect()->back();
    }
}