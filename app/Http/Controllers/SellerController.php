<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function Index()
    {
        return view('seller.seller_login');
        //end method
    }


    public function Dashboard()
    {
        return view('seller.index');
        // end method
    }


    public function Login(Request $request)
    {
        // dd($request->all());
        $check = $request->all();
        if (Auth::guard('seller')->attempt(['email' => $check['email'], 'password' 
            => $check['password'] ])){
                return redirect()->route('seller.dashboard')->with('error', 'Seller Login Successfully');
            }else{
                return back()->with('error', 'Invalid Email Or Password');
            }
    }// end 
    
    public function SellerLogout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login.form')->with('error', 'Seller Logout Successfully');

    }//end method


    public function SellerRegister()
    {
        return view('seller.seller_register');
    }//end method


    public function SellerRegisterCreate(Request $request)
    {
        // dd($request->all());
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),

        ]);

        return redirect()->route('login.form')->with('error', 'Seller Created Successfully');

    }// end method
}
