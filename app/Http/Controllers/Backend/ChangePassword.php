<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class ChangePassword extends Controller
{
    public function changePassword()
    {
        return view('backend.auth.change-password');
    }

    public function changePasswordProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => ['required',new \App\Rules\ChangePassword()],
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required'
        ]);

        try {
            auth()->user()->update([
                'password' => bcrypt($request->input('password')),
            ]);
            auth()->logout();
            notify()->success('Password change successfully');

            return redirect()->route('login');
        } catch (Throwable $throwable) {
            notify()->warning($throwable->getMessage());

            return redirect()->back();
        }
    }
}
