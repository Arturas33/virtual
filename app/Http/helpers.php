<?php

use App\Models\VrLanguageCodes;
use App\Models\VrMenu;
use App\Models\VrPages;

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
    $config = VrMenu::where('vr_parent_id', null)->with('subMenu')->orderByDesc('sequence')->get()->toArray();

  //  dd($config);

    return $config;
}

function getVrRoom()
{
    $config = VrPages::where('category_id', 'vr_rooms')->get()->toArray();

  //  dd($config);

    return $config ;
}