<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show setting page
    public function showSetting(){
        return view('setting');
    }

    //change password
    public function changePassword(Request $request){
        $data = $request->validate([
                            'current_password' => ['required', 'string'],
                            'password' => ['required', 'string', 'min:8', 'confirmed'],
                        ]);

        $isValid = Hash::check($data['current_password'], auth()->user()->password);
        $result = 0;
        if($isValid){
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($data['password']);
            $result = $user->save();
        }
        else{
            $request->session()->flash('fail', 'Invalid current password');
            return redirect()->back();
        }

        if($result == 1){
            $request->session()->flash('success', 'Password has been changed successfully.');
        }
        else{
            $request->session()->flash('fail', 'Password has not been changed.');
        }

        return redirect()->back();
    }

    //change city
    public function changeCity(Request $request){
        $data = $request->validate(['city_name' => ['required', 'string']]);

        $user = User::find(auth()->user()->id);
        $user->city = $data['city_name'];
        $result = $user->save();
        if($result == 1){
            $request->session()->flash('success', 'City name has been changed');
        }
        else{
            $request->session()->flash('fail', 'City name has not been changed');
        }

        return redirect()->back();
    }
}
