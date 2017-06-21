<?php

use App\Models\VrLanguageCodes;
use App\Models\VrMenu;

function getActiveLanguages()
{
    $language = VrLanguageCodes::where('is_active', '1')->pluck('name', 'id')->toArray();

    $locale = app()->getLocale();

    if (!isset($language[$locale]))
    {
        $locale = config('app.fallback_locale');

        if (!isset($language[$locale]))
        {
            return $language;
        }
    }

    $config = array($locale => $language[$locale]) + $language;

    return $config;
}

function getFrontEndMenu()
{
    $config = VrMenu::where('vr_parent_id')->get()->toArray();
    dd($config);
    return [$config];
}
