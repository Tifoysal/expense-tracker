<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Domain_config;
use App\Models\Membership;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class UserController extends Controller
{
    public function list()
    {
        $search = request()->query('search');
        if ($search) {
            $users = User::orderBy('id', 'desc')
            ->whereLike(['name', 'email', 'phone'], $search)
            ->orWhereHas('role', function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
                    return view('backend.user.user_list', compact('users'));
        }
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('backend.user.user_list', compact('users'));
       
    }

    public function view($id)
    {
        $user = User::find($id);
        return view('backend.user.view', compact('user'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', '1')->get();

        return view('backend.user.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'required|unique:roles,name',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        try {

            $filename = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/users', $filename);
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'phone' => $request->phone,
                'image' => $filename,
            ]);
            notify()->success('user created.');
            return redirect()->route('user.list');
        } catch (Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('id', '!=', '1')->get();
        
        if ($user->role_id != 1) {
            return view('backend.user.edit', compact('user','roles'));
        } else {
            notify()->error('You can not edit super admin.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                notify()->warning('Data not found');
                return redirect()->back();
            }
            if ($user->role != 'super_admin') {

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('/users', $filename);
                    $user['image'] = $filename;
                }

                if ($user) {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'role_id' => $request->role_id,
                    ]);

                    notify()->success('user updated...');
                    return redirect()->route('user.list');
                } else {
                    notify()->error('You can not edit super admin.');
                    return redirect()->back();
                }
            }
        } catch (Throwable $th) {
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function block($id): RedirectResponse
    {
        $user = User::find($id);
        if ($user) {
            $user->update([
                'status'=>'inactive'
            ]);
            notify()->success('User blocked');
            return redirect()->back();
        } else {
            notify()->error('User not found.');
            return redirect()->back();
        }
    }

    public function unblock($id): RedirectResponse
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
           $user->update([
                'status'=>'active'
            ]);
            notify()->success('user restored');
            return redirect()->back();
        } else {
            notify()->error('user not found');
            return redirect()->back();
        }
    }
}
