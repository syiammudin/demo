<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialPersonel extends Model
{
    protected $fillable = ['request_submittion_id', 'name', 'id_number', 'job_title', 'auth_no_stamp_holder', 'unit',
                            'scope_competency', 'skill', 'nominate', 'training_certificate', 'personal_ability', 'certificate_competence', 'staff_authorization', 'level'];
}
