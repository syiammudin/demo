<template>
<div>
    <div class="form-horizontal" >
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">No Anilysis Report</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" v-model="input.equivalent_number">
                            <span v-if="err.equivalent_number" class="text-danger"> {{ err.equivalent_number[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Original Issued Date</label>
                        <div class="col-lg-8">
                            <el-date-picker
                                v-model="input.original_issued"
                                type="date"
                                placeholder="Exp. Date" value-format="yyyy-MM-dd">
                            </el-date-picker>
                            <span v-if="err.original_issued" class="text-danger"> {{ err.original_issued[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Rev. No</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" v-model="input.rev_no">
                            <span v-if="err.rev_no" class="text-danger"> {{ err.rev_no[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Issued Date</label>
                        <div class="col-lg-8">
                            <el-date-picker
                            v-model="input.issued"
                            type="date"
                            placeholder="Exp. Date" value-format="yyyy-MM-dd">
                        </el-date-picker>
                        <span v-if="err.issued" class="text-danger"> {{ err.issued[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Distribution</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" v-model="input.distribution">
                        <span v-if="err.distribution" class="text-danger"> {{ err.distribution[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Category</label>
                    <div class="col-lg-8 checkbox checkbox-replace checkbox-success">
                        <div class="col-md-4">
                            <input type="checkbox"  class="form-control" v-model='tool_category.two'>
                            <label for="checkbox6"> 2 </label>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox"  class="form-control" v-model='tool_category.three'>
                            <label for="checkbox6"> 3 </label>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox"  class="form-control" v-model='tool_category.four'>
                            <label for="checkbox6"> 4 </label>
                        </div>
                        <span v-if="err.tool_category" class="text-danger"> {{ err.tool_category[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Efectifity</label>
                    <div class="col-md-8 radio radio-replace radio-success">
                        <div class="col-md-4">
                            <input type="radio" class="form-control" value="Aircraft" v-model="input.efectifity" >
                            <label for="checkbox6">Aircraft </label>
                        </div>
                        <div class="col-md-8">
                            <input type="radio" class="form-control" value="Aircraft Component" v-model="input.efectifity" >
                            <label for="checkbox6">Aircraft Component </label>
                        </div>
                        <span v-if="err.efectifity" class="text-danger"> {{ err.efectifity[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Doc No</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" v-model="input.doc_no">
                        <span v-if="err.doc_no" class="text-danger"> {{ err.doc_no[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Reason Issuance</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" v-model="input.reason_issuance">
                        <span v-if="err.reason_issuance" class="text-danger"> {{ err.reason_issuance[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Effect Maintenance Procedure</label>
                    <div class="col-lg-8">
                        <el-select  onloadedmetadata="" v-model="input.effect_maintenance_procedure"  clearable placeholder="Select Request type" >
                            <el-option label="Yes" value="1"> </el-option>
                            <el-option label="No" value="0"> </el-option>
                        </el-select>
                        <span v-if="err.effect_maintenance_procedure" class="text-danger"> {{ err.effect_maintenance_procedure[0] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Ability</label>
            <div class="col-md-9 checkbox checkbox-replace checkbox-success">
                <div class="col-md-3 ">
                    <input type="checkbox" class="form-control" v-model='ability.test'><label for="checkbox6">TEST </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox"  class="form-control" v-model='ability.diassembly'><label for="checkbox6">DIASSEMBLY </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox"  class="form-control" v-model='ability.assembly'><label for="checkbox6">ASSEMBLY </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-control" v-model='ability.cleaning'><label for="checkbox6">CLEANING  </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-control" v-model='ability.inspection'><label for="checkbox6">INSPECTION </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-control" v-model='ability.trouble_shooting'><label for="checkbox6">TROUBLE SHOOTING </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-control" v-model='ability.repair'><label for="checkbox6">REPAIR </label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-control" v-model='ability.firs_clearance'><label for="checkbox6">FITS AND CLEARANCE </label>
                </div>
                <span v-if="err.ability" class="text-danger"> {{ err.ability[0] }}</span>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Reason Of Revision</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.reason_of_revision">
                <span v-if="err.reason_of_revision" class="text-danger"> {{ err.reason_of_revision[0] }}</span>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-6 text-center"> <u>Recomended Tool/Equipment</u></label>
            <label class="col-lg-6 text-center"><u>Alternative Tool/Equipment</u></label>
            <div class="col-lg-6">
                <span v-if="err.recomended_tool" class="text-danger"> {{ err.recomended_tool[0] }}</span>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="recomended_tool.name"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Model/Type</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="recomended_tool.model"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">P/N</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="recomended_tool.pn"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">manufacture</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model='recomended_tool.manufacture'></el-input>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span v-if="err.alternate_tool" class="text-danger"> {{ err.alternate_tool[0] }}</span>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="alternate_tool.name"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Model/Type</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="alternate_tool.model"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">P/N</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model="alternate_tool.pn"></el-input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">manufacture</label>
                    <div class="col-lg-8">
                        <el-input type="text" v-model='alternate_tool.manufacture'></el-input>
                    </div>
                </div>
            </div>
        </div>
        <div class="line-dashed"></div>
        <!-- Maintenance Task Reference -->
        <div class="form-group">
            <label class="col-lg-3 control-label">Maintenance Task Reference</label>
            <div class="col-md-9">
                <span v-if="err.alternate_tool" class="text-danger"> {{ err.maintenance_task[0] }}</span>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='maintenance_task.ad'><label for="checkbox6">Airworthiness Directives (AD) No. </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="maintenance_task.ad == true" v-model="maintenance_task.value_ad" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='maintenance_task.cmm'><label for="checkbox6">Component Maintenance Manual (CMM).  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="maintenance_task.cmm == true" v-model="maintenance_task.value_cmm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='maintenance_task.amm'><label for="checkbox6">Aircraft Mainenance Manual (AMM).  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="maintenance_task.amm == true" v-model="maintenance_task.value_amm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='maintenance_task.sb'><label for="checkbox6">Service Bulletin (SB) </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="maintenance_task.sb == true" v-model="maintenance_task.value_sb" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='maintenance_task.specify'><label for="checkbox6">Other (Specify)</label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="maintenance_task.specify == true" v-model="maintenance_task.value_specify" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!-- Recomended Tool/Equipment Reference -->
        <div class="form-group">
            <label class="col-lg-3 control-label">Recomended Tool/Equipment Reference</label>
            <div class="col-md-9">
                <span v-if="err.recomended" class="text-danger"> {{ err.recomended[0] }}</span>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='recomended.wiring_diagram'><label for="checkbox6">Wiring Diagram.  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="recomended.wiring_diagram == true" v-model="recomended.value_wiring_diagram" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='recomended.tm'><label for="checkbox6">Tool/Equipment Manual (TM).  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="recomended.tm == true" v-model="recomended.value_tm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='recomended.ts'><label for="checkbox6">Tool/Equipment Specification (TS)  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="recomended.ts == true" v-model="recomended.value_ts" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='recomended.amm'><label for="checkbox6">Aircraft Maintenance Manual (AMM) </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="recomended.amm == true" v-model="recomended.value_amm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='recomended.specify'><label for="checkbox6">Other (Specify)</label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="recomended.specify == true" v-model="recomended.value_specify" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!-- Alternative Tool/Equipment Reference  -->
        <div class="form-group">
            <label class="col-lg-3 control-label">Alternative Tool/Equipment Reference</label>
            <div class="col-md-9">
                <span v-if="err.alternate" class="text-danger"> {{ err.alternate[0] }}</span>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='alternate.wiring_diagram'><label for="checkbox6">Wiring Diagram.  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="alternate.wiring_diagram == true" v-model="alternate.value_wiring_diagram" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='alternate.tm'><label for="checkbox6">Tool/Equipment Manual (TM).  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="alternate.tm == true" v-model="alternate.value_tm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='alternate.ts'><label for="checkbox6">Tool/Equipment Specification (TS)  </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="alternate.ts == true" v-model="alternate.value_ts" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='alternate.amm'><label for="checkbox6">Aircraft Maintenance Manual (AMM) </label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="alternate.amm == true" v-model="alternate.value_amm" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 checkbox checkbox-replace checkbox-success">
                    <div class="col-md-5 ">
                        <input type="checkbox" class="form-control" v-model='alternate.specify'><label for="checkbox6">Other (Specify)</label>
                    </div>
                    <div class="col-md-7">
                        <input v-if="alternate.specify == true" v-model="alternate.value_specify" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-12 text-center">Related Maintenance  <el-button @click="addRelatedMaintenance()"  size="mini" icon="fa fa-plus" round ></el-button></label>
            <span v-if="err.related_maintenance" class="text-danger"> {{ err.related_maintenance[0] }}</span>
            <div class="col-lg-12 table-responsive" style="margin-right: 5px;">
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <td colspan="4" class="text-center">Maintenance Task</td>
                            <td colspan="3" class="text-center"> Maintenance Task vs Recomended Tool/Equipment</td>
                            <td colspan="3" class="text-center"> Maintenance Task vs Alternate Tool/Equipment</td>
                            <td rowspan="2" valign="middle" class="text-center text-middle"> Complience </td>
                            <td rowspan="2" v-if="related_maintenance.length != 0"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Ref</td>
                            <td class="text-center">Page/Parag</td>
                            <td class="text-center">Description</td>
                            <td class="text-center">Acceptable Result</td>
                            <td class="text-center">Ref</td>
                            <td class="text-center">Page/Parag</td>
                            <td class="text-center">Requirement</td>
                            <td class="text-center">Ref</td>
                            <td class="text-center">Page/Parag</td>
                            <td class="text-center">Requirement</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(d, i) in related_maintenance" :key="i">
                            <td> <input type="text" class="my-input" v-model="d.ref_maintenance"> </td>
                            <td> <input type="text" class="my-input" v-model="d.page_parag_maintenance"> </td>
                            <td> <input type="text" class="my-input" v-model="d.description_maintenance"> </td>
                            <td> <input type="text" class="my-input" v-model="d.acceptable_maintenance"> </td>
                            <td> <input type="text" class="my-input" v-model="d.ref_recomended"> </td>
                            <td> <input type="text" class="my-input" v-model="d.page_parag_recomended"> </td>
                            <td> <input type="text" class="my-input" v-model="d.requirement_recomended"> </td>
                            <td> <input type="text" class="my-input" v-model="d.ref_alternate"> </td>
                            <td> <input type="text" class="my-input" v-model="d.page_parag_alternate"> </td>
                            <td> <input type="text" class="my-input" v-model="d.requirement_alternate"> </td>
                            <td>
                                <el-select  v-model="d.compliance"  clearable placeholder="Select Request type" >
                                    <el-option label="Yes" value="1"> </el-option>
                                    <el-option label="No" value="0"> </el-option>
                                </el-select>
                            </td>
                            <td  v-if="related_maintenance.length != 0">  <el-button @click="delRelatedMaintenance(i)"  size="mini" icon="fa fa-trash" round ></el-button> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Note</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.note">
                <span v-if="err.note" class="text-danger"> {{ err.note[0] }}</span>
            </div>
        </div>

        <div class="line-dashed"></div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-primary" @click="save('draft')" >Save</button>
            </div>
        </div>
    </div>
</div>

</template>
<script>
export default {
    props: ['id','index'] ,
    data(){
        return {
            mainform : false, equivalent : true , shopability : false ,
            input : {} , tool_category : {}, ability : {}, recomended_tool : {}, alternate_tool : {}, maintenance_task : {} , recomended : {},
            alternate : {} , related_maintenance : {} , url : BASE_URL +'submit_component_equivalent', related_maintenance : [], err : []
        }
    },
    created(){
        this.getData()
    },
    methods : {
        save(data){
            this.input.component_test_equipment_id = this.id

            if(Object.keys(this.tool_category).length != 0){
                this.input.tool_category = JSON.stringify(this.tool_category)
            }

            if(Object.keys(this.ability).length != 0){
                this.input.ability = JSON.stringify(this.ability)
            }
            if(Object.keys(this.recomended).length != 0){
                this.input.recomended = JSON.stringify(this.recomended)
            }
            if(Object.keys(this.alternate).length != 0){
                this.input.alternate = JSON.stringify(this.alternate)
            }
            if(Object.keys(this.maintenance_task).length != 0){
                this.input.maintenance_task = JSON.stringify(this.maintenance_task)
            }
            if(Object.keys(this.recomended_tool).length != 0){
                this.input.recomended_tool = JSON.stringify(this.recomended_tool)
            }
            if(Object.keys(this.alternate_tool).length != 0){
                this.input.alternate_tool = JSON.stringify(this.alternate_tool)
            }
            if(this.related_maintenance.length != 0){
                this.input.related_maintenance = JSON.stringify(this.related_maintenance)
            }
            const related_maintenance = this.related_maintenance.filter(cek => cek.ref_maintenance == null || cek.page_parag_maintenance == null || cek.description_maintenance == null ||
                                                                        cek.acceptable_maintenance == null || cek.ref_recomended == null || cek.page_parag_recomended == null||
                                                                        cek.requirement_recomended == null || cek.ref_alternate == null|| cek.page_parag_alternate == null ||
                                                                        cek.requirement_alternate == null)
            if(related_maintenance.length > 0){
                this.$alert("Please Fill All form Related Maintenance", 'Warning', { confirmButtonText: 'OK', });
            }

            if (related_maintenance.length == 0) {
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                axios.post(this.url, this.input).then((res) => {
                    console.log(res.data);
                    if(res.data.status == 1){
                        if(data == 'draft'){
                            this.$message({  type: 'success', message: 'Save Success'  });
                            this.input = {} ,
                            this.tool_category = {}, this.ability = {},
                            this.recomended_tool = {},
                            this.alternate_tool = {},
                            this.maintenance_task = {} ,
                            this.recomended = {},
                            this.alternate = {} ,
                            this.related_maintenance = {} ,
                            this.related_maintenance = []
                            this.$emit('addEq', { index : this.index })
                        }else{
                            this.$emit('change', data) ;
                        }
                        loading.close()
                    }
                })
                .catch((error) => {
                    this.err = error.response.data.errors; loading.close()
                    loading.close()
                })
            }

        },
        getData() {
            axios.get(this.url+'/'+this.id).then((res) => {
                console.log(res.data);
                if(res.data.status == 1){
                    this.input = res.data.data
                    this.tool_category = JSON.parse(res.data.data.tool_category)
                    this.ability = JSON.parse(res.data.data.ability)
                    this.recomended = JSON.parse(res.data.data.recomended)
                    this.alternate = JSON.parse(res.data.data.alternate)
                    this.maintenance_task = JSON.parse(res.data.data.maintenance_task)
                    this.recomended_tool = JSON.parse(res.data.data.recomended_tool)
                    this.alternate_tool = JSON.parse(res.data.data.alternate_tool)
                    this.related_maintenance = JSON.parse(res.data.data.related_maintenance)
                }else{
                    this.input = {} ,
                    this.tool_category = {}, this.ability = {},
                    this.recomended_tool = {},
                    this.alternate_tool = {},
                    this.maintenance_task = {} ,
                    this.recomended = {},
                    this.alternate = {} ,
                    this.related_maintenance = {} ,
                    this.related_maintenance = []
                }
            })
            .catch((err) => {
                console.log(err);
                this.input = {} ,
                this.tool_category = {}, this.ability = {},
                this.recomended_tool = {},
                this.alternate_tool = {},
                this.maintenance_task = {} ,
                this.recomended = {},
                this.alternate = {} ,
                this.related_maintenance = {} ,
                this.related_maintenance = []
            })
        },
        addRelatedMaintenance(){
            this.related_maintenance.push({
                ref_maintenance : '' ,
                page_parag_maintenance  :'',
                description_maintenance : '' ,
                acceptable_maintenance : '',
                ref_recomended : '',
                page_parag_recomended : '',
                requirement_recomended : '' ,
                ref_alternate : '',
                page_parag_alternate : '',
                requirement_alternate : '',
                compliance : '',
            })
        },
        delRelatedMaintenance(i){
            this.related_maintenance.splice(i, 1);
        },
    }
}
</script>

<style lang="css">
</style>
