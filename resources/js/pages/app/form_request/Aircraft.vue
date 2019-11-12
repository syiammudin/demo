<template>
<div v-if="role_request == 1">
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Aircraft Capability Request</h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li v-if="idRequest != 0" :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="mainForm()" >Main Form</a></li>
                    <li v-if="idRequest != 0" :class="auth_personel === true ? 'active' : ''"><a aria-expanded="false" @click="authPersonel()">Authorized personel</a></li>
                    <li v-if="idRequest != 0" :class="documents === true ? 'active' : ''"><a aria-expanded="false" @click="Documents()">Document's</a></li>
                    <li v-if="idRequest != 0" :class="materials === true ? 'active' : ''"><a aria-expanded="false" @click="Materials()">Materials</a></li>
                    <li v-if="idRequest != 0" :class="tools === true ? 'active' : ''"><a aria-expanded="false" @click="Tools()">Tools and Equipment</a></li>
                    <li v-if="idRequest != 0" :class="facilities === true ? 'active' : ''"><a aria-expanded="false" @click="Faclity()">Facility</a></li>
                    <li v-if="idRequest != 0" :class="additionalattachment === true ? 'active' : ''" ><a aria-expanded="false" @click="AdditionalAttachment()">Additional Attachment</a></li>
                    <!-- <li :class="note === true ? 'active' : ''" v-if="input.status == 6"><a aria-expanded="false" @click="Note()">Note Resubmit</a></li> -->
                </ul>
                <br>
                <div class="" >
                    <!-- main  form  -->
                    <div v-show="mainform" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Request Number</label>
                            <div class="col-sm-10">
                                <input type="text" :value="input.request_number || RequestNumber"  placeholder="Number of Request" readonly  class="form-control">
                                <span v-if="err.request_number" > {{ err.request_number[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Request Type</label>
                            <div class="col-sm-10">
                                <div class="col-lg-12">
                                    <div class="col-md-2 radio radio-replace radio-success">
                                        <input type="radio" disabled v-model="input.request_type" selected name="request_type" value="Add" >
                                        <label for="radio6">Add</label>
                                    </div>
                                    <div class="col-md-2  radio radio-replace radio-success">
                                        <input type="radio" disabled v-model="input.request_type" name="request_type" value="Change" >
                                        <label for="radio6">Change</label>
                                    </div>
                                    <div class="col-md-2  radio radio-replace radio-success">
                                        <input type="radio" disabled v-model="input.request_type" name="request_type" value="Delete" >
                                        <label for="radio6">Remove</label>
                                    </div>
                                </div>
                                <span v-if="err.request_type" > {{ err.request_type[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">No Maintenance Ability </label>
                            <div class="col-sm-10">
                                <input type="text" v-model="input.number" placeholder="No Maintenance Ability" class="form-control">
                                <span v-if="err.number" > {{ err.number[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rating </label>
                            <div class="col-sm-10">
                                <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-model="input.authority" filterable clearable placeholder="Select Rating" >
                                    <el-option v-for="item in ForRating" :key="item.name_of_rating"
                                        :label="item.name_of_rating"
                                        :value="item.name_of_rating">
                                    </el-option>
                                </el-select>
                                <span v-if="err.authority" > {{ err.authority[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aircraft Type </label>
                            <div class="col-sm-10">
                                <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-model="input.aircraft_type" filterable clearable placeholder="Select Aircraft Type" >
                                    <el-option v-for="item in AircraftType" :key="item.code"
                                        :label="item.aircraft_type"
                                        :value="item.aircraft_type">
                                    </el-option>
                                </el-select>
                                <span v-if="err.aircraft_type" > {{ err.aircraft_type[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aircraft Manufacturer </label>
                            <div class="col-sm-10">
                                <input type="text" readonly v-model="input.aircraft_manufacturer" placeholder="Aircraft Manufacturer" class="form-control">
                                <span v-if="err.aircraft_manufacturer" > {{ err.aircraft_manufacturer[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group" >
                          <label class="col-sm-2 control-label">Engine </label>
                          <div class="col-sm-10">
                            <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-model="input.engine" filterable clearable placeholder="Select Engine" >
                                <!-- <el-option v-if="engine_name.length > 0" v-for="item in engine_name" :key="item" -->
                                <el-option v-for="item in engine_name" :key="item"
                                    :label="item"
                                    :value="item">
                                </el-option>
                            </el-select>
                            <span v-if="err.engine" > {{ err.engine[0] }}</span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Maintenance Area </label>
                            <div class="col-md-10 radio radio-replace radio-success">
                                <div class="col-md-10 radio radio-replace radio-primary">
                                    <div class="col-md-12">
                                        <input type="radio" :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " class="form-control"  v-model="input.maintenance_area" name="maintenance_area" id="area" value="base_maintenance">
                                        <label for="radio6">Base Maintenance</label>
                                        <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-if="input.maintenance_area == 'base_maintenance'"  onloadedmetadata="" v-model="input.maintenance_area_value"  filterable clearable placeholder="Select Maintenance Area" >
                                            <el-option v-for="item in Hangar" :key="item.code"
                                                :label="item.hangar_name"
                                                :value="item.hangar_name">
                                            </el-option>
                                            <el-option label="Other Base" value="Other Base"></el-option>
                                        </el-select>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <input v-if="input.maintenance_area_value == 'Other Base'" type="text" class="form-control" v-model='input.other_base'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " type="radio" class="form-control"  v-model="input.maintenance_area" name="maintenance_area" id="area" value="line_maintenance">
                                        <label for="radio6">Line Maintenance</label>
                                        <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-if="input.maintenance_area == 'line_maintenance' "  onloadedmetadata="" v-model="input.maintenance_area_value"  filterable clearable placeholder="Select Maintenance Area" >
                                            <el-option v-for="item in MaintenanceArea" :key="item.code"
                                                :label="item.code+' - '+item.description"
                                                :value="item.code">
                                            </el-option>
                                            <el-option label="Other line" value="Other line"></el-option>
                                        </el-select>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-lg-5">
                                                <input :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-if="input.maintenance_area_value == 'Other line'" type="text" class="form-control col-lg-3" v-model='input.other_line_code'>
                                            </div>
                                            <div class="col-lg-7">
                                                <input :disabled="input.request_type == 'Change' || input.request_type == 'Delete' "  v-if="input.maintenance_area_value == 'Other line'" type="text" class="form-control col-lg-9" v-model='input.other_line_description'>
                                            </div>
                                        </div>
                                    </div>
                                    <span v-if="err.maintenance_area_value" > {{ err.maintenance_area_value[0] }}</span>
                                    <!-- <div class="col-md-12">
                                        <input type="radio" :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " class="form-control"  v-model="input.maintenance_area"  name="maintenance_area" id="area" value="other_area" checked="checked">
                                        <label for="radio10">Other Area </label>
                                        <input type="text" :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-if="input.maintenance_area == 'other_area'" v-model="input.maintenance_area_value" class="form-control">
                                    </div> -->
                                </div>
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Special Work to Be Order Outside</label>
                            <div class="col-sm-10">
                                <textarea name="name" class="form-control" v-model='input.special_work'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Manager Statement </label>
                            <div class="col-sm-10 checkbox checkbox-replace checkbox-success">
                                <div class="">
                                    <p >
                                        I certify that my department has capability to maintain the above mention items, according to
                                        AMO Manual 1.9.21 MOE 1.9.5/ RSQM 1.9.2 requirement and items with Cross (X) sign below
                                        have been provided.
                                    </p>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control" v-model='input.facilities'>
                                        <label for="checkbox6">Facilities </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control" v-model='input.certifying_staff'>
                                        <label for="checkbox6">Certifying Staff</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control" v-model='input.approved_data'>
                                        <label for="checkbox6">Approved Data </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control"  v-model='input.qualified_personel'>
                                        <label for="checkbox6">Qualified Personnel</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control"  v-model='input.special_tools'>
                                        <label for="checkbox6">Special Tools </label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" class="form-control"  v-model='input.consumable'>
                                        <label for="checkbox6">Consumable</label>
                                    </div>
								                  </div>
                                <span v-if="err.manager_statement" > {{ err.manager_statement[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ability </label>
                            <div class="col-sm-10">
                                <el-select  :disabled="input.request_type == 'Delete' " v-model="input.ability" filterable clearable placeholder="Select ability" >
                                    <el-option v-for="item in ['A-Check','C-Check','D-Check','Transit','BD', 'Daily','Service','Weekly']" :key="item"
                                        :label="item"
                                        :value="item">
                                    </el-option>
                                    <el-option  key="Other"
                                        label="Other"
                                        value="Other">
                                    </el-option>
                                </el-select>
                                <div :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-if="input.ability == 'Other'" style="margin-top:10px;">
                                    <input v-if="input.ability == 'Other'" type="text" class="form-control" placeholder="Ability Other Value" v-model="input.ability_other_value">
                                </div>
                                <span v-if="err.ability" > {{ err.ability[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Customer </label>
                            <div class="col-sm-10">
                                <el-select  :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " v-model="input.customer" filterable clearable placeholder="Select Customer" >
                                    <el-option v-for="item in Customer" :key="item.name_customer"
                                        :label="item.name_customer"
                                        :value="item.name_customer">
                                    </el-option>
                                </el-select>
                                <span v-if="err.customer" > {{ err.customer[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Limitation </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="input.limitation" placeholder=limitation>
                            </div>
                        </div>
                    </div>

                    <!-- auth personel form -->
                    <div v-show='auth_personel' class="form-horizontal">

                        <el-button @click="personelDialog = true"  size="mini" icon="fa fa-plus" round > Add Personnel </el-button>
                        <!-- <el-button @click="formImport('personel')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button> -->
                        <div class="table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th style="width:150px">Name</th>
                                        <th style="width:100px">Pers No</th>
                                        <th style="width:100px">STA</th>
                                        <th style="width:250px">Skill</th>
                                        <th style="width:250px">Stamp No</th>
                                        <th style="width:150px">License Type</th>
                                        <th style="width:150px">Amel No</th>
                                        <th style="width:150px">Exp. date</th>
                                        <th style="width:150px">GMF Auth No</th>
                                        <th style="width:150px">Exp. date</th>
                                        <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllPersonel' @click="select('personel')"> All
                                           </div>
                                          <el-button @click="deleteAllPersonel"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ap, i) in list_auth_personel" :key="i">
                                        <td>{{ ap.name }}</td>
                                        <td>{{ ap.personal_number }}</td>
                                        <td >{{ ap.sta }} </td>
                                        <td >{{ ap.skill }}</td>
                                        <td >{{ ap.stamp_no }}</td>
                                        <td >
                                            <div v-if="ap.license_type == 'amel'" >
                                                Amel Holder
                                            </div>
                                            <div v-if="ap.license_type == 'cs'" >
                                                Certifying Staff
                                            </div>
                                        </td>
                                        <td >
                                            {{ ap.amel_no }}
                                            <br>
                                            <li v-for='(d, i) in JSON.parse(ap.amel_scope)' :key="i" style="list-style : none ; font-size : 7pt">{{ d }}</li>
                                        </td>
                                        <td >{{ ap.ex_date_ame != null ? customFormatter(ap.ex_date_ame) : '' }}</td>
                                        <td >
                                            <div v-if="ap.license_type == 'cs'">
                                                {{ ap.gmf_auth_number }}
                                                <br>
                                                <li v-for='(d, i) in JSON.parse(ap.gmf_scope)' :key="i" style="list-style : none ; font-size : 7pt">{{ d }}</li>
                                            </div>
                                        </td>
                                        <td > <div v-if="ap.license_type == 'cs'">{{ ap.ex_date_company != null ? customFormatter(ap.ex_date_company) : '' }}</div></td>
                                        <td class="selectAll text-center" style="vertical-align: middle;">
                                          <a @click="delPersonel(ap, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                          <input type="checkbox"  :value="ap"  v-model="selectedPersonel">
                                            <div class="hidden">
                                                {{ ap.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- form document -->
                    <div v-show='documents' class="form-horizontal">
                        <!-- <el-button @click="documentDialog = true"  size="mini" icon="fa fa-plus" round > Add Doc </el-button> -->
                        <el-button @click="addDoc()"  size="mini" icon="fa fa-plus" round > Add Doc </el-button>
                        <el-button @click="formImport('document')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>

                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Document Code</th>
                                            <th>Type</th>
                                            <th>Effective Code</th>
                                            <th>Description</th>
                                            <th>Manufacture</th>
                                            <th>AC Type</th>
                                            <th>Rev</th>
                                            <th>Rev Date</th>
                                            <th>Attachment</th>
                                            <th class="text-center">
                                            <div >
                                                <input type="checkbox" v-model="selectAllDocument" @click="select('document')">  All
                                            </div>
                                            <el-button @click="deleteAllDocument()"  size="mini" icon="fa fa-trash " round > Selected</el-button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(d, i) in list_document" :key="i">
                                            <td><input type="text" class="form-control" v-model="d.document_code" name="" value=""> </td>
                                            <td><input type="text" class="form-control" v-model="d.type" name="" value=""> </td>
                                            <td><input type="text" class="form-control" v-model="d.effective_code" name="" value=""> </td>
                                            <td><input type="text" class="form-control" v-model="d.description_document" name="" value=""> </td>
                                            <td><input type="text" class="form-control" v-model=" d.manufacture" name="" value=""> </td>
                                            <td><input type="text" class="form-control" v-model="d.ac_type" name="" value=""></td>
                                        <td><input type="text" class="form-control" v-model="d.rev" name="" value=""> </td>
                                        <td><el-date-picker v-model="d.rev_date" type="date" placeholder="Rev Date" value-format="yyyy-MM-dd"></el-date-picker> </td>
                                        <td>
                                            <button type="button"  class="btn btn-primary" name="button" @click="attachDoc(d , i)">Attach Doc</button>
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/aircraft/document/'+d.attachment">
                                                {{ d.attachment}}
                                            </a>
                                        </td>
                                        <td class="selectAll text-center" style="vertical-align: middle;">
                                          <a @click="delDoc(i, d.id)"><i class="icon-trash" style="font-size:12pt;"></i></a>
                                          <input type="checkbox"  :value="d"  v-model="selectedDocument">
                                          <div class="hidden">
                                            {{ d.index = i }}
                                           </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- form materials -->
                    <form v-show='materials' class="form-horizontal">
                        <el-button @click="partnumber('material')"  size="mini" icon="fa fa-plus" round > Add Material </el-button>
                        <el-button @click="formImport('material')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Camp Number</th>
                                        <th>Jobcard Number</th>
                                        <th>Title</th>
                                        <th>MPD No</th>
                                        <th>References</th>
                                        <th>Interval</th>
                                        <th>Description</th>
                                        <th>Part Number</th>
                                        <th>QTY</th>
                                        <th class="text-center">
                                          <div>
                                              <input type="checkbox" v-model="selectAllMaterial" @click="select('material')"> All
                                          </div>
                                          <el-button @click="deleteAllMaterial"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_materials" :key="i">
                                        <td><input class="my-input" v-model="d.camp_number" placeholder="Camp Number"> </td>
                                        <td><input class="my-input" v-model="d.jobcard_number" placeholder="Jobcard Number"> </td>
                                        <td><input class="my-input" v-model="d.title" placeholder="Title"> </td>
                                        <td><input class="my-input" v-model="d.mpd_number" placeholder="MPD No"> </td>
                                        <td><input class="my-input" v-model="d.references" placeholder="References"> </td>
                                        <td><input class="my-input" v-model="d.interval" placeholder="Interval"> </td>
                                        <td><input readonly class="my-input" v-model="d.description_material" placeholder="Description"></td>
                                        <td><input readonly class="my-input" v-model="d.pn" placeholder="PN"> </td>
                                        <td><input class="my-input" v-model="d.qty" placeholder="QTY"> </td>
                                        <td class="selectAll text-center" style="vertical-align: middle;">
                                          <a @click="delMaterials(d, i)"><i class="icon-trash" style="font-size:12pt;"></i></a>
                                          <input type="checkbox"  :value="d"  v-model="selectedMaterial">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- form tools and Equipment -->
                    <div v-show='tools' class="form-horizontal">
                        <el-button @click="ToolsDialog = true"  size="mini" icon="fa fa-plus" round > Add Tools </el-button>
                        <el-button @click="formImport('tools')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Camp Number</th>
                                        <th>Jobcard Number</th>
                                        <th>Title</th>
                                        <th>MPD No</th>
                                        <th>References</th>
                                        <th>Interval</th>
                                        <th>Description</th>
                                        <th>Part Numbers</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Location</th>
                                        <th class="text-center">
                                            <div>
                                                <input type="checkbox" v-model="selectAllTools" @click="select('tools')"> All
                                            </div>
                                          <el-button @click="deleteAllTestEquipment"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d,i) in list_tools" :key="i">
                                        <td><input class="my-input" v-model="d.camp_number" placeholder="Camp Number"> </td>
                                        <td><input class="my-input" v-model="d.jobcard_number" placeholder="Jobcard Number"> </td>
                                        <td><input class="my-input" v-model="d.title" placeholder="Title"> </td>
                                        <td><input class="my-input" v-model="d.mpd_number" placeholder="MPD No"> </td>
                                        <td><input class="my-input" v-model="d.references" placeholder="References"> </td>
                                        <td><input class="my-input" v-model="d.interval" placeholder="Interval"> </td>
                                        <td><input readonly class="my-input" v-model="d.description_tools" placeholder="Description"></td>
                                        <td><input readonly class="my-input" v-model="d.part_no" placeholder="Part No"></td>
                                        <td><input class="my-input" v-model="d.qty" placeholder="Qty"></td>
                                        <td><input class="my-input" v-model="d.unit" placeholder="Unit"></td>
                                        <td><input class="my-input" v-model="d.location" placeholder="Location"></td>
                                        <td class="selectAll text-center" style="vertical-align: middle;">
                                          <a @click="delTools(d, i)"><i class="icon-trash" style="font-size:12pt;"></i></a>
                                          <input type="checkbox"  :value="d"  v-model="selectedTestEquipment">
                                          <div class="hidden">
                                              {{ d.index = i }}
                                          </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- facilities -->
                    <div v-show='facilities' class="form-horizontal">
                        <el-button @click="facilitiesDialog = true "  size="mini" icon="fa fa-add " round > Add </el-button>
                        <el-button @click="formImport('facilities')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Sub Description</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Status</th>
                                        <th>Remark</th>
                                        <th class="text-center">
                                          <div>
                                              <input type="checkbox" v-model="selectAllFacility" @click="select('facility')"> All
                                          </div>
                                          <el-button @click="deleteAllFacility"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_facilities" :key="i">
                                        <td>{{ d.description_main }} </td>
                                        <td>{{ d.description }} </td>
                                        <td><input type="text" class="form-control" style="width:50px;" v-model="d.quantity"> </td>
                                        <td><input type="text" class="form-control" v-model="d.unit"> </td>
                                        <td><input type="text" class="form-control" v-model="d.status"> </td>
                                        <td><input type="text" class="form-control" v-model="d.remark"> </td>
                                        <td class="selectAll text-center" style="vertical-align: middle;">
                                          <a @click="delFacilities(d, i)"><i class="icon-trash" style="font-size:12pt;"></i></a>
                                          <input type="checkbox"  :value="d"  v-model="selectedFacility">
                                          <div class="hidden">
                                              {{ d.index = i }}
                                          </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-show='additionalattachment' class="form-horizontal">
                        <el-button @click="AdditionalAttachmentDialog = true "  size="mini" icon="fa fa-add " round > Add </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <tbody>
                                    <tr v-for="(d, i) in list_additional_attachment" :key="i">
                                        <td>
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/aircraft/additionalAttachment/'+d.name_attachment">
                                                {{ d.name_attachment }}
                                            </a>
                                        </td>
                                        <td><a @click="dellAdditionalAttachment(d, i)"><i class="icon-trash"></i> </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- button save -->
                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-primary" @click="save(input, list_auth_personel, list_document, list_materials, list_tools)" >Save to Draft</button>
                            <button class="btn btn-danger" @click="cancel" >Cancel</button>
                            <!-- <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link> -->
                            <button v-if="idRequest != 0" class="btn btn-success" @click="input.status == 6 ? beforeSubmit(input, list_auth_personel, list_document, list_materials, list_tools) : submit(input, list_auth_personel, list_document, list_materials, list_tools)" >
                                {{ input.status == 6 ? 'Save And re-Submit' : 'Save And Submit'}}
                            </button>
                            <button v-if="idRequest != 0" class="btn btn-primary" @click="save(input, list_auth_personel, list_document, list_materials, list_tools, 'preview')" >Save and Preview</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <el-dialog title="Personel List " width="60%" :visible.sync="personelDialog" >
        <PersonelList  @add="addPersonel" :list_auth_personel="list_auth_personel" />
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
                <button class="btn btn-success" @click="submit(input, list_auth_personel, list_document, list_materials, list_tools, 'resubmit')" >re-SUbmit</button>
                <button class="btn btn-danger" @click="note = false" >Cancel</button>
              </div>
        </div>
    </el-dialog>

    <el-dialog title="PartNumber " :visible.sync="PartNumberDialog" >
        <div class="row">
            <div class="col-md-10">
                <el-select onloadedmetadata="" v-model="partNumber"  filterable clearable placeholder="Select Part Number" >
                    <el-option v-for="item in PartNumber" :key="item.code"
                        :label="item.part_number"
                        :value="item.part_number">
                    </el-option>
                </el-select>
            </div>
            <div class="col-md-2">
                <button v-if="pn_cek == 'material'" @click="addMaterial()" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                <button v-if="pn_cek == 'tools'" @click="addTools()" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </el-dialog>

    <el-dialog title="Facilities " width="70%" :visible.sync="facilitiesDialog" >
        <facilitiesForm v-if='facilitiesDialog == true' :id="type" @add="addFacilities" :list_facilities="list_facilities" />
    </el-dialog>

    <el-dialog title="Documentt " :visible.sync="attachDocDialog" >
        <attachmentDocument :index="index" @add="addAttachDoc" />
    </el-dialog>

    <el-dialog title="Note Attachment " :visible.sync="NoteDialog" >
        <attachment :id="type" :type="'aircraft'" @add="addAttachmentResubmit" />
    </el-dialog>

    <el-dialog title="Tools " :visible.sync="ToolsDialog" >
        <tools   @add="addTools" />
    </el-dialog>

    <el-dialog title="Document " :visible.sync="documentDialog" >
        <documents @add="addDoc" />
    </el-dialog>

    <el-dialog title="Additional Attachment Dialog " :visible.sync="AdditionalAttachmentDialog" >
        <additionalAttachment @add="addAdditionalAttachment" />
    </el-dialog>

    <el-dialog :title=" 'Import ' + typeimport " :visible.sync="importFileDialog" >
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-md-3">Import File From excel</label>
                <div class="col-md-9">
                    <input type="file" v-on:change="onFileChange" style="display:block" class="form-control" ref="fileInput" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-3"></label>
                <div class="col-md-9">
                    <button @click='ImportFile()' class="btn btn-primary btn-sm">Import</button>
                </div>
            </div>
        </div>
        <div class="line-dashed"></div>
        For format import excel, you can  <a :href="base_url+'document_n_import/aircraft/sampel_import/'+typeimport+'.xlsx'" target="_blank" style="color:blue!important">download here</a>
    </el-dialog>

</div>

</template>

<script>
import PersonelList from '../../../components/PersonelListAircraft'
import documents from './aircraft/document'
import facilitiesForm from './aircraft/facility'
import additionalAttachment from './aircraft/additionalAttachment'
import attachmentDocument from './aircraft/attachmentDocument'
import tools from '../../../components/tools'
import attachment from './attachmentResubmit'
import popupAttachment from '../popupAttachment'
import moment from 'moment'
export default {
    components: { popupAttachment, PersonelList, tools, documents, attachment, facilitiesForm, additionalAttachment, attachmentDocument },
    computed: {
        MaintenanceArea() { return this.$store.state.MaintenanceArea } ,
        Customer() { return this.$store.state.Customer } ,
        ForRating() { return this.$store.state.ForRating } ,
        AircraftType() { return this.$store.state.AircraftType } ,
        UnitOfMeasure() { return this.$store.state.UnitOfMeasure } ,
        PartNumber() { return this.$store.state.PartNumber } ,
        RequestNumber() { return this.$store.state.RequestNumber } ,
        DataTools() { return this.$store.state.Tools } ,
        Hangar() { return this.$store.state.Hangar } ,
        requestType() {
            return this.$store.state.requestTypes.find(t => t.id == 1)
        },
    },
    created() {
        this.$store.state.type_of_request = 'aircraft'
        this.$store.commit('getMaintenanceArea');
        this.$store.commit('getCustomer');
        this.$store.commit('getForRating');
        this.$store.commit('getAircraftType');
        this.$store.commit('getPartNumber');
        this.$store.commit('getUnitOfMeasure');
        this.$store.commit('getRequestNumber');
        this.$store.commit('getRequestType');
        this.$store.commit('getHangar');
        this.getData() ;
    },
    props: ['type'] ,
    watch: {
        // untuk mendapatkan data pasien onchange
        'input.ability_other_maintenance': function(v, o) {
            if(v == 1 || v == 2){
                this.other_field = true
            }else{
                this.other_field = false
            }
        },

        'input.aircraft_type': function(v, o) {
            if(!v){
                return
            }
            if(this.$store.state.AircraftType.find(t => t.aircraft_type == v).engine != undefined){
              this.engine_name =  this.$store.state.AircraftType.find(t => t.aircraft_type == v).engine.split(',')
            }else{
              this.engine_name =  []
            }
            this.input.aircraft_manufacturer = this.$store.state.AircraftType.find(t => t.aircraft_type == v).manufacturer
        },

        'input.other_area': function(v, o) {
            if(v == true){
                this.other_area = 2
            }else{
                this.other_area = 1
            }
        },

        'input.cek_lm': function(v, o) {
            if(v == true){
                this.line_maintenance = 2
            }else{
                this.line_maintenance = 1
            }
        },

    },
    data() {
      return {
          personelDialog : false ,PartNumberDialog : false , partNumber : '', pn_cek : '', ToolsDialog : false , keyTools : '',
          input : {} , personel : [] , list_auth_personel : [] , doc : [] , list_document : [] , typeimport : '',
          material : [] , list_materials : [] , tool : [] , list_tools : [] , documentDialog : false, note : false , list_note : [], NoteDialog : false ,
          mainform : true, auth_personel : false , documents : false, materials : false, tools : false, idRequest : '' ,
          url : BASE_URL + 'submit_aircraft' , err : [], other_field : false, line_maintenance : 1, other_area : 1 ,
          check : [{ 'id' : 0, 'name' : 'N/A' },{ 'id' : 1, 'name' : 'Yes' },{ 'id' : 2, 'name' : 'No' }], imports : {} , importFileDialog : false,
          fileList : [], base_url : BASE_URL, role_request : ROLE_REQUEST, facilities : false, facilitiesDialog : false, list_facilities : [],
          AdditionalAttachmentDialog : false, additionalattachment : false, list_additional_attachment : [], attachDocDialog : false, index :'', engine_name : [],
          selectedMaterial : [], selectedPersonel : [], selectedDocument : [] , selectedTestEquipment : [], selectedFacility : [],
         popupAttachmentDialog : false,
          selectAllDocument : false, selectAllPersonel : false , selectAllMaterial : false ,
          selectAllTools : false , selectAllFacility : false
      }
    },
    methods : {
        select(d){
            if(d == 'personel'){
                this.selectedPersonel = [];
                if (!this.selectAllPersonel) {
                    for (let i in this.list_auth_personel) {
                    this.selectedPersonel.push(this.list_auth_personel[i]);
                    }
                }
            }
            if(d == 'document'){
                this.selectedDocument = [];
                if (!this.selectAllDocument) {
                    for (let i in this.list_document) {
                    this.selectedDocument.push(this.list_document[i]);
                    }
                }
            }
            if(d == 'material'){
                this.selectedMaterial = [];
                if (!this.selectAllMaterial) {
                    for (let i in this.list_materials) {
                    this.selectedMaterial.push(this.list_materials[i]);
                    }
                }
            }
            if(d == 'facility'){
                this.selectedFacility = [];
                if (!this.selectAllFacility) {
                    for (let i in this.list_facilities) {
                    this.selectedFacility.push(this.list_facilities[i]);
                    }
                }
            }
            if(d == 'tools'){
                this.selectedTestEquipment = [];
                if (!this.selectAllTools) {
                    for (let i in this.list_tools) {
                    this.selectedTestEquipment.push(this.list_tools[i]);
                    }
                }
            }
        },
        addAttachDoc(d){
          this.list_document[d.index].attachment = d.attachment                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               = d.attachment
          this.attachDocDialog = false
        },
        attachDoc(d, i ){
            this.attachDocDialog = true
            this.index = i
        },
        uploadSuccess(res, file) {
            this.list_document[res.index].attacment = res.file
            this.$confirm('Do You Want to Save with Upload and Note  ?', 'Warning', {  confirmButtonText: 'Yes', cancelButtonText: 'No', type: 'warning'}).then(() => {
                this.list_document
            }).catch(() => {
                this.submit(this.input, this.list_auth_personel, this.list_document, this.list_materials, this.list_tools)
            });
        },
        handleChange(file, fileList) {
           this.fileList = fileList.slice(-1);
        },
        beforeSubmit(){
          this.$confirm('Do You Want to Save with Upload and Note  ?', 'Warning', {  confirmButtonText: 'Yes', cancelButtonText: 'No', type: 'warning'}).then(() => {
              this.note = true
          }).catch(() => {
              this.submit(this.input, this.list_auth_personel, this.list_document, this.list_materials, this.list_tools)
          });
        },
        formImport(type){
            this.typeimport = type
            this.importFileDialog = true
        },
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.fileexcel = e.target.files[0];
        },
        ImportFile(){
            this.load = true
            const config = { headers: { 'content-type': 'multipart/form-data' } }
            var data = new FormData();
            data.append('excelfile', this.fileexcel);
            data.append('type', this.typeimport);
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/importExcel', data, config ).then((res) => {
                // console.log(res.data);
                if(res.data.status == 1){
                    this.importFileDialog = false
                    if(res.data.type == 'facilities'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                        description_main : res.data.data[i].description_main ,
                                        description : res.data.data[i].description ,
                                        quantity : res.data.data[i].quantity ,
                                        unit : res.data.data[i].unit ,
                                        status : res.data.data[i].status ,
                                        remark : res.data.data[i].remark
                                      }
                            this.list_facilities.push(obj)
                        }
                    }
                    if(res.data.type == 'personel'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                        name: res.data.data[i].name,
                                        personal_number: res.data.data[i].personal_number ,
                                        sta : res.data.data[i].sta,
                                        skill:res.data.data[i].skill,
                                        stamp_no:res.data.data[i].stamp_no,
                                        amel_no: res.data.data[i].amel_no,
                                        license_type: res.data.data[i].license_type,
                                        ex_date_ame: res.data.data[i].ex_date_ame,
                                        gmf_auth_number: res.data.data[i].gmf_auth_number,
                                        ex_date_company: res.data.data[i].ex_date_company,
                                      }
                            this.list_auth_personel.push(obj)
                        }
                    }
                    if(res.data.type == 'document'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                        document_code: res.data.data[i].document_code,
                                        type: res.data.data[i].type ,
                                        effective_code: res.data.data[i].effective_code,
                                        description_document : res.data.data[i].description_document,
                                        manufacture:res.data.data[i].manufacture,
                                        ac_type: res.data.data[i].ac_type,
                                        rev: res.data.data[i].rev,
                                        rev_date: res.data.data[i].rev_date,
                                      }
                            this.list_document.push(obj)
                        }
                    }
                    if(res.data.type == 'material'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                        description_material: res.data.data[i].description_material,
                                        pn: res.data.data[i].pn ,
                                        availability : res.data.data[i].availability,
                                        camp_number:res.data.data[i].camp_number,
                                        jobcard_number: res.data.data[i].jobcard_number,
                                        title: res.data.data[i].title,
                                        mpd_number: res.data.data[i].mpd_number,
                                        references: res.data.data[i].references,
                                        interval: res.data.data[i].interval,
                                        qty: res.data.data[i].qty,
                                      }
                            this.list_materials.push(obj)
                        }
                    }
                    if(res.data.type == 'tools'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                        description_tools: res.data.data[i].description_tools,
                                        part_no: res.data.data[i].part_no ,
                                        qty : res.data.data[i].qty,
                                        unit:res.data.data[i].unit,
                                        remark: res.data.data[i].remark,
                                        camp_number: res.data.data[i].camp_number,
                                        jobcard_number: res.data.data[i].jobcard_number,
                                        title: res.data.data[i].title,
                                        mpd_number: res.data.data[i].mpd_number,
                                        references: res.data.data[i].references,
                                        interval: res.data.data[i].interval,
                                      }
                            this.list_tools.push(obj)
                        }
                    }
                    const input = this.$refs.fileInput
                    input.type = 'text'
                    input.type = 'file'
                    loading.close()
                }else{
                    loading.close() ;
                    alert('Import Gagal')
                }
                loading.close()
            }).catch((err) => {
                this.$alert('Please Check Format Valid or not ?', 'Warning', {
                    confirmButtonText: 'OK',
                });
                loading.close() ;
                console.log(err);
            })
        },
        partnumber(param){
            this.pn_cek = param
            this.PartNumberDialog = true
        },
        getData(id){

            if(this.idRequest == 0){
                this.input.request_type = 'Add'
            }
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });

            if(id == undefined || id == null){
                this.idRequest = this.type
            }else{
                this.idRequest = id
            }
            if(this.idRequest == 0){
                loading.close();
            }

            axios.get(this.url+'/'+this.idRequest).then((res) => {
                this.input = res.data[0].aircraft_request
                this.list_auth_personel = res.data[0].aircraft_authorized_personel
                this.list_document = res.data[0].aircraft_document
                this.list_facilities = res.data[0].aircraft_facility

                this.list_materials = res.data[0].aircraft_material
                this.input.request_number = res.data[0].request_number
                this.input.request_type = res.data[0].request_type
                this.list_tools = res.data[0].aircraft_tool_equipment
                this.list_note = res.data[0].attachment_resubmit
                this.list_additional_attachment = res.data[0].additional_attachment

                // this.input.number = 10
                this.input.request_id = res.data[0].id
                // console.log(res.data)
                if(res.data[0].aircraft_request.line_maintenance != null){
                    this.line_maintenance = 2
                    this.input.cek_lm = 1
                }
                if(res.data[0].aircraft_request.other != null){
                    this.other_area = 2
                    this.input.other_area = 1
                }
                this.input.status = res.data[0].status

                loading.close();
                // this.input.maintenance_area = res.data[0].aircraft_request.maintenance_area.split(',')
            })
            .catch((err) => {

            })
        },
        save(input, list_auth_personel, list_document, list_materials, list_tools, preview){
            input.master_request_id = this.requestType.id
            input.personel = list_auth_personel
            input.doc = list_document
            input.material = list_materials
            input.tools = list_tools
            input.list_facilities = this.list_facilities
            input.list_additional_attachment = this.list_additional_attachment
            if(this.input.facilities == undefined &&  this.input.certifying_staff  == undefined &&  this.input.approved_data  == undefined &&  this.input.qualified_personel  == undefined &&  this.input.special_tools  == undefined &&  this.input.consumable == undefined ){
                this.input.manager_statement = null
            }else{
                this.input.manager_statement = 'OK'
            }
            if(preview == 'preview'){
              var text = '& Preview '
            }else{
              var text = ''
            }
            this.$confirm('Do You Want Save to Draft '+text+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              const loading = this.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
              });
                axios.post(this.url, input ).then((res) => {
                  if(res.data.status === 1){
                    if(preview == 'preview'){
                      this.getData()
                      if(this.type == 0){
                        this.$router.push({ name: 'form_aircraft', params: { type: res.data.id } })
                        this.input.request_id = res.data.id
                        this.getData(res.data.id)
                      }
                      this.getData(res.data.id)
                      window.open(this.url+"/detail/"+res.data.id, '_blank')
                    }else{
                      if(this.type == 0){
                        this.$router.push({ name: 'form_aircraft', params: { type: res.data.id } })
                        this.input.request_id = res.data.id
                        this.idRequest = res.data.id
                        this.getData(res.data.id)
                      }else{
                        this.$router.push('/aircraft_request');
                      }
                      this.input = {}
                      this.scrollToTop()
                    }
                    // this.$emit('simpan')
                  }else if(res.data.status == 2){
                    const warning = 'Request '+ this.input.request_type +' ('+ this.input.authority + ') for '+ this.input.aircraft_type + ' in ' + this.input.maintenance_area_value + ' with customer ' + this.input.customer +
                    'Already be a master in this Area, Please cancel or choose Button Change in Main Menu'

                    this.$alert(warning, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                  }else{
                    this.$alert('Request Failed', 'Warning', {
                      confirmButtonText: 'OK',
                    });
                  }
                  console.log(res.data);
                  loading.close();
                })
                .catch((error) => {
                  console.log(error);
                  this.err = error.response.data.errors
                  loading.close();
                })
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
                loading.close()
            });
        },

        submit(input, list_auth_personel, list_document, list_materials, list_tools, type){
            const document = list_document.filter(cek => cek.document_code == null || cek.type == null || cek.effective_code == null || cek.description_document == 0
                                                                || cek.manufacture == null ||  cek.ac_type == null )

            const material = list_materials.filter(cek => cek.camp_number == null || cek.jobcard_number == null || cek.title == null || cek.mpd_number == 0
                                                                || cek.references == null ||  cek.interval == null || cek.description_material == 0 || cek.pn == 0
                                                                || cek.qty == 0)

            const tools = list_tools.filter(cek => cek.camp_number == null || cek.jobcard_number == null || cek.title == null || cek.mpd_number == 0
                                                                || cek.references == null ||  cek.interval == null || cek.description_tools == 0 || cek.part_no == 0
                                                                || cek.qty == 0)

            if(input.maintenance_area_value == undefined || input.maintenance_area_value == null){
              this.$alert("Please Choose Maintenance Area Value First", 'Warning', { confirmButtonText: 'OK', }); this.mainForm()
              return
            }

            if(document.length >= 1){
                this.$alert("Please Fill of Document can't null", 'Warning', { confirmButtonText: 'OK', }); this.Documents()
            }
            if(material.length >= 1){
                this.$alert("Please Fill of Material can't null", 'Warning', { confirmButtonText: 'OK', }); this.Materials()
            }
            if(tools.length >= 1){
                this.$alert("Please Fill of Tools can't null", 'Warning', { confirmButtonText: 'OK', }); this.Tools()
            }

            input.master_request_id = this.requestType.id
            input.personel = list_auth_personel
            input.doc = list_document
            input.material = list_materials
            input.tools = list_tools
            input.list_facilities = this.list_facilities
            input.list_additional_attachment = this.list_additional_attachment
            if(list_tools.length == 0){
                this.$alert("Tools and Equipment Can't be null", 'Warning', {
                    confirmButtonText: 'OK',
                }); this.Tools()
            }
            if(list_auth_personel.length == 0){
                this.$alert("Personel Can't be null", 'Warning', {
                    confirmButtonText: 'OK',
                }); this.authPersonel()
            }
            if(list_document.length == 0){
                this.$alert("Document Can't be null", 'Warning', {
                    confirmButtonText: 'OK',
                }); this.Documents()
            }

            if(this.input.status == 6 && type != 'resubmit' ){
                var request = 'without Upload Document'
            }else{
                var request = ''
            }

            this.$confirm('Do You Want to Submit this Request '+request+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                if(
                  // list_materials.length != 0 &&
                  list_document.length != 0 &&
                  list_auth_personel.length != 0 && list_tools.length != 0
                  // && document.length == 0 && material.length == 0 && tools.length == 0
                ){
                    const loading = this.$loading({
                      lock: true,
                      text: 'Loading',
                      spinner: 'el-icon-loading',
                      background: 'rgba(0, 0, 0, 0.7)'
                    });
                    axios.post(this.url+'/submit', input ).then((res) => {
                      if(res.data.status == 1){
                        this.$alert("Submit With Request Number "+this.input.request_number+" Success", 'Success', { confirmButtonText: 'OK', });
                        this.input = {}
                        this.scrollToTop()
                        this.$router.push('/request');
                      }else{
                        this.$alert('Request Failed', 'Warning', {
                          confirmButtonText: 'OK',
                        });
                      }
                      loading.close();
                    })
                    .catch((error) => {
                      console.log(error);
                      this.err = error.response.data.errors
                      loading.close();
                    })
                  }
            }).catch(() => {
                this.$message({ type: 'info', message: 'Submit Canceled' });
            });
        },
        cancel(){
          this.$confirm('Do You Want Close this Request Without Save ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              this.$router.push('/aircraft_request');
              this.scrollToTop()
          }).catch(() => {
              this.$message({ type: 'info', message: 'Close canceled' });
          });

        },

        // personel action
        addPersonel(p){
            this.personelDialog = false

            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });

            var license = p.license_type
            var no = 0 ;

            for (var i = 0; i < p.length; i++) {
                  if(p.license_type == 'cs'){
                      var gmf_auth_number = p[no].gmf_auth_number
                      var ex_date_company = p[no].ex_date_company
                  }else{
                      var gmf_auth_number = p[no].gmf_auth_number
                      var ex_date_company = p[no].ex_date_company
                  }
                  var obj = {
                          license_type : p.license_type,
                          name : p[no].nama,
                          personal_number : p[no].nopeg,
                          sta : p[no].unit,
                          skill : p[no].jabatan,
                          email : p[no].email,
                          unit : p[no].unit,
                          stamp_no : p[no].stamp_no,
                          amel_no : p[no].amel_no,
                          ex_date_ame : p[no].ex_date_ame,
                          gmf_auth_number : gmf_auth_number,
                          ex_date_company : ex_date_company,
                          amel_scope : JSON.stringify(p[no].amel_scope),
                          gmf_scope : JSON.stringify(p[no].gmf_scope)
                      }
                      this.list_auth_personel.push(obj)
                      console.log(p[no].amel_scope);
                      no ++
            }
            loading.close()
            this.personel = {}
        },

        delPersonel(d, i){
            if(d.id == undefined ){
                this.list_auth_personel.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=auth_personel').then((res) => {
                          this.list_auth_personel.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        // end personel action

        // doc action
        addDoc(d){

            this.list_document.push({
                document_code: '',
                type:  '',
                effective_code: '',
                description_document: '' ,
                manufacture:  '',
                ac_type : '',
                rev:  '',
                rev_date:  '',
                attachment:  '',
            });
            this.documentDialog = false
        },
        delDoc(index, id){
            if(id == undefined ){
                this.list_document.splice(index, 1)
            } else {
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ id +'?type=document').then((res) => {;
                         this.list_document.splice(index, 1)
                         this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        // end_doc action

        // materials action
        addMaterial(){
            if(!!this.list_materials.find(lp => lp.pn == this.partNumber)) {
                this.$alert('Part Number Already Added, You cant add again', 'warning', { confirmButtonText: 'OK', });
                return
            }

            this.list_materials.push({
                pn: this.partNumber,
                description_material: this.$store.state.PartNumber.find(p => p.part_number == this.partNumber).part_description,
                availability : '',
            });
            this.partNumber = ''
        },

        delMaterials(d, i){
            if(d.id == undefined ){
                this.list_materials.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=material').then((res) => {
                         this.list_materials.splice(i, 1)
                         this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        // end material action

        // materials action
        addTools(d){
            // if(!!this.list_tools.find(lp => lp.part_no == this.$store.state.Tools.find(p => p.ID_MASTER == this.keyTools).PARTNUMBER)) {
            //     return
            // }
            if (!!this.list_tools.find(lt => lt.part_no == d.PARTNUMBER)) {
                this.$alert('Tools Already Added, You cant add again', 'warning', { confirmButtonText: 'OK', });
                return
            }else{
                this.$message({
                  type: 'success',
                  message: 'Tools Success Added'
                });
            }

            this.list_tools.push({
                camp_number : d.REGISTER_NUMBER,
                jobcard_number :'',
                title :'',
                mpd_number :'',
                references :'',
                interval :'',
                description_tools: d.DESCRIPTION,
                part_no: d.PARTNUMBER,
                qty : '',
            });
            this.keyTools = ''
        },
        delTools(d, i){
            if(d.id == undefined ){
                this.list_tools.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=tools').then((res) => {;
                         this.list_tools.splice(i, 1)
                         this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        // end material action

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

        // add facility
        addFacilities(d){
            if(d.type){
                this.list_facilities.push({
                    description_main : d.description_main ,
                    description : d.description ,
                    quantity : d.quantity ,
                    unit : d.unit ,
                    status : d.status ,
                    remark : d.remark
                })
            }else{
                for (var i = 0; i < d.length; i++) {
                    this.list_facilities.push(d[i]) ;
                }
            }
            this.facilitiesDialog = false
        },
        delFacilities(d, i){
            if(d.id == undefined ){
                this.list_facilities.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=facilities').then((res) => {;
                         this.list_facilities.splice(i, 1)
                         this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },

        addAdditionalAttachment(d){
            this.list_additional_attachment.push({
                name_attachment : d.attachment
            })
        },
        dellAdditionalAttachment(d, i){
            if(d.id == undefined ){
                this.list_additional_attachment.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=additionalAttachment').then((res) => {;
                         this.list_additional_attachment.splice(i, 1)
                         this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {
                          console.log(err);
                      })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },

        mainForm(){
            this.mainform = true
            this.auth_personel = false
            this.documents = false
            this.materials = false
            this.tools = false
            this.note = false
            this.facilities = false
            this.additionalattachment = false
        },
        authPersonel(){
            this.mainform = false
            this.auth_personel = true
            this.documents = false
            this.materials = false
            this.tools = false
            this.note = false
            this.facilities = false
            this.additionalattachment = false
        },
        Documents(){
            this.mainform = false
            this.auth_personel = false
            this.documents = true
            this.materials = false
            this.tools = false
            this.note = false
            this.facilities = false
            this.additionalattachment = false
        },
        Materials(){
            this.mainform = false
            this.auth_personel = false
            this.documents = false
            this.materials = true
            this.tools = false
            this.note = false
            this.facilities = false
            this.additionalattachment = false
        },
        Tools(){
            this.mainform = false
            this.auth_personel = false
            this.documents = false
            this.materials = false
            this.tools = true
            this.note = false
            this.facilities = false
            this.additionalattachment = false
        },
        Note(){
            this.mainform = false
            this.auth_personel = false
            this.documents = false
            this.materials = false
            this.tools = false
            this.note = true
            this.facilities = false
            this.additionalattachment = false
        },
        Faclity(){
            this.mainform = false
            this.auth_personel = false
            this.documents = false
            this.materials = false
            this.tools = false
            this.note = false
            this.facilities = true
            this.additionalattachment = false
        },
        AdditionalAttachment(){
            this.mainform = false
            this.auth_personel = false
            this.documents = false
            this.materials = false
            this.tools = false
            this.note = false
            this.facilities = false
            this.additionalattachment = true
        },
        customFormatter(date) {
          return moment(date).format('YYYY-MM-DD');
        },
        scrollToTop() {
          window.scrollTo(0,0);
        },
        deleteAllMaterial(){
          if(this.selectedMaterial.length == 0){
            this.$alert('Please Select Data First', 'Warning', {
                confirmButtonText: 'OK',
            });
            return
          }

          this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              for(var i = this.selectedMaterial.length-1 ; i >= 0; i--){
                  const sorting = this.selectedMaterial.sort(function(a, b){return a.index - b.index});
                  var index = sorting[i].index
                  this.list_materials.splice(index, 1)
              }
              var filter = this.selectedMaterial.filter(f => f.id != undefined)
              if(filter.length >= 1){
                let params = {
                  type: 'allMaterial',
                }
                axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                })
              }

              this.$message({ type: 'success', message: 'Delete Completed' });
              this.selectedMaterial = []
              this.selectAllMaterial = false
          }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
          });
        },
        deleteAllPersonel(){
          if(this.selectedPersonel.length == 0){
            this.$alert('Please Select Data First', 'Warning', {
                confirmButtonText: 'OK',
            });
            return
          }
          this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              for(var i = this.selectedPersonel.length-1 ; i >= 0; i--){
                  const sorting = this.selectedPersonel.sort(function(a, b){return a.index - b.index});
                  var index = sorting[i].index
                  this.list_auth_personel.splice(index, 1)
              }
              var filter = this.selectedPersonel.filter(f => f.id != undefined)
              if(filter.length >= 1){
                let params = {
                  type: 'allPersonel',
                }
                axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                })
              }

              this.$message({ type: 'success', message: 'Delete Completed' });
              this.selectedPersonel = []
              this.selectAllPersonel = false
          }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
          });
        },
        deleteAllTestEquipment(){
          if(this.selectedTestEquipment.length == 0){
            this.$alert('Please Select Data First', 'Warning', {
                confirmButtonText: 'OK',
            });
            return
          }

          this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              for(var i = this.selectedTestEquipment.length-1 ; i >= 0; i--){
                  const sorting = this.selectedTestEquipment.sort(function(a, b){return a.index - b.index});
                  var index = sorting[i].index
                  this.list_tools.splice(index, 1)
              }
              var filter = this.selectedTestEquipment.filter(f => f.id != undefined)
              if(filter.length >= 1){
                let params = {
                  type: 'allTestEquipment',
                }
                axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                })
              }

              this.$message({ type: 'success', message: 'Delete Completed' });
              this.selectedTestEquipment = []
              this.selectAllTools = false
          }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
          });
        },
        deleteAllDocument(){
          if(this.selectedDocument.length == 0){
            this.$alert('Please Select Data First', 'Warning', {
                confirmButtonText: 'OK',
            });
            return
          }
          this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              for(var i = this.selectedDocument.length-1 ; i >= 0; i--){
                  const sorting = this.selectedDocument.sort(function(a, b){return a.index - b.index});
                  var index = sorting[i].index
                  this.list_document.splice(index, 1)
              }
              var filter = this.selectedDocument.filter(f => !!f.id)
              if(filter.length >= 1){
                let params = {
                  type: 'allDocument  ',
                }
                axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                })
              }

              this.$message({ type: 'success', message: 'Delete Completed' });
              this.selectedDocument = []
              this.selectAllDocument = false

          }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
          });
        },
        deleteAllFacility(){
          if(this.selectedFacility.length == 0){
            this.$alert('Please Select Data First', 'Warning', {
                confirmButtonText: 'OK',
            });
            return
          }

          this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              for(var i = this.selectedFacility.length-1 ; i >= 0; i--){
                  const sorting = this.selectedFacility.sort(function(a, b){return a.index - b.index});
                  var index = sorting[i].index
                  this.list_facilities.splice(index, 1)
              }
              var filter = this.selectedFacility.filter(f => f.id != undefined)
              if(filter.length >= 1){
                let params = {
                  type: 'allFacility',
                }
                axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                })
              }

              this.$message({ type: 'success', message: 'Delete Completed' });
              this.selectedFacility = []
              this.selectAllFacility = false
          }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
          });
        },
    }
}
</script>

<style media="screen" scoped>
    .selectAll{
        vertical-align: middle;
    }
    .selectAll input[type=checkbox]{
      width: 14px;
      height: 14px;
    }

    .my-input {
        border: none;
        background-color: none;
        padding: 5px 0 5px 10px;
    }
    span{
      color : red ;
    }
</style>
<style lang="css">
.el-select {
    width: 100%;
}

.el-date-editor.el-input, .el-date-editor.el-input__inner {
    width: 100% !important;
}
.el-input__inner, .el-input__icon {
    height: 32px;
    line-height: 32px;
}

input[type=file] {
    display: none ;
}

.hidden {
    display: none ;
}
</style>
