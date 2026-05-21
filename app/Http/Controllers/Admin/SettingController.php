<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general()
    {
        $settings = Setting::where('group','general')->pluck('value','key');
        return view('admin.settings.general', compact('settings'));
    }
    public function updateGeneral(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key'=>$key],['value'=>$value,'group'=>'general']);
        }
        return back()->with('success','Settings saved!');
    }
    public function delivery()
    {
        $settings = Setting::where('group','delivery')->pluck('value','key');
        return view('admin.settings.delivery', compact('settings'));
    }
    public function updateDelivery(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key'=>$key],['value'=>$value,'group'=>'delivery']);
        }
        return back()->with('success','Delivery settings saved!');
    }
}
