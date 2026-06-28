<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerPurchase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Devfaysal\BangladeshGeocode\Models\Union;
use PHPOpenSourceSaver\JWTAuth\Claims\Custom;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class EnduserController extends Controller
{
    public function list()
    {
        if (\request()->query('search')) {
            $endusers = Customer::where('type', Customer::CUSTOMER)->where('first_name', 'Like', '%' . \request()->search . '%')->paginate(20);
        } else {
            $endusers = Customer::latest()->where('type',Customer::CUSTOMER)->paginate(20);
        }
        return view('backend.enduser.list', compact('endusers'));
    }

    public function create()
    {
        $divisions = Division::all();
        $role = Role::with('user')->where('name', 'employee')->first();
        return view('backend.enduser.create', compact('divisions', 'role'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'           => 'required|max:255',
            'last_name'            => 'required|max:255',
            'business_name'        => 'required|max:255',
            'email'                => 'required|unique:customers',
            'phone'                => 'required|digits:11|regex:/(01)[0-9]{9}/|unique:customers',
            'address'              => 'required',
            'trade_license_number' => 'required|unique:customers',
            'password'             => 'required|min:6',
        ]);

        // $role = Role::where('slug', 'enduser')->first();
        // if (!$role) {
        //     notify()->error("Role Is not exits");
        //     return redirect()->route('enduser.list');
        // }

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/customer', $image);
        }

        $shop_image = null;
        if ($request->hasFile('shop_image')) {
            $shop_image = date('Ymdhsis') . '.' . $request->file('shop_image')->getClientOriginalExtension();
            $request->file('shop_image')->storeAs('/shop', $shop_image);
        }

        $nid = null;
        if ($request->hasFile('nid')) {
            $nid = "NID" . date('Ymdhsis') . '.' . $request->file('nid')->getClientOriginalExtension();
            $request->file('nid')->storeAs('/shop', $nid);
        }

        $file = null;
        if ($request->hasFile('trade_license_file')) {
            $file = "TLF" . date('Ymdhsis') . '.' . $request->file('trade_license_file')->getClientOriginalExtension();
            $request->file('trade_license_file')->storeAs('/customer', $file);
        }

        Customer::create([

            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'business_name'         => $request->business_name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'type'                  => Customer::CUSTOMER,
            'address'               => $request->address,
            'nid'                   => $nid,
            'customer_note'         => $request->customer_note,
            'trade_license_number'  => $request->trade_license_number,
            'trade_license_file'    => $file,
            'division_id'           => $request->division_id,
            'district_id'           => $request->district_id,
            'upazilas_id'           => $request->upazilas_id,
            'union_id'              => $request->union_id,
            'password'              => bcrypt($request->password),
            'image'                 => $image,
            'status'                => $request->status,
            'is_email_verified'                => true,
            'is_mobile_verified'                => true,
        ]);

        notify()->success('Enduser created successfully');
        return redirect()->route('enduser.list');
    }

    public function edit($id)
    {
        $enduser  = Customer::find($id);
        $divisions  = Division::all();
        $district   = District::find($enduser->district_id);
        $upazila    = Upazila::find($enduser->upazilas_id);
        $union      = Union::find($enduser->union_id);

        return view('backend.enduser.edit', compact('enduser', 'divisions', 'district', 'upazila', 'union'));
    }

    public function update(Request $request, $id)
    {

        $corporateInfo = Customer::find($id);
        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'business_name'         => 'required|max:255',
            'email'                 => 'required|email',
            'phone'                 => 'required|digits:11|regex:/(01)[0-9]{9}/',
            'address'               => 'required',
            'trade_license_number'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $corporateInfo->getRawOriginal('image');
        if ($request->hasFile('image')) {
            $remove = public_path() . '/customer/' . $image;
            File::delete($remove);
            $image  = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/customer', $image);
        }

        $nid = $corporateInfo->nid;
        if ($request->hasFile('nid')) {
            $removeNID  = public_path() . '/customer/' . $nid;
            File::delete($removeNID);
            $nid        = "NID" . date('Ymdhsis') . '.' . $request->file('nid')->getClientOriginalExtension();
            $request->file('nid')->storeAs('/customer', $nid);
        }

        $tlf = $corporateInfo->trade_license_file;
        if ($request->hasFile('trade_license_file')) {
            $removeTLF  = public_path() . '/customer/' . $tlf;
            File::delete($removeTLF);
            $tlf        = "TLF" . date('Ymdhsis') . '.' . $request->file('trade_license_file')->getClientOriginalExtension();
            $request->file('trade_license_file')->storeAs('/customer', $tlf);
        }

        $corporateInfo->update([

            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'business_name'         => $request->business_name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'address'               => $request->address,
            'nid'                   => $nid,
            'customer_note'         => $request->customer_note,
            'trade_license_number'  => $request->trade_license_number,
            'trade_license_file'    => $tlf,
            'division_id'           => $request->division_id,
            'district_id'           => $request->district_id,
            'upazilas_id'           => $request->upazilas_id,
            'union_id'              => $request->union_id,
            'image'                 => $image,
            'status'                => $request->status,
        ]);

        notify()->success('Enduser updated successfully');
        return redirect()->route('enduser.list');
    }

    public function delete($id)
    {
        $corporate = Customer::find($id);
        if ($corporate) {
            $corporate->delete();
            notify()->success("Enduser deleted successfully");
            return redirect()->back();
        } else {
            notify()->error("Enduser not found");
            return redirect()->back();
        }
    }

    public function view($id)
    {
        $enduser = Customer::find($id);
        return view('backend.enduser.view', compact('enduser'));
    }

    public function getDistrict(Request $request)
    {
        $districts = District::where("division_id", $request->location_id)->get();
        return $districts;
    }
    public function getUpazilas(Request $request)
    {

        $getUpazilas = Upazila::where("district_id", $request->location_id)->get();
        return $getUpazilas;
    }
    public function getUnions(Request $request)
    {

        $getUpazila = Union::where("upazila_id", $request->location_id)->get();
        return $getUpazila;
    }

    public function purchaseList()
    {
        $purchaseList   = CustomerPurchase::where('order_type', Customer::CUSTOMER)->with('details', 'user')->get();
        return view('backend.enduser.purchase_list', compact('purchaseList'));
    }
}
