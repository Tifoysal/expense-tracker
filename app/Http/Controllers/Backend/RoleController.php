<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use notify;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        if ($search) {
            $roles = Role::orderBy('id','desc')->whereLike(['name'],$search)->paginate('15');
            return view('backend.role.index',compact('roles'));
        }
        $roles = Role::orderBy('id','desc')->paginate('15');
        return view('backend.role.index',compact('roles'));
    }

    public function create()
    {
        $modules = Module::with('permissions')->get();
        return view('backend.role.create',compact('modules'));
    }

    public function store(Request  $request): RedirectResponse
    {
         $request->validate([
                'name' => 'required|unique:roles,name'
            ]);

        try {

            $role =  Role::create([
                'name'=>$request->name,
                'slug'=> Str::slug($request->name),
            ]);

            $role->permissions()->sync($request->permission_ids);

            notify()->success('Role successfully added');
            return redirect()->route('role.list');
        }catch (\Throwable $throwable){
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $modules = Module::with('permissions')->get();
        return view('backend.role.edit',compact('role','modules'));
    }

    public function update(Request $request,$id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id
        ]);

        $role = Role::where('id',$id)->first();

        if(!$role){
            notify()->warning('data not found');
            return redirect()->back();
        }

        $role->update([
            'name'=>$request->name,
            'slug'=> Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->permission_ids);

        notify()->success('Role successfully updated');
        return redirect()->route('role.list');
    }

    public function delete($id): RedirectResponse
    {
        try{
            $role = Role::where('id',$id)->where('id', '!=', 1)->first();

            if(!$role){
                notify()->warning('You can not delete this role');
                return redirect()->back();
            }
            $role->delete();
            notify()->success('Role successfully deleted');
            return redirect()->back();

        }catch(\Throwable $throwable){
            if($throwable->getCode() == 23000){
            notify()->warning('Sorry ! You cannot delete.');
           }
            return redirect()->back();
        }
    }
}
