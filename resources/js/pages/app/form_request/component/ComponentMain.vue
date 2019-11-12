<template >
<div>

    <div class="col-lg-12  z-index-41">
        <div v-if="input.status != undefined && input.status == 1 || input.status == 2 || input.status == 3 || role_request != 2 && (role_request != 3 && input.component_type == 'Engine')" class="panel panel-default  ">
            <div class="panel-body ">
               {{   }}
                <div class="alert alert-danger">You Doesn't Permittion to  Edit This Request</div>
            </div>
        </div>
        <div v-else class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Component Capability Request {{ component_type }}</h1>
            </div>
            <div class="panel-body">
            <ul class="nav nav-tabs">
                <li v-if="idRequest != 0" :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="tab('mainForm')" >Main Form</a></li>
                <li v-if="idRequest != 0" :class="shopability === true ? 'active' : ''"><a aria-expanded="true" @click="tab('shopabilityForm')" >Shop Ability</a></li>
                <li v-if="idRequest != 0" :class="documents === true ? 'active' : ''"><a aria-expanded="true" @click="tab('documentForm')" >Document </a></li>
                <li v-if="idRequest != 0" :class="personel === true ? 'active' : ''"><a aria-expanded="true" @click="tab('personelForm')" >Personnel </a></li>
                <li v-if="idRequest != 0" :class="testEquipment === true ? 'active' : ''"><a aria-expanded="true" @click="tab('testEquipmentForm')" >Tools & Equipment</a></li>
                <li v-if="idRequest != 0" :class="material_manhours === true ? 'active' : ''"><a aria-expanded="true" @click="tab('materialManhoursForm')" >Material & Manhours</a></li>
                <li v-if="idRequest != 0" :class="attachment === true ? 'active' : ''"><a aria-expanded="true" @click="tab('attachmentForm')" >Attachment</a></li>
                <!-- <li :class="note === true ? 'active' : ''" v-if="input.status == 6"><a aria-expanded="false" @click="tab('Note')">Note Resubmit</a></li> -->
            </ul>
            <br>
            <!-- mainForm -->
            <div class="form-horizontal" v-show="mainform">
                <div class="form-group">
                    <label class="col-lg-3 control-label">No Request</label>
                    <div class="col-lg-9">
                      <input type="text" :value="input.request_number || RequestNumber"   placeholder="Number of Request" readonly  class="form-control">
                      <span v-if="err.request_number" class="text-danger"> {{ err.request_number[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> Type Component Request</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" v-model="input.component_type" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"> Type Request</label>
                    <div class="col-lg-9">
                        <div class="col-md-2 radio radio-replace radio-success">
                            <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Add" checked="checked">
                            <label for="radio6">Add</label>
                        </div>
                        <div class="col-md-2 radio radio-replace radio-success">
                            <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Add Change" checked="checked">
                            <label for="radio6">Add Authority</label>
                        </div>
                        <div class="col-md-2 radio radio-replace radio-success">
                            <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Change" checked="checked">
                            <label for="radio6">Change</label>
                        </div>
                        <div class="col-md-2  radio radio-replace radio-success">
                            <input type="radio" disabled  v-model="input.request_type" name="radios2" id="radio6" value="Delete" checked="checked">
                            <label for="radio6">Delete</label>
                        </div>
                        <div class="col-lg-12">
                            <span v-if="err.request_type" class="text-danger"> {{ err.request_type[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Part Number</label>
                    <div class="col-sm-9">
                        <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' || input.request_type == 'Add Change' " onloadedmetadata="" v-model="input.part_number" @change="checkPN" multiple allow-create  filterable clearable placeholder="Select Part Number" >
                            <el-option v-for="(pn, i) in PartNumber " :key="i" :label="pn.part_number+' | ' +pn.part_description" :value="pn.part_number"> </el-option>
                        </el-select>
                        <span v-if="err.part_number" class="text-danger"> {{ err.part_number[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-if="input.request_type == 'Add Change'">
                    <label class="col-sm-3 control-label">Part Number New</label>
                    <div class="col-sm-9">
                        <el-select v-model="input.part_number_new" multiple filterable clearable placeholder="Select Part Number" >
                            <el-option v-for="(pnw, i) in PartNumberNew " :key="i" :label="pnw.part_number+' | ' +pnw.part_description" :value="pnw.part_number"> </el-option>
                        </el-select>
                        <span v-if="err.part_number_new" class="text-danger"> {{ err.part_number_new[0] }}</span>
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
                        <el-select v-model="input.aircraft_type" multiple filterable clearable placeholder="Select Aircraft Type" >
                            <el-option v-for="item in AircraftType" :key="item.code" :label="item.aircraft_type" :value="item.aircraft_type"></el-option>
                        </el-select>
                    <span v-if="err.aircraft_type" class="text-danger"> {{ err.aircraft_type[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">ATA Chapter</label>
                    <div class="col-sm-9">
                        <input type="tel" v-mask="'##-##-##'" class="form-control" v-model="input.ata_chapter" placeholder="ATA Chapter">
                        <span v-if="err.ata_chapter" class="text-danger"> {{ err.ata_chapter[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Workshop</label>
                    <div class="col-sm-9">
                        <el-select  onloadedmetadata="" v-model="input.workshop" clearable placeholder="Select Workshop" >
                            <el-option v-for="wr in Workshop " :key="wr.workshop" :label="wr.workshop" :value="wr.workshop"> </el-option>
                        </el-select>
                        <!-- <input type="text" class="form-control" v-model="input.workshop" placeholder="Workshop"> -->
                        <span v-if="err.workshop" class="text-danger"> {{ err.workshop[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">FOR RATING</label>
                    <div class="col-sm-9 checkbox checkbox-replace checkbox-success" >
                        <div class="col-md-3" v-for='(f, i) in ForRating' :key="i" style="height:50px;">
                            <input type="checkbox"  :disabled="input.request_type == 'Change' || ((rating[f.name_of_rating] == null  || fixedRatingForChange[f.name_of_rating] == false) && input.request_type == 'Delete') || (fixedRatingForChange[f.name_of_rating]  == true  && input.request_type == 'Add Change')" class="form-control"  v-model="rating[f.name_of_rating]">
                            <label for="checkbox6">{{ f.name_of_rating }} </label>
                            <el-select :disabled="(input.request_type == 'Add Change' && fixedRatingForChange[f.name_of_rating] == true) || input.request_type == 'Change'" v-if="rating[f.name_of_rating] == true"  v-model="rating[i]" filterable clearable placeholder="Select Rating" >
                                <el-option v-for="item in $store.state.ForRating.find(t => t.id == f.id).desciption.split(',')" :key="item"
                                    :label="item"
                                    :value="item">
                                </el-option>
                            </el-select>
                            <div class="hidden">
                                {{ rating[i+'_name'] =  f.name_of_rating }}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <span v-if="err.for_rating" class="text-danger"> {{ err.for_rating[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" > Approval Request to Cary Out : </label>
                    <div class="col-md-9 checkbox checkbox-replace checkbox-success">
                        <div class="col-md-3 ">
                            <input type="checkbox" :disabled="input.request_type == 'Add Change' || input.request_type == 'Delete'" class="form-control" v-model='aproval_request_carry_out.inspection'>
                            <label for="checkbox6">Inspection </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" :disabled="input.request_type == 'Add Change' || input.request_type == 'Delete'" class="form-control" v-model='aproval_request_carry_out.testing'>
                            <label for="checkbox6">Testing </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" :disabled="input.request_type == 'Add Change' || input.request_type == 'Delete'" class="form-control" v-model='aproval_request_carry_out.repair'>
                            <label for="checkbox6">Repair </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" :disabled="input.request_type == 'Add Change' || input.request_type == 'Delete'" class="form-control" v-model='aproval_request_carry_out.modification'>
                            <label for="checkbox6">Modification  </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" :disabled="input.request_type == 'Add Change' || input.request_type == 'Delete'" class="form-control" v-model='aproval_request_carry_out.overhauled'>
                            <label for="checkbox6">Overhauled </label>
                        </div>
                        <div class="col-lg-12">
                            <span v-if="err.aproval_request_carry_out" class="text-danger"> {{ err.aproval_request_carry_out[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Limitation</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control" v-model="input.limitation" placeholder="Limitation">
                        <span v-if="err.limitation" class="text-danger"> {{ err.limitation[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Manager Statement </label>
                    <div class="col-sm-9 checkbox checkbox-replace checkbox-success">
                        <p >
                            I certify that my department has capability to maintain the above mention items, according to
                            AMO Manual 1.9.21 MOE 1.9.5/ RSQM 1.9.2 requirement and items with Cross (X) sign below
                            have been provided.
                        </p>
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
                        <div class="col-lg-12">
                            <span v-if="err.manager_statement" class="text-danger"> {{ err.manager_statement[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="input.request_type == 'Delete'">
                    <label class="col-sm-3 control-label">Remark Delete</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="input.remark_deletion" placeholder="Vendor Remark Deletion">
                        <span v-if="err.remark_deletion" class="text-danger"> {{ err.remark_deletion[0] }}</span>
                    </div>
                </div>
            </div>

            <!-- shop ability untuk engine component -->
            <div class="form-horizontal" v-if="role_request == 3 && shopability == true">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Shop Maintenance</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly v-model="input.workshop" placeholder="Shop Maintenance">
                                <span v-if="err.workshop" class="text-danger"> {{ err.workshop[0] }}</span>
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
                            <label class="col-sm-4 control-label">Owner Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['OWNER CODE']" placeholder="Owner Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nomenclature</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['NOMENCLATURE']" placeholder="Nomenclature">
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
                            <label class="col-sm-4 control-label">TBO</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TBO']" placeholder="TBO">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Check Period</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['CHECK PERIOD']" placeholder="Check Period">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type Model</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TYPE MODEL']" placeholder="Type Model">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Manufacturer Documentation Drawing</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.manufacture_documentation_drawing" placeholder="Manufacturer Documentation Drawing">
                                <span v-if="err.manufacture_documentation_drawing" class="text-danger"> {{ err.manufacture_documentation_drawing[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Inspection Schema</label>
                            <div class="col-sm-8">
                                <textarea name="name" class="form-control"  v-model="input.inspection"></textarea>
                                <!-- <input type="text" class="form-control" v-model="input.inspection" placeholder="Inspection Schema"> -->
                                <span v-if="err.inspection" class="text-danger"> {{ err.inspection[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tool / Equipment</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.tool_equipment" placeholder="Tool / Equipment">
                                <span v-if="err.tool_equipment" class="text-danger"> {{ err.tool_equipment[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Special Work to Be Order </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.special_work" placeholder="Special Work to Be Order">
                                <span v-if="err.special_work" class="text-danger"> {{ err.special_work[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Particulars</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.particular" placeholder="Particulars">
                                <span v-if="err.particular" class="text-danger"> {{ err.particular[0] }}</span>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-4 control-label">Available Qualified Personel</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.available_qualified" placeholder="Available Qualified Personel">
                                <span v-if="err.available_qualified" class="text-danger"> {{ err.available_qualified[0] }}</span>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-12 text-center">Consumable Material  <el-button @click="addConsumableMaterial()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Description </th>
                                    <th>QTY</th>
                                    <th>Remark</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  :v-if="role_request == 3 && shopability == true" v-for="(d, i) in list_consumable_material" :key="i">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.description" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remark" placeholder="Remark"></el-input> </td>
                                    <td > <el-button @click="delConsumableMaterial(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- shop ability form untuk component-->
            <div  class="form-horizontal"  v-if="role_request == 2 && shopability == true">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Number Ability</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.shop_maintenance_no" placeholder="Number Ability">
                                <span v-if="err.shop_maintenance_no" class="text-danger"> {{ err.shop_maintenance_no[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group" v-if="component_type === 'TBR' || component_type === 'TNO'">
                            <label class="col-sm-4 control-label">OWNER CODE</label>
                            <div class="col-sm-8">
                                <input type="text" v-if="component_type === 'TBR' || component_type === 'TNO'" class="form-control" v-model="summary_of_maintenance['OWNER CODE']" placeholder="Owner Code">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group"  v-if="component_type === 'TCE'">
                            <label class="col-sm-4 control-label">Engine</label>
                            <div class="col-sm-8">
                                <input type="text" v-if="component_type === 'TCE'" class="form-control" v-model="summary_of_maintenance['ENGINE']" placeholder="Engine">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group"  v-if="component_type === 'TCE'">
                            <label class="col-sm-4 control-label">APU</label>
                            <div class="col-sm-8">
                                <input type="text" v-if="component_type === 'TCE'" class="form-control" v-model="summary_of_maintenance['APU']" placeholder="APU">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type Model</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TYPE MODEL']" placeholder="Type Model">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Check Period</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['CHECK PERIOD']" placeholder="CHECK PERIOD">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TBO</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TBO']" placeholder="TBO">
                            </div>
                        </div>
                        <div class="form-group"  v-if="component_type != 'TCE'" >
                            <label class="col-sm-4 control-label">Sytem</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['SYSTEM']" placeholder="System">
                                <span v-if="err.summary_of_maintenance" class="text-danger"> {{ err.summary_of_maintenance[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                </div>
                <div v-if="component_type == 'TCA'" class="line-dashed"></div>
                <div v-if="component_type == 'TCA'" class="form-group">
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
                    <label class="col-lg-12 text-center">Consumable Material  <el-button @click="addConsumableMaterial()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Description </th>
                                    <th>QTY</th>
                                    <th>Remark</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  :v-if="role_request == 2 && shopability == true" v-for="(d, i) in list_consumable_material" :key="i">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.description" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remark" placeholder="Remark"></el-input> </td>
                                    <td > <el-button @click="delConsumableMaterial(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-horizontal" v-show='personel'>
                <el-button @click="showDialogPersonel(null, null)" size="mini" round icon="fa fa-plus" >Add Personnel</el-button>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Nominate</th>
                                <th>Name</th>
                                <th>Id Number</th>
                                <th>Attachment</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_personel" :key="i">
                                <td> {{ d.nominate }}</td>
                                <td> {{ d.name }}</td>
                                <td> {{ d.id_number }}</td>
                                <td>
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/personel/'+d.training_certificate">{{ d.training_certificate }}</a> <br v-if="d.training_certificate != null">
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/personel/'+d.personal_ability">{{ d.personal_ability }}</a> <br v-if="d.certificate_competence != null ">
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/personel/'+d.certificate_competence">{{ d.certificate_competence }}</a> <br v-if="d.staff_authorization != null">
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/personel/'+d.staff_authorization">{{ d.staff_authorization }}</a>
                                </td>
                                <td>
                                     <el-button @click="delPersonel(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                     <el-button @click="showDialogPersonel(i, d)" size="mini" circle icon="fa fa-pencil" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-horizontal" v-show='documents'>
                <div class="table-responsive">
                    <el-button @click="documentDialog = true, id_document = null, index_document = null" size="mini" round icon="fa fa-plus" >Add Document</el-button>
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Document</th>
                                <th>Rev</th>
                                <th>Rev Date</th>
                                <th>document type</th>
                                <th>Attachment</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_document" :key="i">
                                <td>{{ d.no_document }}</td>
                                <td>{{ d.rev }}</td>
                                <td>{{ d.rev_date }}</td>
                                <td>{{ d.document_type }}</td>
                                <td>
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/document/'+d.manual_status_confirmation">
                                        {{ d.manual_status_confirmation}}
                                    </a><br v-if="d.manual_status_confirmation != null">
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/document/'+d.component_maintenance_manual">
                                        {{d.component_maintenance_manual}}
                                    </a><br v-if="d.component_maintenance_manual != null">
                                    <a @click="popupAttachmentDialog = true, link = 'uploads/component/document/'+d.proposed_pd_sheet">
                                        {{ d.proposed_pd_sheet }}
                                    </a>
                                </td>
                                <td>
                                    <el-button @click="documentDialog = true, id_document = d.id, index_document = i" size="mini" circle icon="fa fa-pencil" ></el-button>
                                    <el-button @click="delDocument(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-horizontal" v-show="testEquipment">
                <div class="table-responsive">
                    <el-button @click="testEquipmentDialog = true, id_test_equipment = null, index_test_equipment = null" size="mini" round icon="fa fa-plus" >Test Equipment </el-button>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Part Name</th>
                                <th>Available</th>
                                <th v-if="component_type == 'TCA'">Alternate PN</th>
                                <th v-if="component_type == 'TCA'">Alternate Name</th>
                                <th>Equivalent</th>
                                <th>Remark</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_test_equipment" :key="i">
                                <td> {{ d.part_number }}</td>
                                <td> {{ d.part_name }}</td>
                                <td> {{ d.available }}</td>
                                <td v-if="component_type == 'TCA'"> {{ d.alternate_pn }}</td>
                                <td v-if="component_type == 'TCA'">{{ d.alternate_name }} </td>
                                <td> <a @click="popupAttachmentDialog = true, link = 'uploads/component/test_equipment/'+d.attachment">{{ d.attachment }}</a></td>

                                <!-- <td> <button type="button" :class="d.equivalent == null ? 'btn btn-xs btn-primary':'btn btn-xs btn-success' " name="button" @click="addEquivalent(d.id, i)" > Add Equivalent </button> </td> -->
                                <td> {{ d.remark }} </td>
                                <td v-if="list_test_equipment.length != 0">
                                  <el-button @click="testEquipmentDialog = true, id_test_equipment = d.id, index_test_equipment = i" size="mini" circle icon="fa fa-pencil" ></el-button>
                                  <el-button @click="delTestEquipment(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="line-dashed"> </div>
                    <el-button @click="SpecialToolDialog = true, id_special = null, index_special = null" size="mini" round icon="fa fa-plus" >Special Tools </el-button>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Part Name</th>
                                <th>Available</th>
                                <th v-if="component_type == 'TCA'">Alternate PN</th>
                                <th v-if="component_type == 'TCA'">Alternate Name</th>
                                <th>Equivalent</th>
                                <th>Remark</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_special_tools" :key="i">
                                <td> {{ d.part_number }}</td>
                                <td> {{ d.part_name }}</td>
                                <td> {{ d.available }}</td>
                                <td v-if="component_type == 'TCA'"> {{ d.alternate_pn }}</td>
                                <td v-if="component_type == 'TCA'">{{ d.alternate_name }} </td>
                                <td> <a @click="popupAttachmentDialog = true, link = 'uploads/component/special_tools/'+d.attachment">{{ d.attachment }}</a> </td>
                                <td> {{ d.remark }} </td>
                                <td v-if="list_special_tools.length != 0">
                                  <el-button @click="SpecialToolDialog = true, id_special = d.id, index_special = i" size="mini" circle icon="fa fa-pencil" ></el-button>
                                  <el-button @click="delSpecialTools(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-horizontal" v-show="material_manhours">
                <div class="table-responsive">
                    <el-button @click="MaterialPlanningDialog = true, id_material = null, index_material = null" size="mini" round icon="fa fa-plus" >Material Planning</el-button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Part Description</th>
                                <th>qty</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_material_planning" :key="i">
                                <td> {{ d.part_number }} </td>
                                <td> {{ d.part_description }} </td>
                                <td> {{ d.qty }} </td>
                                <td v-if="list_material_planning.length != 0">
                                    <el-button @click="MaterialPlanningDialog = true, id_material = d.id, index_material = i" size="mini" circle icon="fa fa-pencil" ></el-button>
                                    <el-button @click="delMaterialPlanning(d.id)" size="mini" circle icon="fa fa-trash" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="line-dashed"> </div>
                    <el-button @click="ManhoursPlanningDialog = true, id_manhours = null, index_manhours = null" size="mini" round icon="fa fa-plus" >    Manhours Planning</el-button>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Man Hours</th>
                                <th>Man Power</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, i) in list_manhours_planning" :key="i">
                                <td> {{ d.task_name }} </td>
                                <td> {{ d.man_hour }} hours </td>
                                <td> {{ d.man_power }} </td>
                                <td v-if="list_manhours_planning.length != 0">
                                    <el-button @click="ManhoursPlanningDialog = true, id_manhours = d.id, index_manhours = i" size="mini" circle icon="fa fa-pencil" ></el-button>
                                    <el-button @click="delManhoursPlanning(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-horizontal" v-show="attachment">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Attach File</label>
                    <div class="col-lg-9">
                        <el-button @click="addAttachment" size="mini" round icon="fa fa-docs" > Add Attachment </el-button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">List Attachment</label>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-4"> Vendor Statement "No training needed"</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+file.vendor_statement ">{{ file.vendor_statement }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">Simple Component Evaluation Document (EI)</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+file.simple_component_evaluation ">{{ file.simple_component_evaluation }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> Component Similarity Form</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+file.component_similarity ">{{ file.component_similarity }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> Maintenance Record for Demo/Experimental</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+file.maintenance_record ">{{ file.maintenance_record }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> Sample of component relased record</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+file.sample_component_relase ">{{ file.sample_component_relase }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> Others</div>
                            <div class="col-lg-8">:
                                <a @click="popupAttachmentDialog = true, link = 'uploads/component/attachment/'+d.other">{{ file.other }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div v-show='note' class="form-horizontal">
                <el-button @click="NoteDialog = true "  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Attachment</th>
                                <th>Note</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="d , i in list_note">
                                <td>{{ d.attachment }} </td>
                                <td>{{ d.note }} </td>
                                <td> <a @click="delAttachmentResubmit(d, i)"><i class="icon-trash"></i> </a> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->

            <!-- button save -->
            <div class="line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <button class="btn btn-primary" @click="idRequest == 0 ? firstSave() : save()" >Save to Draft</button>
                    <button class="btn btn-danger" @click="cancel" >Cancel</button>
                    <!-- <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link> -->
                    <!-- <button class="btn btn-success" @click="submit()" >Save And Submit</button> -->
                    <button v-if="idRequest != 0" class="btn btn-success" @click="input.status == 6 ? beforeSubmit() : submit()" >
                        {{ input.status == 6 ? 'Save And re-Submit' : 'Save And Submit'}}
                    </button>
                    <button v-if="idRequest != 0" class="btn btn-primary" @click="save('preview')" >Save to Preview</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <el-dialog title="Note Attachment " :visible.sync="NoteDialog" >
        <attachmentResubmit :id="type" :type="'component'" @add="addAttachmentResubmit" />
    </el-dialog>

    <el-dialog title="Personnel List " :visible.sync="personelDialog" >
        <div v-loading="loading">
          <personoel v-if="personelDialog == true && getdatapersonel.length >= 1"      @addPersonel="addPersonel" :getdatapersonel='getdatapersonel' :index_personel="index_personel" :id_request='type'  :id='id_personel' :list_personel="list_personel"  />
        </div>
        <div v-if="this.errorMessage != null" class="text-center">
            <p> {{ this.errorMessage }} </p>
            <br>
            <el-button type='primary' icon='el-icon-refresh' @click="getDataPersonel()"> Reload </el-button>
        </div>
        <br>
        <br>
    </el-dialog>

    <el-dialog title="Document " :visible.sync="documentDialog"  @keydown.esc="documentDialog = false">
        <Documents :id='type' v-if="documentDialog == true"   :index_document="index_document"  :id_document="id_document" @addDocument="addDocument" />
    </el-dialog>

    <el-dialog title="Test Equipment " :visible.sync="testEquipmentDialog" >
        <TestEquipment v-if="testEquipmentDialog == true" :id='type' :id_test_equipment="id_test_equipment" :index_test_equipment="index_test_equipment" :component_type='component_type' @addTestEquipment="addTestEquipment" />
    </el-dialog>

    <el-dialog title="Special Tool " :visible.sync="SpecialToolDialog" >
        <SpecialTool v-if="SpecialToolDialog == true" :id='type' :id_special="id_special" :index_special="index_special" :component_type='component_type' @addSpecial="addSpecial"  />
    </el-dialog>

    <el-dialog title="Material Planning " :visible.sync="MaterialPlanningDialog" >
        <MaterialPlanning v-if="MaterialPlanningDialog == true" :id='type' :id_material="id_material" :index_material="index_material" @addMaterialPlanning="addMaterialPlanning" />
    </el-dialog>

    <el-dialog title="Manhours Planning " :visible.sync="ManhoursPlanningDialog" >
        <ManhoursPlanning v-if="ManhoursPlanningDialog == true" :id='type' :id_manhours="id_manhours" :index_manhours="index_manhours" @addManhoursPlanning="addManhoursPlanning"  />
    </el-dialog>

    <el-dialog title="Equivalent Form " width="70%" :visible.sync="equivalentDialog" >
        <Equivalents v-if="equivalentDialog == true" :id='id_test_equipment' :index="index_equivalent" @addEq="addEq" />
    </el-dialog>

    <el-dialog title="Attachment Form " :visible.sync="attachmentDialog" >
        <attachment v-if="attachmentDialog == true"  :id='type' :type='input.document_type' :file="file" @loadAttachment="loadAttachment" />
    </el-dialog>

    <el-dialog title="Popup Attachment"  width="70%" :visible.sync="popupAttachmentDialog" >
        <popupAttachment v-if="popupAttachmentDialog == true"  :link="link" />
    </el-dialog>

    <el-dialog title="Note and attachment " :visible.sync="note" >
        <div class="form-group">
        </div>
        <div class="form-group" v-if="input.status == 6">
            <label class="col-md-3 label-control">Note Resubmit</label>
            <div class="col-md-9">
                <textarea type="text" v-if="input.status == 6" class="form-control" v-model="input.note" name="" value=""></textarea>
            </div>
        </div>
        <el-button @click="NoteDialog = true "  size="mini" icon="fa fa-cloud-upload  " round > Upload Images </el-button>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>Attachment</th>
                        <th>Note</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(d , i) in list_note" :key="i">
                        <td>{{ d.attachment }} </td>
                        <td>{{ d.note }} </td>
                        <td> <a @click="delAttachmentResubmit(d, i)"><i class="icon-trash"></i> </a> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button class="btn btn-success" @click="submit('resubmit')" >re-SUbmit</button>
                <button class="btn btn-danger" @click="note = false" >Cancel</button>
              </div>
        </div>
    </el-dialog>
</div>

</template>

<script>

import personoel from './personel'
import Documents from './document'
import TestEquipment from './TestEquipment'
import SpecialTool from './SpecialTool'
import MaterialPlanning from './MaterialPlanning'
import ManhoursPlanning from './ManhoursPlanning'
import Equivalents from './Equivalents'
import attachment from './attachment'
import popupAttachment from '../../popupAttachment'
import attachmentResubmit from './../attachmentResubmit'

export default {
    components: { popupAttachment,  personoel, Documents, TestEquipment, SpecialTool, MaterialPlanning, ManhoursPlanning, Equivalents, attachment, attachmentResubmit },
    props: ['type','component_type'] ,
    computed: {
        AircraftType() { return this.$store.state.AircraftType } ,
        ForRating() { return this.$store.state.ForRating } ,
        PartNumber() { return this.$store.state.PartNumber } ,
        PartNumberNew() { return this.$store.state.PartNumberNew } ,
        Workshop() { return this.$store.state.Workshop } ,
        RequestNumber() { return this.$store.state.RequestNumber } ,
    },
    created() {;
        this.$store.state.type_of_request = 'component'
        this.$store.commit('getRequestNumber');
        this.$store.commit('getAircraftType');
        this.$store.commit('getForRating');
        this.$store.commit('getPartNumber');
        this.$store.commit('getPartNumberNew');
        this.$store.commit('getWorkshop');
        this.$store.commit('getcheckPNComponent');
    },
    data() {
        return {
            idRequest : this.type ,
            link : '', popupAttachmentDialog : false ,
            id_document : '', index_document : '', id_manhours : '', index_manhours : '' , id_material : '', index_material : '',
            documents : false, personel : false , testEquipment : false, material_manhours : false , consumableMaterial : false , equivalentDialog : false,
            list_document : [] , documentDialog : false , testEquipmentDialog : false , SpecialToolDialog : false, MaterialPlanningDialog : false, ManhoursPlanningDialog: false,
            data : [] , input : {} , err : [], url : BASE_URL + 'submit_component', base_url : BASE_URL, role_request : ROLE_REQUEST ,
            mainform : true , shopability : false ,personelDialog : false , test_condition : {}, storage_condition : {} , attachmentDialog : false,
            rating : {}, manager_statement : {} , aproval_request_carry_out : {} , efectifity : {} , ability : {} , attachment : false,
            maintenance_task : {}, related_maintenance : [] , recomended : {}, alternate : {}, savalue : {}, summary_of_maintenance : {},
            recomended_tool : {} , alternate_tool : {}, list_personel : [], tool_category : {} , id_test_equipment : '', index_equivalent : '', file : {},
            list_test_equipment : [] , list_special_tools : [], list_material_planning : [], list_manhours_planning : [], list_consumable_material : [],
            note : false , list_note : [], NoteDialog : false , fixedRatingForChange : {},
            index_personel : '', id_personel : null, id_test_equipment : '', index_test_equipment : '', id_special : '', index_special : '',
            getdatapersonel : [], loading : 'false', errorMessage : null
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        getDataPersonel(){
            if(this.getdatapersonel.length >= 1){
              return ''
            }
            this.errorMessage = null
            this.loading = true
            axios.get(BASE_URL+'store/user_soe/getPersonel').then((res) => {
                this.getdatapersonel = res.data
            })
            .catch((err) => {
                 if(err.response.data.message.includes('cURL error 28')){
                    this.errorMessage = 'Request Time out, Please Reload'
                 }
                 if(err.response.data.message.includes('cURL error 7')){
                    this.errorMessage = 'No Connection to Data Api, Please Contact Team TO for check this problem'
                 }
            })
            .finally(() => {
              this.loading = false
            })
        },
        showDialogPersonel(i, ap){
            this.getDataPersonel()
            this.personelDialog = true
            this.index_personel = i
            this.id_personel = ap.id
        },
        firstSave(){
          if(jQuery.isEmptyObject(this.rating)){
            this.input.for_rating = null
          }else{
            this.input.for_rating = JSON.stringify(this.rating)
          }
          if(jQuery.isEmptyObject(this.aproval_request_carry_out)){
            this.input.aproval_request_carry_out = null
          }else{
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
          }
          if(jQuery.isEmptyObject(this.manager_statement)){
            this.input.manager_statement = null
          }else{
            this.input.manager_statement = JSON.stringify(this.manager_statement)
          }

          // shop ability
          this.input.capability_level = JSON.stringify(this.aproval_request_carry_out)
          this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)


          const loading = this.$loading({  lock: true,  text: 'Loading',  spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
          axios.post(this.url, this.input).then((res) => {
              if(res.data.status == 1){
                this.getData()
                if(this.idRequest == 0){
                  this.$router.push({ name: 'form_component_data', params: { type: res.data.id, component_type : res.data.type } })
                  this.input.request_id = res.data.id
                  this.getData(res.data.id)
                }
                this.getData(res.data.id)
                this.$message({  type: 'success', message: 'Save to Draft Success'  });
                loading.close()
                this.scrollToTop()
                this.err = []
              }else{
                  loading.close()
                  this.$alert('Create Request Failed', 'Warning', {
                      confirmButtonText: 'OK',
                  });
              }
              console.log(res.data);
          })
          .catch((error) => {
              this.err = error.response.data.errors; loading.close()
              console.log(error);
          })
        },
        checkPN(){
          var PN = this.input.part_number[this.input.part_number.length-1]
          var cek = this.$store.state.checkPNComponent.filter(pn => pn.part_number == PN).length
          if(cek >= 1){
              this.$alert("Selected Part Number ("+PN+") already exist in system. Please select menu Add Part Number and/or Add Authority or Change Request.", 'Warning', { confirmButtonText: 'OK', })
              this.input.part_number.splice((this.input.part_number.length-1), 1)
          }
        },
        beforeSubmit(){
          this.$confirm('Do You Want to Save with Upload and Note  ?', 'Warning', {  confirmButtonText: 'Yes', cancelButtonText: 'No', type: 'warning'}).then(() => {
              this.note = true
          }).catch(() => {
              this.submit()
          });
        },
        addAttachment(){
            this.attachmentDialog = true
        },
        addEquivalent(id, i ){
            this.id_test_equipment = id
            this.index_equivalent = i
            this.equivalentDialog = true
        },
        getData(id) {
            if(id == undefined || id == null){
                this.idRequest = this.type
                this.input.status = 0
            }else{
                this.idRequest = id
            }

            const loading = this.$loading({  lock: true,  text: 'Loading',  spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
            if(this.idRequest == 0){
                loading.close();
                this.input.request_type = 'Add'
                this.input.component_type = this.component_type
                return
            }

            axios.get(this.url+'/'+this.idRequest).then((res) => {
                console.log(res.data);
                loading.close()
                this.input = res.data.component_request
                this.input.note = null
                this.input.status = res.data.status
                this.input.request_number = res.data.request_number
                this.input.manufacture_documentation_drawing = res.data.component_shop_ability.manufacture_documentation_drawing
                this.input.inspection = res.data.component_shop_ability.inspection
                this.input.tool_equipment = res.data.component_shop_ability.tool_equipment
                this.input.special_work = res.data.component_shop_ability.special_work
                this.input.particular = res.data.component_shop_ability.particular
                this.input.available_qualified = res.data.component_shop_ability.available_qualified

                if(res.data.component_request.part_number != null){
                    this.input.part_number = res.data.component_request.part_number.split('|')
                }else{
                    this.input.part_number = []
                }
                if(res.data.component_request.part_number_new != null){
                    this.input.part_number_new = res.data.component_request.part_number_new.split('|')
                }else{
                    this.input.part_number_new = []
                }
                if(res.data.component_request.aircraft_type != null){
                    this.input.aircraft_type = res.data.component_request.aircraft_type.split('|')
                }else{
                    this.input.aircraft_type = []
                }
                this.input.request_type = res.data.request_type
                //
                if(res.data.component_request.for_rating != null){
                    this.rating = JSON.parse(res.data.component_request.for_rating)
                    this.fixedRatingForChange = JSON.parse(res.data.component_request.for_rating)
                }
                if(res.data.component_request.aproval_request_carry_out !=  null){
                    this.aproval_request_carry_out = JSON.parse(res.data.component_request.aproval_request_carry_out)
                }
                if(res.data.component_request.manager_statement != null){
                    this.manager_statement = JSON.parse(res.data.component_request.manager_statement)
                }

                this.list_personel = res.data.component_personel
                this.list_document =  res.data.component_document
                this.list_test_equipment =  res.data.component_test_equipment
                this.list_special_tools =  res.data.component_special_tool
                this.list_material_planning =  res.data.component_material_planning
                this.list_manhours_planning =  res.data.component_manhours_planning
                this.list_note = res.data.attachment_resubmit
                this.input.status = res.data.status
                // shopability
                this.input.shop_maintenance_no = res.data.component_shop_ability.shop_maintenance_no
                if(res.data.component_shop_ability.summary_of_maintenance != null){
                    this.summary_of_maintenance = JSON.parse(res.data.component_shop_ability.summary_of_maintenance)
                }
                if(this.component_type === 'TCA'){
                    if(res.data.component_shop_ability.storage_condition != null){
                        this.storage_condition = JSON.parse(res.data.component_shop_ability.storage_condition)
                    }
                    if(res.data.component_shop_ability.test_condition != null){
                        this.test_condition = JSON.parse(res.data.component_shop_ability.test_condition)
                    }
                }
                if (res.data.component_attachment != null) {
                    this.file = res.data.component_attachment
                }
                this.list_consumable_material = JSON.parse(res.data.component_shop_ability.consumable_material)

            })
            .catch( (error) => {
                loading.close()
                console.log(error);
            })
        },
        save(preview){

            this.input.for_rating = JSON.stringify(this.rating)
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            this.input.capability_level = JSON.stringify(this.aproval_request_carry_out)
            this.input.manager_statement = JSON.stringify(this.manager_statement)

            // shop ability
            this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.test_condition = JSON.stringify(this.test_condition)
            this.input.storage_condition = JSON.stringify(this.storage_condition)
            if(preview == 'preview'){
              var text = '& Prerview '
            }else{
              var text = ''
            }

            this.$confirm('Do You Want Save to Draft '+text+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
              axios.put(this.url+'/'+this.type, this.input).then((res) => {
                if(res.data.status == 1){
                  if(preview == 'preview'){
                    window.open(this.url+"/detail/"+this.type, '_blank')
                  }else{
                    // this.$router.push('/special_request');
                    // this.input = {}
                    this.scrollToTop()
                    this.$message({  type: 'success', message: 'Save to Draft Success'  });
                    this.$router.push('/component_request');
                  }
                  loading.close()
                }
              })
              .catch((error) => {
                this.err = error.response.data.errors;
                loading.close()
              })
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        submit(type){
            var cek_consumable_material = this.list_consumable_material.filter(cek => cek.part_number == '' && cek.description == '' )
            if(Object.keys(this.rating).length != 0){
                this.input.for_rating = JSON.stringify(this.rating)
            }else{
                this.input.for_rating = null
            }
            if(Object.keys(this.aproval_request_carry_out).length != 0){
                this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            }else{
                this.input.aproval_request_carry_out = null
            }
            if(Object.keys(this.manager_statement).length != 0){
                this.input.manager_statement = JSON.stringify(this.manager_statement)
            }{
                this.input.manager_statement = null
            }
            if(Object.keys(this.summary_of_maintenance).length != 0){
                this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            }

            if(cek_consumable_material.length >= 1){
                this.$alert("Please Fill Field Part Number & Part Desciption Consumable Material", 'Warning', { confirmButtonText: 'OK', });
                this.tab('shopabilityForm')
                return
            }

            if (this.list_document.length == 0) {
                this.$alert("Document Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.tab('documentForm')
            }
            if(this.list_personel.length == 0) {
                this.$alert("Personnel Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.tab('personelForm')
            }

            if(this.list_manhours_planning.length == 0 && this.role_request == 2) {
                this.$alert("Manhours Planning Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.tab('materialManhoursForm')
                return
            }
            if(this.input.document_type == 'Maintenance Manual'){
                if(this.file.manual_status_confirmation == null && this.file.component_maintenance_manual == null){
                    var manual_cek = 'no'
                    this.$alert("manual status confirmation or component maintenance manual can't be null", 'Warning', { confirmButtonText: 'OK', }); this.tab('attachmentForm')
                }else{
                    var manual_cek = 'yes'
                    var instruction = 'yes'
                }
            }

            this.input.submit = 'yes'
            this.input.for_rating = JSON.stringify(this.rating)
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            this.input.capability_level = JSON.stringify(this.aproval_request_carry_out)
            this.input.manager_statement = JSON.stringify(this.manager_statement)

            // shop ability
            this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.test_condition = JSON.stringify(this.test_condition)
            this.input.storage_condition = JSON.stringify(this.storage_condition)

            if( cek_consumable_material.length == 0
                // && cek_available_test_equipment.length == 0 && this.file.proposed_pd_sheet != null
                // && manual_cek == 'yes' && instruction == 'yes'
               ){
                if( this.list_document.length >= 1 && this.list_personel.length >= 1
                   // && this.list_test_equipment.length >= 1 && this.list_special_tools.length >= 1
                    // && this.list_consumable_material.length >= 1 && this.list_material_planning.length >= 1
                  ){
                      if(this.input.status == 6 && type != 'resubmit' ){
                          var request = 'without Upload Document'
                      }else{
                          var request = ''
                      }

                      this.$confirm('Do You Want to Submit this Request '+request+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                        const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                        axios.put(this.url+'/submitrequest/'+this.type, this.input).then((res) => {
                          if(res.data.status == 1){
                            this.$alert("Submit With Request Number "+this.input.request_number+" Success", 'Success', { confirmButtonText: 'OK', });
                            this.input = {}
                            this.$router.push('/component_request');
                            this.scrollToTop()
                          }else if(res.data.status == 2){
                            this.$alert("Part Number "+ res.data.note +" Already used, Please (Add Change) if you want to Add Authority or (Delete) if you want Delete Authority on menu Request", 'Warning', { confirmButtonText: 'OK', });
                          }
                          loading.close()
                        })
                        .catch((error) => {
                          this.err = error.response.data.errors; loading.close()
                        })
                      }).catch(() => {
                          this.$message({ type: 'info', message: 'Submit Canceled' });
                      });
                    }
            }
        },
        addPersonel(d){
            if(d.index_personel == null ){
                this.list_personel.push({
                  id: d.id,
                  nominate: d.nominate,
                  name: d.name,
                  id_number : d.id_number,
                  training_certificate: d.training_certificate,
                  personal_ability: d.personal_ability,
                  certificate_competence: d.certificate_competence,
                  staff_authorization: d.staff_authorization,
                });
            }else{
                this.list_personel[d.index_personel].id = d.id
                this.list_personel[d.index_personel].nominate = d.nominate
                this.list_personel[d.index_personel].name = d.name
                this.list_personel[d.index_personel].id_number = d.id_number
                this.list_personel[d.index_personel].training_certificate = d.training_certificate
                this.list_personel[d.index_personel].personal_ability = d.personal_ability
                this.list_personel[d.index_personel].certificate_competence = d.certificate_competence
                this.list_personel[d.index_personel].staff_authorization = d.staff_authorization
            }
            this.personelDialog = false
        },
        addDocument(d){
            if(d.index == null ){
                this.list_document.push({
                    id: d.id,
                    no_document : d.no_document,
                    rev : d.rev,
                    rev_date : d.rev_date,
                    manual_status_confirmation : d.manual_status_confirmation,
                    component_maintenance_manual : d.component_maintenance_manual,
                    proposed_pd_sheet : d.proposed_pd_sheet,
                    document_type : d.document_type,
                })
            }else{
                this.list_document[d.index].id = d.id
                this.list_document[d.index].no_document = d.no_document
                this.list_document[d.index].rev = d.rev
                this.list_document[d.index].rev_date = d.rev_date
                this.list_document[d.index].manual_status_confirmation = d.manual_status_confirmation
                this.list_document[d.index].component_maintenance_manual = d.component_maintenance_manua
                this.list_document[d.index].proposed_pd_sheet = d.proposed_pd_sheet
                this.list_document[d.index].document_type = d.document_type
                this.documentDialog = false
            }
        },
        addTestEquipment(d){
          if(d.index == null ){
            this.list_test_equipment.push({
                id: d.id,
                request_submittion_id : d.request_submittion_id,
                part_number : d.part_number,
                part_name : d.part_name,
                available : d.available,
                alternate_pn : d.alternate_pn,
                alternate_name : d.alternate_name,
                remark : d.remark,
                equivalent : d.equivalent,
                attachment : d.attachment
            })
          }else{
              this.list_test_equipment[d.index].id = d.id
              this.list_test_equipment[d.index].request_submittion_id = d.request_submittion_id
              this.list_test_equipment[d.index].part_number = d.part_number
              this.list_test_equipment[d.index].part_name = d.part_name
              this.list_test_equipment[d.index].available = d.available
              this.list_test_equipment[d.index].alternate_pn = d.alternate_pn
              this.list_test_equipment[d.index].alternate_name = d.alternate_name
              this.list_test_equipment[d.index].remark = d.remark
              this.list_test_equipment[d.index].equivalent = d.equivalent
              this.list_test_equipment[d.index].attachment = d.attachment
              this.testEquipmentDialog = false
          }

        },
        addSpecial(d){
            if(d.index == null ){
              this.list_special_tools.push({
                  id: d.id,
                  request_submittion_id : d.request_submittion_id,
                  part_number : d.part_number,
                  part_name : d.part_name,
                  available : d.available,
                  alternate_pn : d.alternate_pn,
                  alternate_name : d.alternate_name,
                  remark : d.remark,
                  equivalent : d.equivalent,
                  attachment : d.attachment
              })
            }else{
                this.list_special_tools[d.index].id = d.id
                this.list_special_tools[d.index].request_submittion_id = d.request_submittion_id
                this.list_special_tools[d.index].part_number = d.part_number
                this.list_special_tools[d.index].part_name = d.part_name
                this.list_special_tools[d.index].available = d.available
                this.list_special_tools[d.index].alternate_pn = d.alternate_pn
                this.list_special_tools[d.index].alternate_name = d.alternate_name
                this.list_special_tools[d.index].remark = d.remark
                this.list_special_tools[d.index].equivalent = d.equivalent
                this.list_special_tools[d.index].attachment = d.attachment
                this.SpecialToolDialog = false
            }
        },
        addMaterialPlanning(d){
            if(d.index === null ){
                this.list_material_planning.push({
                    id: d.id,
                    part_number : d.part_number,
                    part_description : d.part_description,
                    qty : d.qty
                })
            }else{
                this.list_material_planning[d.index].id = d.id
                this.list_material_planning[d.index].part_number = d.part_number
                this.list_material_planning[d.index].part_description = d.part_description
                this.list_material_planning[d.index].qty = d.qty
                this.MaterialPlanningDialog = false
            }
        },
        addManhoursPlanning(d){
            if(d.index == null ){
                this.list_manhours_planning.push({
                    id: d.id,
                    task_name : d.task_name,
                    man_hour : d.man_hour,
                    man_power : d.man_power
                })
            }else{
                this.list_manhours_planning[d.index].id = d.id
                this.list_manhours_planning[d.index].task_name = d.task_name
                this.list_manhours_planning[d.index].man_hour = d.man_hour
                this.list_manhours_planning[d.index].man_power = d.man_power
                this.ManhoursPlanningDialog = false
            }
        },
        addEq(d){
            this.list_test_equipment[d.index].equivalent = 1
            this.equivalentDialog = false
        },
        loadAttachment(d){
            this.input.document_type = d.type
            this.file = d
            this.attachmentDialog = false
        },
        delPersonel(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_component_personel/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Personel Success deleted'});
                    this.list_personel.splice(i, 1)
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        delDocument(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_component_document/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Document Success deleted'});
                      this.list_document.splice(i, 1)
                    // this.getData()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        delTestEquipment(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_component_test_equipment/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Document Success deleted'});
                      this.list_test_equipment.splice(i, 1)
                    // this.getData()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        delSpecialTools(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_component_special_tool/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Document Success deleted'});
                      this.list_special_tools.splice(i, 1)
                    // this.getData()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        delMaterialPlanning(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_componentMaterialPlanning/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Document Success deleted'});
                      this.list_material_planning.splice(i, 1)
                    // this.getData()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        delManhoursPlanning(id, i){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(BASE_URL +'submit_componentManhoursPlanning/'+id ).then((res) => {
                    this.$message({ type: 'success', message: 'Document Success deleted'});
                      this.list_manhours_planning.splice(i, 1)
                    // this.getData()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info',  message: 'Delete canceled' });
            });
        },
        addConsumableMaterial(){
            this.list_consumable_material.push({
                part_number : '',
                description : '',
                qty : '',
                remark : '',
            })
        },
        delConsumableMaterial(i){
            this.list_consumable_material.splice(i, 1)
        },

        addAttachmentResubmit(d){
            this.list_note.push({
                id : d.id,
                note : d.note,
                attachment : d.attachment,
            });
            this.NoteDialog = false
        },

        delAttachmentResubmit(d, i){
            this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                  axios.delete(this.url+'/'+ d.id+'?type=note_resubmit').then((res) => {;
                     this.list_note.splice(i, 1)
                     this.$message({ type: 'success', message: 'Delete completed' });
                  })
                  .catch((err) => {
                      console.log(err);
                  })
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },

        tab(type){
            if(type == 'mainForm'){
                this.mainform = true
                this.shopability = false
                this.documents = false
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  false
                this.note =  false
            }else if (type == 'shopabilityForm') {
                this.mainform = false
                this.shopability = true
                this.documents = false
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  false
                this.note =  false
            }else if (type == 'documentForm') {
                this.mainform = false
                this.shopability = false
                this.documents = true
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  false
                this.note =  false
            }else if (type == 'personelForm') {
                this.mainform = false
                this.shopability = false
                this.documents = false
                this.personel = true
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  false
                this.note =  false
            }else if (type == 'testEquipmentForm') {
                this.mainform = false
                this.shopability = false
                this.documents = false
                this.personel = false
                this.testEquipment = true
                this.material_manhours =  false
                this.attachment =  false
                this.note =  false
            }else if (type == 'materialManhoursForm') {
                this.mainform = false
                this.shopability = false
                this.documents = false
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  true
                this.attachment =  false
                this.note =  false
            }else if (type == 'attachmentForm') {
                this.mainform = false
                this.shopability = false
                this.documents = false
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  true
                this.note =  false
            }else if (type == 'Note') {
                this.mainform = false
                this.shopability = false
                this.documents = false
                this.personel = false
                this.testEquipment = false
                this.material_manhours =  false
                this.attachment =  false
                this.note =  true
            }
        },
        cancel(){
          this.$confirm('Do You Want Close this Request Without Save ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              this.$router.push('/component_request');
              this.scrollToTop()
          }).catch(() => {
              this.$message({ type: 'info', message: 'Close canceled' });
          });
        },
        scrollToTop() {
          window.scrollTo(0,0);
        },
    }
}
</script>
<style lang="css">
.el-message-box__wrapper{
  z-index: 5000 !important;
}
</style>
