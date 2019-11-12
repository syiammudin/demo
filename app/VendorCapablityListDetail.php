<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCapablityListDetail extends Model
{
    protected $fillable = ['capability_list_id','type_supplier', 'supplier_name', 'vendor_code','address', 'email', 'last_update', 'main_fn',
                            'product_service', 'remark', 'dgca', 'faa', 'easa', 'asa', 'iso', 'nc', 'kan', 'other',
                            'maint_fn','questionnaire_exp_date','document_evidence'];
}
