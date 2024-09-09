<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_settings;
use App\Models\BillSettings;

class Settings extends Controller
{
    public function __construct() {
        $this->view_path = 'admin.settings.';
    }

    public function content(){
        $obj = General_settings::find(1);
        $data['title'] = 'Settings';
        $data['general_settings'] = $obj;
        return view($this->view_path."content")->with($data);
    }

    public function add_content(Request $r){
        $obj = General_settings::find(1);
        $obj->application_name = $r->application_name;
        $obj->site_description = $r->site_description;
        $obj->copyright = $r->copyright;
        $imglogo = $r->file("logo");
        if(isset($imglogo)){
            $img_name = time().$imglogo->getClientOriginalName();
            $imglogo->move(public_path("site_data_images"),$img_name);
        }else{
            $img_name = $obj->logo;
        }
        $obj->logo = $img_name;

        $imgfavicon = $r->file("favicon");
        if(isset($imgfavicon)){
            $img_namefi = time().$imgfavicon->getClientOriginalName();
            $imgfavicon->move(public_path("site_data_images"),$img_namefi);
        }else{
            $img_namefi = $obj->fabicon;
        }
        $obj->fabicon = $img_namefi;

        $obj->contact_phone = $r->phone;
        $obj->contact_phone_opt = $r->phoneopt;
        $obj->contact_email = $r->email;
        $obj->contact_email_opt = $r->emailopt;
        $obj->contact_address = $r->address;
        $obj->update();
        return redirect()->back()->with(["success"=>"Updated Successfully"]);
    }



    public function bill_settings(){
        $data['title'] = 'Bill Settings';
        $data['bill_setting'] = BillSettings::find(1);
        return view('admin.settings.bill_settings')->with($data);
    }

    public function process_bill_settings(Request $request){
        $obj = BillSettings::find(1);
        $obj->company_name = $request->company_name;
        $obj->company_address = $request->company_address;
        $obj->company_phone = $request->company_phone;
        $obj->gstin = $request->gstin;
        $obj->fssai_license = $request->fssai_license;
        $obj->is_tax_show = $request->gst_show;
        $res = $obj->update();
        if($res){
            return redirect()->back()->with('success','Bill Settings Chnaged Successfully');
        }else{
            return redirect()->back()->with('error','Bill Settings Not Chnaged');
        }
    }
}
