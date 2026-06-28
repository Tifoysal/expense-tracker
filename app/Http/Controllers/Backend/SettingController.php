<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::first();
        return view('backend.settings.setting', compact('setting'));
    }

    public function settings(Request $request)
    {
     
        $validate=Validator::make($request->all(),[
            'name'                  =>  'required',
            'address'               =>  'required',
            'email'                 =>  'required',
            'phone'                 =>  'required'
        ]);
      
        if($validate->fails())
        {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }
        try {
            $setting = Setting::find($request->id);
            if ($setting) {
                $filename = $setting->getRawOriginal('logo');
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $filename = date('Ymdhis') . "." . $file->getClientOriginalExtension();
                    $file->storeAs('/setting', $filename);
                }
                $web_logo_filename = $setting->getRawOriginal('web_logo');
                if ($request->hasFile('web_logo')) {
                    $web_logo_file = $request->file('web_logo');
                    $web_logo_filename = date('Ymdhis') . "." . $web_logo_file->getClientOriginalExtension();
                    $web_logo_file->storeAs('/setting', $web_logo_filename);
                }

                $setting->update([
                    'logo'                  =>  $filename,
                    'web_logo'              =>  $web_logo_filename,
                    'company_name'          =>  $request->name,
                    'address'               =>  $request->address,
                    'email'                 =>  $request->email,
                    'phone_number'          =>  $request->phone,
                    'google_location'       =>  $request->google_location,
                    'web_address'           =>  $request->web_address,
                    'facebook'              =>  $request->facebook,
                    'twitter'               =>  $request->twitter,
                    'instagram'             =>  $request->instagram,
                    'youtube'               =>  $request->youtube,
                    'linkedin'              =>  $request->linkedin,
                    'tag_line'              =>  $request->tag_line,
                    'about_us'              =>  $request->about_us,
                    'terms_and_conditions'  =>  $request->terms_and_conditions,
                    'privacy_policy'  =>  $request->privacy_policy,
                    'notice'                =>  $request->notice,
                    'vat'                   =>  0,
                    'delivery_charge'       =>  $request->delivery_charge,
                    'start_time'  =>  $request->start_time,
                    'end_time'                =>  $request->end_time,
                ]);

                notify()->success('settings updated');
                return redirect()->back();
            }
        } catch (\Throwable $e) {
            notify()->warning($e->getMessage());
            return redirect()->back();
        }
    }
}
