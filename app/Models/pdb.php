<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pdb extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = ['calon_pdb'];
}
