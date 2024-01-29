<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile(){
        $id = Auth::user()->id;
        $user = User::select('name','email','phone','gender','address')->where('id', $id)->first();
        return view('admin.Profile.profile',compact('user'));
    }

    // profile update Btn
    public function updateBtn(Request $req){

        $this->validation($req);
        $inputData = $this->getData($req);

        User::where('id', Auth::user()->id)->update($inputData);
        return back()->with(['updateSuccess' => 'Successfully Updated!']);
    }

    //change Password Btn
    public function changePassBtn(){
        return view('admin.Profile.changePassword');
    }

    //update Password Btn
    public function updatePassBtn(Request $req){

        $this->PasswordValidation($req);

        $userId = Auth::user()->id;
        $userData = User::where('id', $userId)->first();
        $dataPassword = $userData->password;

        if(Hash::check($req->currentPassword, $dataPassword)){
            $newPassword = Hash::make($req->newPassword);
            User::where('id', $userId)->update([
                'password' => $newPassword
            ]);
            return redirect()->route('admin#profile');
        }

        else{
            return back()->with(['updateFail' => 'Incorrect Password!']);;
        }
    }

    //get data
    private function getData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
            'updated_at' => Carbon::now()
        ];
    }

    // profile validation
    private function validation($req){
        Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required'
        ])->validate();
    }

    // passowrd validation
    private function PasswordValidation($req){
        Validator::make($req->all(), [
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required:min:6',
            'confirmPassword' => 'required:min:6|same:newPassword'
        ])->validate();
    }

}
