<template >
    <div>
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Component Capability Request {{ component_type }}</h1>
                </div>
                <div class="panel-body">
            <ul class="nav nav-tabs">
                <li :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="mainForm()" >Main Form</a></li>
                <li :class="equivalent === true ? 'active' : ''"><a aria-expanded="true" @click="equivalentForm()" >Equivalent Tool/Equipment</a></li>
                <li :class="shopability === true ? 'active' : ''"><a aria-expanded="true" @click="shopabilityForm()" >Shop Ability</a></li>
            </ul>
            <br>
            <!-- mainForm -->
            <div class="form-horizontal" v-show="mainform">
                <div class="form-group">
                    <label class="col-lg-3 control-label">No Request</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" readonly v-model="input.request_number" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> Type Request</label>
                    <div class="col-lg-9">
                        <el-select  onloadedmetadata="" v-model="input.request_type"  clearable placeholder="Select Request type" >
                            <el-option label="Add" value="Add"> </el-option>
                            <el-option label="Delete" value="Delete"> </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> Type Component Request</label>
                    <div class="col-lg-9">
                        <el-select  onloadedmetadata="" v-model="input.component_type"  clearable placeholder="Select Request type" >
                            <el-option label="TCE" value="TCE"> </el-option>
                            <el-option label="TBR" value="TBR"> </el-option>
                            <el-option label="TCA" value="TCA"> </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Part Number</label>
                    <div class="col-sm-9">
                        <el-select  onloadedmetadata="" v-model="input.part_number" multiple  clearable placeholder="Select Request type" >
                            <el-option v-for="pn, i in PartNumber " :key="pn.part_number" :label="pn.part_number" :value="pn.part_number"> </el-option>
                        </el-select>
                        <span v-if="err.part_number" class="text-danger"> {{ err.part_number[0] }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Component Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="input.component_name" placeholder="Component Name">
                        <span v-if="err.component_name" class="text-danger"> {{ err.component_name[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Vendor Manufacturer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="input.vendor_manufacturer" placeholder="Vendor Manufacturer">
                        <span v-if="err.vendor_manufacturer" class="text-danger"> {{ err.vendor_manufacturer[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Aircraft Type</label>
                    <div class="col-sm-9">
                        <el-select v-model="input.aircraft_type" filterable clearable placeholder="Select Aircraft Type" >
                            <el-option v-for="item in AircraftType" :key="item.code" :label="item.aircraft_type" :value="item.aircraft_type"></el-option>
                    </el-select>
                    <span v-if="err.aircraft_type" class="text-danger"> {{ err.aircraft_type[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">ATA Chapter</label>
                    <div class="col-sm-9">
                        <input type="tel" v-mask="'##-##-##'" class="form-control" v-model="input.ata_chapter" placeholder="Ata Chapter">
                        <span v-if="err.ata_chapter" class="text-danger"> {{ err.ata_chapter[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Workshop</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="input.workshop" placeholder="Workshop">
                        <span v-if="err.workshop" class="text-danger"> {{ err.workshop[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">FOR RATING</label>
                    <div class="col-sm-9 checkbox checkbox-replace checkbox-success">
                        <div class="col-md-3" v-for='f, i in ForRating' >
                            <input type="checkbox"  class="form-control"  v-model="rating[f.name_of_rating]">
                            <label for="checkbox6">{{ f.name_of_rating }} </label>
                            <el-select v-if="rating[f.name_of_rating] == true"  v-model="rating[i]" filterable clearable placeholder="Select Aircraft Type" >
                                <el-option v-for="item in $store.state.ForRating.find(t => t.id == f.id).desciption.split(',')" :key="item"
                                    :label="item"
                                    :value="item">
                                </el-option>
                                <input v-if="rating[f.name_of_rating] == true" type="hidden" class="form-control"  v-model="rating[i+'_name'] =  f.name_of_rating">
                            </el-select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" > Approval Request to Cary Out : </label>
                    <div class="col-md-9 checkbox checkbox-replace checkbox-success">
                        <div class="col-md-3 ">
                            <input type="checkbox" class="form-control" v-model='aproval_request_carry_out.inspection'>
                            <label for="checkbox6">Inspection </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox"  class="form-control" v-model='aproval_request_carry_out.testing'>
                            <label for="checkbox6">Testing </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox"  class="form-control" v-model='aproval_request_carry_out.repair'>
                            <label for="checkbox6">Repair </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control" v-model='aproval_request_carry_out.modification'>
                            <label for="checkbox6">Modification  </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control" v-model='aproval_request_carry_out.overhauled'>
                            <label for="checkbox6">Overhauled </label>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Manager Statement </label>
                    <div class="col-sm-9 checkbox checkbox-replace checkbox-success">
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control" v-model='manager_statement.facilities'>
                            <label for="checkbox6">Facilities </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox"  class="form-control" v-model='manager_statement.special_tools'>
                            <label for="checkbox6">Special Tools </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox"  class="form-control" v-model='manager_statement.qualified_personel'>
                            <label for="checkbox6">Qualified Personnel</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control" v-model='manager_statement.approved_data'>
                            <label for="checkbox6">Approved Data </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control" v-model='manager_statement.appropriate_rating'>
                            <label for="checkbox6">Appropriate Rating</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" class="form-control" v-model='manager_statement.special_equipment'>
                            <label for="checkbox6">Special Equipment/Test Equipment</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- equivalent -->
            <div class="form-horizontal" v-show="equivalent">
                <div class="form-group">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">No Anilysis Report</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" v-model="input.equivalent_number">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Rev. No</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" v-model="input.rev_no">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Distribution</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" v-model="input.distribution">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Doc No</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" v-model="input.doc_no">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Reason Issuance</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" v-model="input.reason_issuance">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Effect Maintenance Procedure</label>
                            <div class="col-lg-8">
                                <el-select  onloadedmetadata="" v-model="input.effect_maintenance_procedure"  clearable placeholder="Select Request type" >
                                    <el-option label="Yes" value="1"> </el-option>
                                    <el-option label="No" value="0"> </el-option>
                                </el-select>
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
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Reason Of Revision</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" v-model="input.reason_of_revision">
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-6 text-center"> <u>Recomended Tool/Equipment</u></label>
                    <label class="col-lg-6 text-center"><u>Alternative Tool/Equipment</u></label>
                    <div class="col-lg-6">
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
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-striped table-bordered">
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
                                <tr v-for="d, i in related_maintenance">
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
                    </div>
                </div>
            </div>
            <!-- shop ability form -->
            <div  class="form-horizontal"  v-show="shopability">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Shop Maintenance</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.shop_maintenance" placeholder="Shop Maintenance">
                                <span v-if="err.shop_maintenance" class="text-danger"> {{ err.shop_maintenance[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Number Ability</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.shop_maintenance_no" placeholder="Number Ability">
                                <span v-if="err.shop_maintenance_no" class="text-danger"> {{ err.shop_maintenance_no[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nomenclature</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['NOMENCLATURE']" placeholder="Nomenclature">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Engine</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['ENGINE']" placeholder="Engine">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">APU</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['APU']" placeholder="APU">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type Model</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TYPE MODEL']" placeholder="Type Model">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sytem</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['SYSTEM']" placeholder="System">
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document 1</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['Document 1']" placeholder="Document 1">
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text"  v-model="summary_of_maintenance['Rev Doc 1']" class="form-control" placeholder="Rev, #">
                                    </div>
                                    <div class="col-lg-6">
                                        <el-date-picker
                                            v-model="summary_of_maintenance['Rev Date Doc 1']"
                                            type="date"
                                            placeholder="Rev. Date" value-format="yyyy-MM-dd">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document 2</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['Document 2']" placeholder="Document 2">
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text"  v-model="summary_of_maintenance['Rev Doc 2']" class="form-control" placeholder="Rev, #">
                                    </div>
                                    <div class="col-lg-6">
                                        <el-date-picker
                                        v-model="summary_of_maintenance['Rev Date Doc 2']"
                                        type="date"
                                        placeholder="Rev. Date" value-format="yyyy-MM-dd">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TBO</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TBO']" placeholder="TBO">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Check Period</label>
                            <div class="col-sm-8"><el-date-picker
                                v-model="summary_of_maintenance['CHECK PERIOD']"
                                type="date"
                                placeholder="Check Period" value-format="yyyy-MM-dd">
                                </el-date-picker>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="component_type = 'TCA'" class="line-dashed"></div>
                <div v-if="component_type = 'TCA'" class="form-group">
                    <div class="col-lg-6">
                        <label class="col-lg-12 text-center"> Test Condition :</label>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Temp(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.temp_min" placeholder="Temp(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Temp(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.temp_max" placeholder="Temp(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Humidity(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.humidity_min" placeholder="Humidity(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Humidity(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.humidity_max" placeholder="Humidity(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Press(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.pres_min" placeholder="Press(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Press(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.pres_max" placeholder="Press(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Other</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="test_condition.other" placeholder="Other"></el-input>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-lg-12 text-center"> Storage Condition :</label>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Temp(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.temp_min" placeholder="Temp(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Temp(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.temp_max" placeholder="Temp(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Humidity(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.humidity_min" placeholder="Humidity(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Humidity(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.humidity_max" placeholder="Humidity(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Press(min)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.pres_min" placeholder="Press(min)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Press(max)</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.pres_max" placeholder="Press(max)"></el-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Other</label>
                            <div class="col-lg-8">
                                <el-input type="text" v-model="storage_condition.other" placeholder="Other"></el-input>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Test Equipment <el-button @click="addTestEquipment()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-10">
                        <table class="table table-striped" v-if="list_test_equipment.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_test_equipment">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder="Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.part_name" placeholder="Part Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.available" placeholder="Available"></el-input> </td>
                                    <td v-if="component_type = 'TCA'"> <el-input type="text" v-model="d.alternate_pn" placeholder="Alternate PN"></el-input> </td>
                                    <td v-if="component_type = 'TCA'"> <el-input type="text" v-model="d.alternate_name" placeholder="Alternate Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remarks" placeholder="Remark"></el-input> </td>
                                    <td v-if="list_test_equipment.length != 0"> <el-button @click="delTestEquipment(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Special Tools <el-button @click="addSpecialTools()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-10">
                        <table class="table table-striped" v-if="list_special_tools.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_special_tools">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder="Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.part_name" placeholder="Part Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.available" placeholder="Available"></el-input> </td>
                                    <td v-if="component_type = 'TCA'"> <el-input type="text" v-model="d.alternate_pn" placeholder="Alternate PN"></el-input> </td>
                                    <td v-if="component_type = 'TCA'"> <el-input type="text" v-model="d.alternate_name" placeholder="Alternate Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remarks" placeholder="Remark"></el-input> </td>
                                    <td v-if="list_special_tools.length != 0"> <el-button @click="delSpecialTools(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Available Qualified Personel <el-button @click="personelDialog = true" size="mini" circle icon="fa fa-plus" ></el-button> </label>
                    <div class="col-lg-10">
                        <table class="table table-striped">
                            <tbody>
                                <tr v-for="d, i in list_personel">
                                    <td>
                                        <el-select  v-model="d.qualified_type"  clearable placeholder="Select Request type" >
                                            <el-option label="Nominated Certifying Staff" value="Nominated Certifying Staff"> </el-option>
                                            <el-option label="Nominated Technician" value="Nominated Technician"> </el-option>
                                        </el-select>
                                    </td>
                                    <td> <el-input type="text" v-model="d.name" placeholder="Name of Nominate" ></el-input></td>
                                    <td> <el-input type="text" v-model="d.id_number"  placeholder="Name of Nominate"></el-input></td>
                                    <td> <el-button @click="delPersonel(i)" size="mini" circle icon="fa fa-trash" ></el-button></el-input></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-6 text-center">Material Planning <el-button @click="addMaterialPlanning()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <label class="col-lg-6 text-center">Manhours Planning <el-button @click="addManhoursPlanning()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-6">
                        <table class="table table-striped" v-if="list_material_planning.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_material_planning">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.desciption" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td v-if="list_material_planning.length != 0"> <el-button @click="delMaterialPlanning(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-striped" v-if="list_manhours_planning.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_manhours_planning">
                                    <td> <el-input type="text" v-model="d.task_name" placeholder=" Task Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.man_hours" placeholder=" Man Hours"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.man_power" placeholder=" Man Power"></el-input> </td>
                                    <td v-if="list_manhours_planning.length != 0"> <el-button @click="delManhoursPlanning(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-12 text-center">Consumbale Material  <el-button @click="addConsumableMaterial()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Description </th>
                                    <th>QTY</th>
                                    <th>Remark</th>
                                    <th v-if="list_consumable_material.length != 0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d, i in list_consumable_material">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.desciption" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remark" placeholder=" remak"></el-input> </td>
                                    <td v-if="list_consumable_material.length != 0"> <el-button @click="delConsumableMaterial(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- button save -->
            <div class="line-dashed"></div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button class="btn btn-primary" @click="save()" >Save to Draft</button>
                    <!-- <button class="btn btn-danger" @click="cancel" >Cancel</button> -->
                    <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link>
                    <button class="btn btn-success" @click="submit()" >Save And Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<el-dialog title="Personel List " :visible.sync="personelDialog" >
    <PersonelList @add="addPersonel" />
</el-dialog>
</div>
</template>

<script>
import PersonelList from '../../../../components/PersonelList'
export default {
    components: { PersonelList },
    watch : {
        'input.aircraft_type': function(v, o) {
            if (!v) { return }
            this.summary_of_maintenance['AIRCRAFT TYPE'] = this.input.aircraft_type ;
        },
        'input.ata_chapter': function(v, o) {
            if (!v) { return }
            this.summary_of_maintenance['ATA CHAPTER'] = this.input.ata_chapter ;
        },
        'input.vendor_manufacturer': function(v, o) {
            if (!v) { return }
            this.summary_of_maintenance['MANUFACTURER'] = this.input.vendor_manufacturer ;
        },
        'input.part_number': function(v, o) {
            if (!v) { return }
            this.summary_of_maintenance['PART NUMBER'] = this.input.part_number ;
        }
    },
    props: ['type','component_type'] ,
    computed: {
        AircraftType() { return this.$store.state.AircraftType } ,
        ForRating() { return this.$store.state.ForRating } ,
        PartNumber() { return this.$store.state.PartNumber } ,
    },
    created() {;
        this.$store.commit('getAircraftType');
        this.$store.commit('getForRating');
        this.$store.commit('getPartNumber');
    },
    data() {
        return {
            data : [] , input : {} , err : [], url : BASE_URL + 'submit_component', base_url : BASE_URL,
            mainform : true , equivalent : false, shopability : false ,personelDialog : false , test_condition : {}, storage_condition : {} ,
            rating : {}, manager_statement : {} , aproval_request_carry_out : {} , efectifity : {} , ability : {} ,
            maintenance_task : {}, related_maintenance : [] , recomended : {}, alternate : {}, savalue : {}, summary_of_maintenance : {},
            recomended_tool : {} , alternate_tool : {}, list_personel : [], tool_category : {} ,
            list_test_equipment : [] , list_special_tools : [], list_material_planning : [], list_manhours_planning : [], list_consumable_material : []
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        getData() {
            axios.get(this.url+'/'+this.type).then((res) => {
                this.input = res.data.component_request
                this.input.request_number = res.data.request_number
                if(res.data.component_request.part_number != null){
                    this.input.part_number = res.data.component_request.part_number.split('|')
                }else{
                    this.input.part_number = []
                }
                if(res.data.request_type != null){
                    this.input.request_type = res.data.request_type
                }
                this.rating = JSON.parse(res.data.component_request.for_rating)
                this.aproval_request_carry_out = JSON.parse(res.data.component_request.aproval_request_carry_out)
                this.manager_statement = JSON.parse(res.data.component_request.manager_statement)
                this.ability = JSON.parse(res.data.component_request.ability)
                this.maintenance_task = JSON.parse(res.data.component_request.maintenance_task)
                this.recomended = JSON.parse(res.data.component_request.recomended)
                this.alternate = JSON.parse(res.data.component_request.alternate)
                this.related_maintenance = JSON.parse(res.data.component_request.related_maintenance)
                this.recomended_tool = JSON.parse(res.data.component_request.recomended_tool)
                this.alternate_tool = JSON.parse(res.data.component_request.alternate_tool)
                this.tool_category = JSON.parse(res.data.component_request.tool_category)
                // shopability
                this.input.shop_maintenance = res.data.component_shop_ability.shop_maintenance
                this.input.shop_maintenance_no = res.data.component_shop_ability.shop_maintenance_no
                this.summary_of_maintenance = JSON.parse(res.data.component_shop_ability.summary_of_maintenance)
                this.list_test_equipment = JSON.parse(res.data.component_shop_ability.test_equipment)
                this.list_special_tools = JSON.parse(res.data.component_shop_ability.special_tool)
                this.list_material_planning = JSON.parse(res.data.component_shop_ability.material_planning)
                this.list_manhours_planning = JSON.parse(res.data.component_shop_ability.manhours_planning)
                this.list_consumable_material = JSON.parse(res.data.component_shop_ability.consumable_material)
                this.list_personel = JSON.parse(res.data.component_shop_ability.qualified_personel)

            })
            .catch((err) => {
                console.log(err);
            })
        },
        save(){
            this.input.for_rating = JSON.stringify(this.rating)
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            this.input.capability_level = JSON.stringify(this.aproval_request_carry_out)
            this.input.manager_statement = JSON.stringify(this.manager_statement)
            this.input.ability = JSON.stringify(this.ability)
            this.input.maintenance_task = JSON.stringify(this.maintenance_task)
            this.input.recomended = JSON.stringify(this.recomended)
            this.input.alternate = JSON.stringify(this.alternate)
            this.input.related_maintenance = JSON.stringify(this.related_maintenance)
            this.input.recomended_tool = JSON.stringify(this.recomended_tool)
            this.input.alternate_tool = JSON.stringify(this.alternate_tool)
            this.input.tool_category = JSON.stringify(this.tool_category)
            // shop ability
            this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            this.input.test_equipment = JSON.stringify(this.list_test_equipment)
            this.input.special_tool = JSON.stringify(this.list_special_tools)
            this.input.material_planning = JSON.stringify(this.list_material_planning)
            this.input.manhours_planning = JSON.stringify(this.list_manhours_planning)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.qualified_personel = JSON.stringify(this.list_personel)

            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+this.type, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Submit Success'  });
                    loading.close()
                    this.$router.push('/component_request');
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors; loading.close()
            })
        },
        submit(){
            this.input.submit = 'Yes'
            this.input.for_rating = JSON.stringify(this.rating)
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            this.input.capability_level = JSON.stringify(this.aproval_request_carry_out)
            this.input.manager_statement = JSON.stringify(this.manager_statement)
            this.input.ability = JSON.stringify(this.ability)
            this.input.maintenance_task = JSON.stringify(this.maintenance_task)
            this.input.recomended = JSON.stringify(this.recomended)
            this.input.alternate = JSON.stringify(this.alternate)
            this.input.related_maintenance = JSON.stringify(this.related_maintenance)
            this.input.recomended_tool = JSON.stringify(this.recomended_tool)
            this.input.alternate_tool = JSON.stringify(this.alternate_tool)
            // shop ability
            this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            this.input.test_equipment = JSON.stringify(this.list_test_equipment)
            this.input.special_tool = JSON.stringify(this.list_special_tools)
            this.input.material_planning = JSON.stringify(this.list_material_planning)
            this.input.manhours_planning = JSON.stringify(this.list_manhours_planning)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.qualified_personel = JSON.stringify(this.list_personel)


            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+this.type, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Submit Success'  });
                    loading.close()
                    this.input = {}
                    this.$router.push('/component_request');
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors; loading.close()
            })
        },
        mainForm(){
            this.equivalent = false
            this.shopability = false
            this.mainform = true
        },
        equivalentForm(){
            this.equivalent = true
            this.shopability = false
            this.mainform = false
        },
        shopabilityForm() {
            this.equivalent = false
            this.shopability = true
            this.mainform = false
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
        addTestEquipment(){
            this.list_test_equipment.push({
                part_number : '',
                part_name : '',
                available : '',
                alternate_pn : '',
                alternate_name : '',
                remarks : '',
            })
        },
        delTestEquipment(i){
            this.list_test_equipment.splice(i, 1)
        },
        addSpecialTools(){
            this.list_special_tools.push({
                part_number : '',
                part_name : '',
                available : '',
                alternate_pn : '',
                alternate_name : '',
                remarks : '',
            })
        },
        delSpecialTools(i){
            this.list_special_tools.splice(i, 1)
        },
        addMaterialPlanning(){
            this.list_material_planning.push({
                part_number : '',
                desciption : '',
                qty : '',
            })
        },
        delMaterialPlanning(i){
            this.list_material_planning.splice(i, 1)
        },
        addManhoursPlanning(){
            this.list_manhours_planning.push({
                task_name : '',
                man_hours : '',
                man_power : '',
            })
        },
        delManhoursPlanning(i){
            this.list_manhours_planning.splice(i, 1)
        },
        addConsumableMaterial(){
            this.list_consumable_material.push({
                part_number : '',
                desciption : '',
                qty : '',
                remark : '',
            })
        },
        delConsumableMaterial(i){
            this.list_consumable_material.splice(i, 1)
        },
        addPersonel(p){
            console.log(p);
            this.list_personel.push({
                qualified_type : '',
                name : p.full_name,
                id_number : p.personel_number,
            })
        },
        delPersonel(i){
            this.list_personel.splice(i, 1)
        },
    }
}
</script>
<style lang="css">
</style>
