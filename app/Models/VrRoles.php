<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VrRoles extends CoreModel
{

    /**
     * $table name DataBases
     */
    protected $table = 'vr_roles';

    /**
     * $fillable is table 'vr_roles' fields
     */

    protected $fillable = ['id', 'name'];

}
