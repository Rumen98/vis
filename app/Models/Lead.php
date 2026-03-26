<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
   protected $fillable = [
    'name','phone','email','object_type','message','source','contacted_at'
    ];

    protected $casts = [
    'contacted_at' => 'datetime',
    ];

}
