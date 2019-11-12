<!-- Personel -->

<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.name" placeholder="Name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Personal Number </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.personal_number" placeholder="Personal Number" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">STA </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.sta" placeholder="STA" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Skill </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.skill" placeholder="Skill" class="form-control">
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">AMEL No </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.amel_no" placeholder="AMEL No" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Exp. Date </label>
        <div class="col-sm-8">
            <el-date-picker
              v-model="personel.ex_date_ame"
              type="date"
              placeholder="Exp. Date" value-format="yyyy-MM-dd">
            </el-date-picker>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">GMF AUTH No </label>
        <div class="col-sm-8">
            <input type="text" v-model="personel.gmf_auth_number" placeholder="GMF AUTH No" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Exp Date </label>
        <div class="col-sm-8">
            <el-date-picker
              v-model="personel.ex_date_company"
              type="date"
              placeholder="Exp. Date" value-format="yyyy-MM-dd">
            </el-date-picker>
            <!-- <input type="text" v-model="personel.ex_date_company" placeholder="Exp Date" class="form-control"> -->
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm" @click='addPersonel()'> <i class="icon-plus"></i> Add </button>
    </div>
</div>

<!-- material  -->
<!-- <div class="form-group">
    <label class="col-sm-2 control-label">Description </label>
    <div class="col-sm-10">
        <input type="text" v-model="material.description_material" placeholder="Description" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">PN </label>
    <div class="col-sm-10">
        <input type="text" v-model="material.pn" placeholder="PN" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Availability </label>
    <div class="col-sm-10">
        <input type="text" v-on:keyup.enter="addMaterials()" v-model="material.availability" placeholder="Availability" class="form-control">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm" @click='addMaterials()'> <i class="icon-plus"></i> Add </button>
    </div>
</div> -->

<!-- <div class="line-dashed"></div> -->


<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">Document Code </label>
        <div class="col-sm-8">
            <input type="text" v-model="doc.document_code" placeholder="Document Code" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Type </label>
        <div class="col-sm-8">
            <input type="text" v-model="doc.type" placeholder="Type" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Description </label>
        <div class="col-sm-8">
            <input type="text" v-model="doc.description_document" placeholder="Description" class="form-control">
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">Manufacture </label>
        <div class="col-sm-8">
            <input type="text" v-model="doc.manufacture" placeholder="Manufacture" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">AC Type</label>
        <div class="col-sm-8">
            <input type="text" v-model="doc.ac_type" placeholder="AC Type" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Update</label>
        <div class="col-sm-8">
            <input type="text"  v-on:keyup.enter="addDoc()" v-model="doc.update" placeholder="Update " class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm" @click='addDoc()'> <i class="icon-plus"></i> Add </button>
    </div>
</div>


<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">Description </label>
        <div class="col-sm-8">
            <input type="text" v-model="tool.description_tools" placeholder="Description" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Part Numbers </label>
        <div class="col-sm-8">
            <input type="text" v-model="tool.part_no" placeholder="Part Number" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Qty </label>
        <div class="col-sm-8">
            <input type="number" v-model="tool.qty" placeholder="Qty" class="form-control">
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label class="col-sm-4 control-label">unit </label>
        <div class="col-sm-8">
            <input type="text" v-model="tool.unit" placeholder="Unit" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Remark </label>
        <div class="col-sm-8">
            <input type="text" v-on:keyup.enter="addTools()" v-model="tool.remark" placeholder="remark" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm" @click='addTools()'> <i class="icon-plus"></i> Add </button>
    </div>
</div>
<div class="line-dashed"></div>

<div class="col-sm-10 checkbox checkbox-replace checkbox-primary">
    <!-- <el-select v-model="input.maintenance_area" multiple filterable clearable placeholder="Select Maintenance Area" >
        <el-option v-for="item in MaintenanceArea" :key="item.code"
            :label="item.code+' - '+item.description"
            :value="item.code">
        </el-option>
    </el-select> -->
    <div class="col-md-3">
        <input type="radio" v-model='input.hangar_1'>
        <label for="checkbox6">Hangar 1 </label>
    </div>
    <div class="col-md-3">
        <input type="checkbox" v-model='input.hangar_2'>
        <label for="checkbox6">Hangar 2</label>
    </div>
    <div class="col-md-3">
        <input type="checkbox" v-model='input.hangar_3'>
        <label for="checkbox6">Hangar 3 </label>
    </div>
    <div class="col-md-3">
        <input type="checkbox" v-model='input.hangar_4'>
        <label for="checkbox6">Hangar 4</label>
    </div>
    <div class="col-md-3">
        <input type="checkbox" v-model='input.cek_lm'>
        <label for="checkbox6">Line Maintenance
        </label>
            <el-select v-if="line_maintenance == 2"  onloadedmetadata=""v-model="input.line_maintenance"  filterable clearable placeholder="Select Maintenance Area" >
                <el-option v-for="item in MaintenanceArea" :key="item.code"
                    :label="item.code+' - '+item.description"
                    :value="item.code">
                </el-option>
            </el-select>
    </div>
    <div class="col-md-3">
        <input type="checkbox" v-model='input.other_area'>
        <label for="checkbox6">Other:</label>
        <input type="text" v-if="other_area == 2" class="form-control">
    </div>
    <span v-if="err.mantenance_area" > {{ err.mantenance_area[0] }}</span>
</div>

<div class="col-sm-2">
    A-CHECK
    <select class="form-control" style="width:70px" v-model="input.ability_a_check">
        <option v-for="i in check"  :value="i.id">{{ i.name }}</option>
    </select>
</div>
<div class="col-sm-2">
    C-CHECK
    <select class="form-control" style="width:70px" v-model="input.ability_c_check">
        <option v-for="i in check"  :value="i.id">{{ i.name }}</option>
    </select>
</div>
<div class="col-sm-2">
    D-CHECK
    <select class="form-control" style="width:70px" v-model="input.ability_d_check">
        <option v-for="i in check"  :value="i.id">{{ i.name }}</option>
    </select>
</div>
<div class="col-sm-3">
    <div class="row">
        <div class="col-sm-12">
            OTHER MAINTENANCE
        </div>
        <div class="col-sm-6">
            <select class="form-control" style="width:70px" v-model="input.ability_other_maintenance">
                <option v-for="i in check"  :value="i.id">{{ i.name }}</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="text" v-if="other_field" v-model="input.other_main_value" class="form-control" style="width:200px" >
        </div>
    </div>
</div>
