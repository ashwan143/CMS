<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [

            // GENERAL

            [
                'key' => 'site_name',
                'value' => '',
                'group' => 'general',
                'type' => 'text',
            ],

            [
                'key' => 'site_tagline',
                'value' => '',
                'group' => 'general',
                'type' => 'text',
            ],

            [
                'key' => 'site_logo',
                'value' => null,
                'group' => 'general',
                'type' => 'image',
            ],

            [
                'key' => 'site_favicon',
                'value' => null,
                'group' => 'general',
                'type' => 'image',
            ],

            [
                'key' => 'website_status',
                'value' => '1',
                'group' => 'general',
                'type' => 'boolean',
            ],

            [
                'key' => 'maintenance_message',
                'value' => 'Our website is currently under maintenance. Please check back soon.',
                'group' => 'general',
                'type' => 'text',
            ],


            // CONTACT

            [
                'key' => 'contact_email',
                'value' => '',
                'group' => 'contact',
                'type' => 'text',
            ],

            [
                'key' => 'contact_phone',
                'value' => '',
                'group' => 'contact',
                'type' => 'text',
            ],

            [
                'key' => 'contact_whatsapp',
                'value' => '',
                'group' => 'contact',
                'type' => 'text',
            ],

            [
                'key' => 'contact_address',
                'value' => '',
                'group' => 'contact',
                'type' => 'textarea',
            ],

            [
                'key' => 'google_maps_url',
                'value' => '',
                'group' => 'contact',
                'type' => 'url',
            ],


            // SOCIAL

            [
                'key' => 'facebook_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],

            [
                'key' => 'instagram_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],

            [
                'key' => 'linkedin_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],

            [
                'key' => 'youtube_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],

            [
                'key' => 'twitter_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],

            [
                'key' => 'github_url',
                'value' => '',
                'group' => 'social',
                'type' => 'url',
            ],


            // SEO

            [
                'key' => 'meta_title',
                'value' => '',
                'group' => 'seo',
                'type' => 'text',
            ],

            [
                'key' => 'meta_description',
                'value' => '',
                'group' => 'seo',
                'type' => 'textarea',
            ],

            [
                'key' => 'meta_keywords',
                'value' => '',
                'group' => 'seo',
                'type' => 'text',
            ],

            [
                'key' => 'google_analytics_id',
                'value' => '',
                'group' => 'seo',
                'type' => 'text',
            ],

            [
                'key' => 'google_search_console',
                'value' => '',
                'group' => 'seo',
                'type' => 'text',
            ],


            // COMPANY

            [
                'key' => 'company_name',
                'value' => '',
                'group' => 'company',
                'type' => 'text',
            ],

            [
                'key' => 'company_about',
                'value' => '',
                'group' => 'company',
                'type' => 'textarea',
            ],

            [
                'key' => 'company_founded_year',
                'value' => '',
                'group' => 'company',
                'type' => 'number',
            ],

            [
                'key' => 'company_registration',
                'value' => '',
                'group' => 'company',
                'type' => 'textarea',
            ],


            // FOOTER

            [
                'key' => 'footer_text',
                'value' => '',
                'group' => 'footer',
                'type' => 'textarea',
            ],

            [
                'key' => 'copyright_text',
                'value' => '',
                'group' => 'footer',
                'type' => 'text',
            ],

            [
                'key' => 'footer_logo',
                'value' => null,
                'group' => 'footer',
                'type' => 'image',
            ],
        ];


        foreach ($settings as $setting) {

            Setting::firstOrCreate(
                [
                    'key' => $setting['key'],
                ],
                [
                    'value' => $setting['value'],
                    'group' => $setting['group'],
                    'type' => $setting['type'],
                    'status' => true,
                ]
            );
        }
    }
}
