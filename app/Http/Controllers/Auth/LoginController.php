<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(["guest"]);
    }

    public function index(){
        return view('auth.login');
    }

    public function store(loginRequest $request){

        //register the user
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','Invalid User Login');
        }

        // redirect to the dashboard page
        return redirect()->route('dashboard');

    }
}
