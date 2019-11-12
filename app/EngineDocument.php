<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineDocument extends Model
{
    protected $fillable = ['request_submittion_id', 'no_document', 'rev', 'rev_date', 'document_type', 'manual_status_confirmation', 'component_maintenance_manual', 'proposed_pd_sheet'] ;
}
