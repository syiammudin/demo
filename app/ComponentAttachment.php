<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentAttachment extends Model
{
    protected $fillable = ['request_submittion_id', 'manual_status_confirmation', 'component_maintenance_manual', 'proposed_pd_sheet',
                           'vendor_statement', 'simple_component_evaluation', 'component_similarity', 'maintenance_record',
                           'sample_component_relase', 'other'] ;
}
