<?php

namespace App\Models;



class VrPages extends CoreModel
{
    use UuidTrait;

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_pages';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'category_id', 'cover_id'];


    protected $with = ['translations' , 'upload'];

    public function translations()
    {

        $language = request('language_code');
        if($language == null)
            $language = app()->getLocale();

        return $this->hasOne(VrPagesTranslations::class, 'record_id', 'id')->where('language_code', $language);

    }

    public function upload () {
        return $this->hasOne(VrResources::class, 'id' , 'cover_id');
    }


}
