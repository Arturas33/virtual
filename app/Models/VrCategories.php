<?php

namespace App\Models;


class VrCategories extends CoreModel
{
    use UuidTrait;

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_categories';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'comment'];

    protected $with = ['translations'];

    public function translations()
    {

        $language = request('language_code');
        if($language == null)
            $language = app()->getLocale();

        return $this->hasOne(VrCategoriesTranslations::class, 'record_id', 'id')->where('language_code',$language);
    }
}
