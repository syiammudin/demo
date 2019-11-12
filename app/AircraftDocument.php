<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftDocument extends Model
{
    protected $fillable = [ 'request_submittion_id', 'type', 'document_code', 'description_document',
                            'manufacture', 'ac_type', 'attachment', 'rev_date', 'rev' ,'effective_code'] ;
}
