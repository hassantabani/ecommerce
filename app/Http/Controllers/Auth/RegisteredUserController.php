<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'username'=>'required|string|max:255',
            'phone_number' => 'required|max:11|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'nic_number' => 'required|min:8|unique:users',
            'nic_front_image' => 'required|image|mimes:jpeg,png,jpg',
            'nic_back_image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $frontname = rand(00000,99999).'.'.$request->nic_front_image->extension();
        $Frontfile = $request->nic_front_image->storeAs('nic',$frontname,'public');
        $front = 'storage/'.$Frontfile;

        $backname = rand(00000,99999).'.'.$request->nic_back_image->extension();
        $Backfile = $request->nic_back_image->storeAs('nic',$backname,'public');
        $back = 'storage/'.$Backfile;

        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'phone_number' => $request->phone_number,
            'nic_number' =>$request->nic_number,
            'nic_front_image' => $front,
            'nic_back_image' => $back,
            'password' => Hash::make($request->password),
            'user_type' => 'user'
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        return redirect()->back()->with('success','Account Created. Wait for Approval');
    }
}
