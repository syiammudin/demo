<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftAuthorizedPersonel extends Model
{
    protected $fillable = ['license_type','request_submittion_id', 'name', 'personal_number', 'sta', 'skill', 'amel_no', 'ex_date_ame',
                            'gmf_auth_number', 'ex_date_company','amel_scope','gmf_scope','stamp_no'
                            ] ;
    protected $cast = [
        'id' => 'json',
        'amel_scope' => 'json',
        'gmf_scope' => 'json',
    ] ;
}
