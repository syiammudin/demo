<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestSubmittion extends Model
{
    use SoftDeletes;

	protected $table = "request_submittions";
   	protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'master_request_id', 'status','aproval','request_number','request_type','status_read',
                           'approve_name','checked_name','decision','score','step_request_type','qsa_part_approve','submit_date',
                           'remark_deletion', 'date_approve'] ;

    protected $casts = [
       'id' => 'int',
       'decision' => 'array',
    ];

    protected $appends = ['name'];
    public function getNameAttribute()
    {
        return $this->User->name ;
    }

    public function User(){
        return $this->belongsTo(User::class)->withTrashed();
    }


    public function MasterRequest(){
        return $this->belongsTo(MasterRequest::class);
    }

    // aircraft relation
    function AircraftRequest()
    {
        return $this->hasOne(AircraftRequest::class);
    }

    public function RequestHistory(){
        return $this->hasMany(RequestHistory::class);
    }

    function AircraftAuthorizedPersonel()
    {
        return $this->hasMany(AircraftAuthorizedPersonel::class);
    }

    function AircraftDocument()
    {
        return $this->hasMany(AircraftDocument::class);
    }

    function AircraftMaterial()
    {
        return $this->hasMany(AircraftMaterial::class);
    }

    function AircraftToolEquipment()
    {
        return $this->hasMany(AircraftToolEquipment::class);
    }
    // end aircraft relation


    // engine proses relation
    function EngineRequest(){
        return $this->hasOne(EngineRequest::class) ;
    }

    function EngineConsumableMaterial(){
        return $this->hasMany(EngineConsumableMaterial::class) ;
    }

    function EnginePersonel(){
        return $this->hasMany(EnginePersonel::class);
    }

    function EngineTasklistNumber(){
        return $this->hasMany(EngineTasklistNumber::class) ;
    }

    function EngineTool(){
        return $this->hasMany(EngineTool::class) ;
    }

    function EngineVendorList(){
        return $this->hasMany(EngineVendorList::class) ;
    }

    function EngineShopAbility(){
        return $this->hasOne(EngineShopAbility::class) ;
    }
    function EngineDocument(){
        return $this->hasMany(EngineDocument::class) ;
    }
    function EngineTestEquipment(){
        return $this->hasMany(EngineTestEquipment::class) ;
    }
    function EngineSpecialTools(){
        return $this->hasMany(EngineSpecialTools::class) ;
    }

    // special request relation
    function SpecialRequest(){
        return $this->hasOne(SpecialRequest::class) ;
    }
    function SpecialShopAbility(){
        return $this->hasOne(SpecialShopAbility::class) ;
    }
    function SpecialPersonel(){
        return $this->hasMany(SpecialPersonel::class) ;
    }
    function SpecialSheetList(){
        return $this->hasMany(SpecialSheetList::class) ;
    }
    function SpecialTools(){
        return $this->hasMany(SpecialTools::class) ;
    }
    function SpecialPartList(){
        return $this->hasMany(SpecialPartList::class) ;
    }
    function SpecialDocument(){
        return $this->hasMany(SpecialDocument::class) ;
    }
    function SpecialMaterial(){
        return $this->hasMany(SpecialMaterial::class) ;
    }
    function SpecialTestEquipment(){
        return $this->hasMany(SpecialTestEquipment::class) ;
    }

    //component request
    function ComponentRequest(){
        return $this->hasOne(ComponentRequest::class) ;
    }
    function ComponentShopAbility(){
        return $this->hasOne(ComponentShopAbility::class) ;
    }
    function ComponentPersonel(){
        return $this->hasMany(ComponentPersonel::class) ;
    }
    function ComponentDocument(){
        return $this->hasMany(ComponentDocument::class) ;
    }
    function ComponentTestEquipment(){
        return $this->hasMany(ComponentTestEquipment::class) ;
    }
    function ComponentSpecialTool(){
        return $this->hasMany(ComponentSpecialTool::class) ;
    }
    function ComponentManhoursPlanning(){
        return $this->hasMany(ComponentManhoursPlanning::class) ;
    }
    function ComponentMaterialPlanning(){
        return $this->hasMany(ComponentMaterialPlanning::class) ;
    }
    function ComponentAttachment(){
        return $this->hasOne(ComponentAttachment::class) ;
    }
    function ComponentEquivalent(){
        return $this->hasMany(ComponentEquivalent::class) ;
    }
    function AttachmentResubmit(){
        return $this->hasMany(AttachmentResubmit::class) ;
    }

    function AircraftFacility(){
        return $this->hasMany(AircraftFacility::class) ;
    }

    function AdditionalAttachment(){
        return $this->hasMany(AdditionalAttachment::class) ;
    }


}
