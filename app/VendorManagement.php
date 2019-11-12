<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorManagement extends Model
{
    use SoftDeletes;

	protected $table = "vendor_managements";
    protected $casts = [
        'id' => 'int',
        'type_bussines' => 'json',
        'list_name_aproval' => 'array',
        'list_customers' => 'array',
        'list_curent_capability' => 'array',
        'document_evidence' => 'json',
    ] ;

   	protected $dates = ['deleted_at'];

    protected $fillable =  ['to', 'from', 'dept', 'phone', 'vendor_name', 'vendor_address', 'vendor_phone', 'vendor_fax',
                            'parent_company', 'contact_name', 'contact_email', 'contact_title', 'supplier_code',
                            'aplication_drawing', 'item_proposed', 'type_supplier', 'type_bussines', 'age_organization',
                            'total_employee', 'total_supervisors', 'total_inspectors', 'total_personel', 'list_name_aproval',
                            'list_customers', 'list_curent_capability', 'representative_indonesia','document_evidence',
                            'date_audit','evaluation_organization', 'evaluation_quality_assurance', 'evaluation_qa_system',
                            'evaluation_indicate_supply', 'evaluation_part_inspection', 'evaluation_maintain_quality',
                            'evaluation_program_recertify', 'evaluation_control_policies', 'evaluation_trace_ability',
                            'evaluation_for_usa_only', 'evaluation_provide', 'evaluation_implement_sms','evaluation_implement_sms',
                            'status','user_id','vendor_city', 'vendor_state', 'vendor_zip_code','token','attachment', 'status_vendor', 'read',
                            'decision', 'score', 'request_number','maint_fn','questionnaire_exp_date', 'product_service','qsa_part_approve','calibration_lab_certificate_value',
                            'other_document_evidence_value','submit_date'
                            ];

    protected $appends = [ 'name'];
    public function getNameAttribute()
    {
        return $this->user->name ;
    }

    public function User(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function VendorManagementHistory(){
        return $this->hasMany(VendorManagementHistory::class);
    }

    public function VendorAttachment(){
        return $this->hasMany(VendorAttachment::class);
    }
}
