<?php

use App\Models\Setting;

if (! function_exists('setting')) {

    /**
     * Get a website setting value.
     */
    function setting(
        string $key,
        mixed $default = null
    ): mixed {

        return Setting::getValue(
            $key,
            $default
        );
    }
}
