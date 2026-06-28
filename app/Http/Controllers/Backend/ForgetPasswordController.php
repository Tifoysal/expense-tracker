<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\SendResetPasswordJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('backend.auth.forgetpassword');
    }

    public function forgetPasswordPost(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email'=>'required|exists:users'
        ]);
        try {
            $token=Str::random(40);
            $user=User::where('email',$request->email)->first();

            if ($user === null) {
                return redirect()->back();
            }
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();


            $link=route('admin.reset.password',$token);

            dispatch(new  SendResetPasswordJob($link,$tokenData->email));

            notify()->success('msg','Email sent to : '. $request->email);
            return redirect()->back();
        }catch (\Throwable $th)
        {
            notify()->error($th->getMessage());
        }
    }

    public function resetPassword($token)
    {
        $tokenVerify = DB::table('password_resets')->where('token', $token)->first();
        if ($tokenVerify === null) {
            notify()->error('Token not found.');
            return redirect()->route('admin.forget.password');
        }
        return view('backend.auth.reset-password',compact('token'));
    }

    public function resetPasswordPost(Request $request,$token)
    {
        $request->validate([
            'password'=>'required|confirmed',
        ]);

        //check token exist or not
        $tokenVerify=DB::table('password_resets')->where('token', $token)->first();

        if ($tokenVerify->token == $token) {
            $admin = User::where('email', $tokenVerify->email)->first();

            $admin->update([
                'password' => app('hash')->make($request->input('password')),
            ]);

            $tokenVerify = DB::table('password_resets')->where('email', $admin->email)->delete();
            notify()->success('Password updated successfully...!', 'message');
            return redirect()->route('login');
        }else{
            notify()->error('Token Expired.');
            return redirect()->back();
        }
    }
}
