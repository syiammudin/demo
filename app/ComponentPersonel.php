<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentPersonel extends Model
{
    protected $fillable = ['request_submittion_id', 'name', 'id_number', 'nominate', 'training_certificate', 'staff_authorization',
                           'certificate_competence', 'personal_ability'] ;
}
