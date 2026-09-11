<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    /**
     * Display Settings
     */
    public function index()
    {
        $settings = Setting::orderBy('group')
            ->orderBy('id')
            ->get()
            ->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }


    /**
     * Update Settings
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | General
            |--------------------------------------------------------------------------
            */

            'site_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'site_tagline' => [
                'nullable',
                'string',
                'max:255',
            ],

            'website_status' => [
                'required',
                'boolean',
            ],

            'maintenance_message' => [
                'nullable',
                'string',
                'max:2000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'contact_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'contact_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'contact_whatsapp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'contact_address' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:1000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Social
            |--------------------------------------------------------------------------
            */

            'facebook_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'instagram_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'linkedin_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'youtube_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'twitter_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:1000',
            ],


            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'meta_keywords' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'google_analytics_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'google_search_console' => [
                'nullable',
                'string',
                'max:1000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Company
            |--------------------------------------------------------------------------
            */

            'company_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'company_about' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'company_founded_year' => [
                'nullable',
                'integer',
                'min:1800',
                'max:' . date('Y'),
            ],

            'company_registration' => [
                'nullable',
                'string',
                'max:2000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Footer
            |--------------------------------------------------------------------------
            */

            'footer_text' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'copyright_text' => [
                'nullable',
                'string',
                'max:500',
            ],


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'site_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
            ],

            'site_favicon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg,ico',
                'max:1024',
            ],

            'footer_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Text Settings
        |--------------------------------------------------------------------------
        */

        $textSettings = [

            'site_name' => 'general',
            'site_tagline' => 'general',
            'website_status' => 'general',
            'maintenance_message' => 'general',

            'contact_email' => 'contact',
            'contact_phone' => 'contact',
            'contact_whatsapp' => 'contact',
            'contact_address' => 'contact',
            'google_maps_url' => 'contact',

            'facebook_url' => 'social',
            'instagram_url' => 'social',
            'linkedin_url' => 'social',
            'youtube_url' => 'social',
            'twitter_url' => 'social',
            'github_url' => 'social',

            'meta_title' => 'seo',
            'meta_description' => 'seo',
            'meta_keywords' => 'seo',
            'google_analytics_id' => 'seo',
            'google_search_console' => 'seo',

            'company_name' => 'company',
            'company_about' => 'company',
            'company_founded_year' => 'company',
            'company_registration' => 'company',

            'footer_text' => 'footer',
            'copyright_text' => 'footer',
        ];


        foreach ($textSettings as $key => $group) {

            if (!array_key_exists($key, $validated)) {
                continue;
            }

            Setting::setValue(
                key: $key,
                value: $validated[$key],
                group: $group,
                type: $key === 'website_status'
                    ? 'boolean'
                    : 'text',
                createdBy: Auth::id()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Image Settings
        |--------------------------------------------------------------------------
        */

        $imageSettings = [
            'site_logo' => 'general',
            'site_favicon' => 'general',
            'footer_logo' => 'footer',
        ];


        foreach ($imageSettings as $key => $group) {

            if (!$request->hasFile($key)) {
                continue;
            }

            $file = $request->file($key);

            /*
            |--------------------------------------------------------------------------
            | Existing Setting
            |--------------------------------------------------------------------------
            */

            $setting = Setting::where('key', $key)->first();


            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */

            if ($setting && $setting->value) {

                if (
                    Storage::disk('public')
                        ->exists($setting->value)
                ) {

                    Storage::disk('public')
                        ->delete($setting->value);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Store New Image
            |--------------------------------------------------------------------------
            */

            $path = $file->store(
                'settings',
                'public'
            );


            /*
            |--------------------------------------------------------------------------
            | Save Setting
            |--------------------------------------------------------------------------
            */

            Setting::setValue(
                key: $key,
                value: $path,
                group: $group,
                type: 'image',
                createdBy: Auth::id()
            );
        }


        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Settings updated successfully.'
            );
    }


    /**
     * Remove Setting Image
     */
    public function removeImage(
        string $key
    ): RedirectResponse {

        $allowedImages = [
            'site_logo',
            'site_favicon',
            'footer_logo',
        ];


        if (!in_array($key, $allowedImages, true)) {

            throw ValidationException::withMessages([
                'image' => 'Invalid setting image.',
            ]);
        }


        $setting = Setting::where('key', $key)->first();


        if (!$setting) {

            return redirect()
                ->route('settings.index')
                ->with(
                    'error',
                    'Setting image not found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Physical Image
        |--------------------------------------------------------------------------
        */

        if ($setting->value) {

            if (
                Storage::disk('public')
                    ->exists($setting->value)
            ) {

                Storage::disk('public')
                    ->delete($setting->value);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Clear Database Value
        |--------------------------------------------------------------------------
        */

        Setting::setValue(
            key: $key,
            value: null,
            group: $setting->group,
            type: 'image',
            createdBy: Auth::id()
        );


        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Image removed successfully.'
            );
    }
}
