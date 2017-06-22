<?php

namespace App\Models;



class VrMenu extends CoreModel
{

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_menu';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'new_window', 'sequence', 'vr_parent_id'];

    protected $with = ['translations' ];

    public function translations()
    {

        $language = request('language_code');
        if($language == null)
            $language = app()->getLocale();

        return $this->hasOne(VrMenuTranslations::class, 'record_id', 'id')->where('language_code', $language);
    }
    public function subMenu()
    {
        return $this->hasMany(VrMenu::class , 'vr_parent_id','id')->with('subMenu');
    }


}
