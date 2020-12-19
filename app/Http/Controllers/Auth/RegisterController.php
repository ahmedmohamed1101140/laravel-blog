<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(["guest"]);
    }

    public function index(){
        return view('auth.register');
    }

    public function store(StoreUser $request){
        //pass validated data into data object and hash the password
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        //crete the user
        $user = User::create($data);
        //register the user
        auth()->attempt($request->only('email','password'));

        // redirect to the dashboard page
        return redirect()->route('dashboard');
    }
}
