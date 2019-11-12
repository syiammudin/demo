<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = ['app_name', 'logo', 'background', 'street', 'city', 'country', 'po_box', 'zip_code', 'phone', 'fax', 'email'] ;
}
