<?php

namespace App\Models;



class VrPagesTranslations extends CoreModel
{
    use UuidTrait;



    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_pages_translations';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'slug', 'title', 'description_short', 'description_long'];

    public function page ()
    {
        return $this->hasOne(VrPages::class, 'id', 'record_id');
    }

}
