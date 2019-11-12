<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialDocument extends Model
{
    protected $fillable = ['request_submittion_id', 'no_document', 'rev','rev_date', 'document_type','proposed_pd_sheet','manual_status_confirmation', 'component_maintenance_manual',] ;
}
