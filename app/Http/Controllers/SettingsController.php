<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsToUpdate = $request->only([
            'site_name',
            'site_email',
            'facebook_link',
            'twitter_link',
            'instagram_link',
            'maintenance_mode'
        ]);

        foreach ($settingsToUpdate as $key => $value) {
            DB::table('settings')->where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}

