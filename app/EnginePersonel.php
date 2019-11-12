<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnginePersonel extends Model
{
    protected $fillable = [ 'request_submittion_id', 'name', 'id_number', 'function', 'auth_no_stamp_holder', 'unit', 'scope_competency',
                             'nominate', 'training_certificate', 'personal_ability', 'certificate_competence', 'staff_authorization',];
}
