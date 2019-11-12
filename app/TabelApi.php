<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelApi extends Model
{
    protected $fillable = ['type', 'api', 'description'];
}
