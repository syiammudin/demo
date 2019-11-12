<template>
<div v-if="role_request == 3">
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Engine Capability Request</h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li v-if="idRequest != 0" :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="mainForm()" >Main Form</a></li>
                    <li v-if="idRequest != 0" :class="shopability === true ? 'active' : ''"><a aria-expanded="true" @click="abilityForm()" >Shop Ability</a></li>
                    <li v-if="idRequest != 0" :class="documents === true ? 'active' : ''"><a aria-expanded="true" @click="documentForm()" >Document</a></li>
                    <li v-if="idRequest != 0" :class="personel === true ? 'active' : ''"><a aria-expanded="true" @click="personelForm()" >Personnel</a></li>
                    <li v-if="idRequest != 0" :class="tasklist === true ? 'active' : ''"><a aria-expanded="true" @click="tasklistForm()" >Tasklist Number</a></li>
                    <li v-if="idRequest != 0" :class="vendorlist === true ? 'active' : ''"><a aria-expanded="true" @click="vendorlistForm()" >Vendor List</a></li>
                    <li v-if="idRequest != 0" :class="material === true ? 'active' : ''"><a aria-expanded="true" @click="materialForm()" >Consumable Material</a></li>
                    <li v-if="idRequest != 0" :class="testEquipment === true ? 'active' : ''"><a aria-expanded="true" @click="testEquipmentForm()" >Test Equipment & Special Tools</a></li>
                    <li v-if="idRequest != 0" :class="attachmentfield === true ? 'active' : ''"><a aria-expanded="true" @click="attachmentForm()" >Attachment</a></li>
                </ul>
                <br>

				<div class="form-horizontal">
                    <!-- main  form  -->
                    <div v-show="mainform">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> Request Number  </label>
                            <div class="col-sm-9">
                                <input type="text" :value="input.request_number || RequestNumber"   placeholder="Number of Request" readonly  class="form-control">
                                <span v-if="err.request_number" class="text-danger"> {{ err.request_number[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Request Type</label>
                            <div class="col-lg-9">
                                <div class="col-md-2 radio radio-replace radio-success">
                                    <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Add" checked="checked">
                                    <label for="radio6">Add</label>
                                </div>
                                <div class="col-md-2 radio radio-replace radio-success">
                                    <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Add Change" checked="checked">
                                    <label for="radio6">Add Change</label>
                                </div>
                                <div class="col-md-2 radio radio-replace radio-success">
                                    <input type="radio" disabled v-model="input.request_type" name="radios2" id="radio6" value="Change" checked="checked">
                                    <label for="radio6">Change</label>
                                </div>
                                <div class="col-md-2  radio radio-replace radio-success">
                                    <input type="radio" disabled  v-model="input.request_type" name="radios2" id="radio6" value="Delete" checked="checked">
                                    <label for="radio6">Delete</label>
                                </div>
                                <span v-if="err.request_type" class="text-danger"> {{ err.request_type[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Part Number</label>
                            <div class="col-sm-9">
                                <el-select @change="checkPN" :disabled="input.request_type == 'Change' || input.request_type == 'Delete' " onloadedmetadata="" v-model="input.part_number" multiple clearable placeholder="Select Request type" >
                                    <el-option v-for="(pn, i) in PartNumber " :key="i" :label="pn.part_number" :value="pn.part_number"> </el-option>
                                </el-select>
                                <span v-if="err.part_number" class="text-danger" > {{ err.part_number[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Engine/Component Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" v-model="input.engine_name" placeholder="Engine/Component Name ">
                                <span v-if="err.engine_name" class="text-danger"> {{ err.engine_name[0] }}</span>
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
                                <input type="text" class="form-control" v-model="input.ata_chapter" placeholder="ATA Chapter" v-mask="'##-##-##'" >
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
                              <div class="col-md-3" v-for='(f, i) in ForRating' :key="i"  style="height:50px;">
                                  <input type="checkbox"  :disabled="input.request_type == 'Change' || ((rating[f.name_of_rating] == null  || fixedRatingForChange[f.name_of_rating] == false) && input.request_type == 'Delete') || (fixedRatingForChange[f.name_of_rating]  == true  && input.request_type == 'Add Change')" class="form-control"  v-model="rating[f.name_of_rating]">
                                  <label for="checkbox6">{{ f.name_of_rating }} </label>
                                  <el-select :disabled="(input.request_type == 'Add Change' && fixedRatingForChange[f.name_of_rating] == true) || input.request_type == 'Change'" v-if="rating[f.name_of_rating] == true"  v-model="rating[i]" filterable clearable placeholder="Select Rating" >
                                      <el-option v-for="item in $store.state.ForRating.find(t => t.id == f.id).desciption.split(',')" :key="item"
                                          :label="item"
                                          :value="item">
                                      </el-option>
                                      <div class="hidden" v-if="rating[f.name_of_rating] == true" >
                                          {{ rating[i+'_name'] =  f.name_of_rating }}
                                      </div>
                                  </el-select>
                              </div>
                              <div class="col-lg-12">
                                  <span v-if="err.for_rating" class="text-danger"> {{ err.for_rating[0] }}</span>
                              </div>
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
                                    <input type="checkbox" class="form-control" v-model='input.facilities'>
                                    <label for="checkbox6">Facilities </label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox"  class="form-control" v-model='input.special_tools'>
                                    <label for="checkbox6">Special Tools </label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox"  class="form-control" v-model='input.qualified_personel'>
                                    <label for="checkbox6">Qualified Personnel</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="form-control" v-model='input.approved_data'>
                                    <label for="checkbox6">Approved Data </label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="form-control" v-model='input.appropriate_rating'>
                                    <label for="checkbox6">Appropriate Rating</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" class="form-control" v-model='input.special_equipment'>
                                    <label for="checkbox6">Special Equipment/Test Equipment</label>
                                </div>
                                <div class="col-md-12">
                                  <span v-if="err.manager_statement" class="text-danger"> {{ err.manager_statement[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="line-dashed"></div> -->
                        <!-- <div class="form-group">
                            <label class="col-md-3 label-control">Attachment</label>
                            <div class="col-md-9">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name Document</th>
                                            <th>
                                                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="succesAttach"
                                                :show-file-list="false" >
                                                <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                                            </el-upload>
                                        </th>
                                    </tr>
                                </thead>
                                <tr v-for="a, i in list_attachment">
                                    <td>{{ a }}</td>
                                    <td> <a @click='delattachment(i)'><i class="fa fa-trash"></i> </a> </td>
                                </tr>
                            </table>
                            </div>
                        </div> -->
                    </div>

                    <!-- shop ability -->
                    <div v-show="shopability">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class=" form-group">
                                    <label class="col-sm-4 control-label">Shop Maintenance</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly v-model="input.shop_maintenance" placeholder="Shop Maintenance">
                                        <span v-if="err.shop_maintenance" class="text-danger"> {{ err.shop_maintenance[0] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class=" form-group">
                                    <label class="col-sm-4 control-label">Number Ability</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="input.number_ability" placeholder="Number Ability">
                                        <span v-if="err.number_ability" class="text-danger"> {{ err.number_ability[0] }}</span>
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
                                        <input type="text" class="form-control" v-model="ability['OWNER CODE']" placeholder="Owner Code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nomenclature</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="ability['NOMENCLATURE']" placeholder="Nomenclature">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Sytem</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="ability['SYSTEM']" placeholder="System">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">TBO</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="ability['TBO']" placeholder="TBO">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Check Period</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="ability['CHECK PERIOD']" placeholder="Check Period">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Type Model</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="ability['TYPE MODEL']" placeholder="Type Model">
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
                                        <textarea name="name" rows="8" class="form-control"  v-model="input.inspection">  <pre></pre> </textarea>
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ability</label>
                            <div class="col-sm-10 checkbox checkbox-replace checkbox-success">
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control" v-model="input.ability_inspection" >
                                    <label for="checkbox6">INSPECTION </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control" v-model="input.ability_testing" >
                                    <label for="checkbox6">TESTING </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control" v-model="input.ability_repair" >
                                    <label for="checkbox6">REPAIR </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control" v-model="input.ability_modification" >
                                    <label for="checkbox6">MODIFICATION </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-control" v-model="input.ability_overhauled" >
                                    <label for="checkbox6">OVERHAULED </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- for documents -->
                    <div v-show="documents">
                      <el-button @click="documentDialog = true, index_document = null, data_document = null" size="mini" round icon="fa fa-plus" >Add Document</el-button>
                      <div class="table-responsive">
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
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/engine/document/'+d.manual_status_confirmation">
                                            {{ d.manual_status_confirmation}}
                                        </a><br v-if="d.manual_status_confirmation != null">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/engine/document/'+d.component_maintenance_manual">
                                            {{d.component_maintenance_manual}}
                                        </a><br v-if="d.component_maintenance_manual != null">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/engine/document/'+d.proposed_pd_sheet">
                                            {{ d.proposed_pd_sheet }}
                                        </a>
                                    </td>
                                    <td>
                                        <el-button @click="documentDialog = true,  index_document = i, data_document = d" size="mini" circle icon="fa fa-pencil" ></el-button>
                                        <el-button @click="delDocument(d.id, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- End documents -->


                    <!-- personel form -->
                    <div v-show='personel'>
                        <el-button @click="showDialogPersonel()"  size="mini" icon="fa fa-plus" round > Add Personnel </el-button>
                        <!-- <el-button @click="formImport('personel')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button> -->
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Nomimate</th>
                                        <th>Function</th>
                                        <th>Auth No or Stamp Holder</th>
                                        <th>Unit</th>
                                        <th>Scope Competency</th>
                                        <th>Attachment</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ap, i) in list_personel" :key="i">
                                        <td>{{ ap.name }}</td>
                                        <td>{{ ap.id_number }}</td>
                                        <td>{{ ap.nominate }}</td>
                                        <td>{{ ap.function }}</td>
                                        <td>{{ ap.auth_no_stamp_holder }}</td>
                                        <td>{{ ap.unit }}</td>
                                        <td>{{ ap.scope_competency }}</td>
                                        <td>
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/engine/personel/'+ap.training_certificate">{{ ap.training_certificate }}</a> <br v-if="ap.training_certificate != null">
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/engine/personel/'+ap.personal_ability">{{ ap.personal_ability }}</a> <br v-if="ap.certificate_competence != null ">
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/engine/personel/'+ap.certificate_competence">{{ ap.certificate_competence }}</a> <br v-if="ap.staff_authorization != null">
                                            <a @click="popupAttachmentDialog = true, link = 'uploads/engine/personel/'+ap.staff_authorization">{{ ap.staff_authorization }}</a>
                                        </td>
                                        <td>
                                          <a @click="delPersonel(ap, i)"><i class="icon-trash"></i> </a>
                                          <a @click="showDialogPersonel(i, ap)"><i class="fa fa-pencil"></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- tasklist  form-->
                    <div v-show='tasklist'>
                        <el-button @click="addTasklist()"  size="mini" icon="fa fa-plus" round > Add Tasklist </el-button>
                        <el-button @click="formImport('tasklist')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>No Group</th>
                                        <th>Description</th>
                                        <th>Remark</th>
                                         <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllTasklist' @click="selectAll('tasklist')"> All
                                           </div>
                                          <el-button @click="deleteAllTasklist"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_tasklist" :key="i">
                                        <td><input class="my-input" v-model="d.no_group" placeholder="No Group"></td>
                                        <td><input class="my-input" v-model="d.description_tasklist" placeholder="description"></td>
                                        <td><input class="my-input" v-model="d.remark_tasklist" placeholder="remark"></td>
                                        <td class="text-center">
                                            <a @click="delTasklist(d, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                            <input type="checkbox" :value="d"  v-model="selectedTasklist">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- vendor list -->
                    <div v-show='vendorlist'>
                        <el-button @click="addVendorlist()"  size="mini" icon="fa fa-plus" round > Add Vendor List </el-button>
                        <el-button @click="formImport('vendor_list')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>ATA</th>
                                        <th>Part Name</th>
                                        <th>Vendor</th>
                                        <th>Remark</th>
                                        <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllVendorlist' @click="selectAll('vendorlist')"> All
                                           </div>
                                          <el-button @click="deleteAllVendorList"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_vendorlist" :key="i">
                                        <td><input class="my-input" v-model="d.ata" placeholder="ATA"  v-mask="'##-##-##'" ></td>
                                        <td><input class="my-input" v-model="d.part_name" placeholder="Part Name"></td>
                                        <td><input class="my-input" v-model="d.vendor" placeholder="Vendor"></td>
                                        <td><input class="my-input" v-model="d.remark_vendorlist" placeholder="remark"></td>
                                        <td class="text-center">
                                            <a @click="delVendorlist(d, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                            <input type="checkbox" :value="d"  v-model="selectedVendorlist">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Material list -->
                    <div v-show='material'>
                        <!-- <el-button @click="ToolsDialog = true"  size="mini" icon="fa fa-plus" round > Add Tools </el-button> -->
                        <el-button @click="addMaterial()"  size="mini" icon="fa fa-plus" round > Add Material </el-button>
                        <el-button @click="formImport('material')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <th>QTY</th>
                                        <th>Remark</th>
                                        <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllConsMaterial' @click="selectAll('consMaterial')"> All
                                           </div>
                                          <el-button @click="deleteAllConsMaterial"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_material" :key="i">
                                        <td><input class="my-input" v-model="d.part_number" placeholder="Part Name"></td>
                                        <td><input class="my-input" v-model="d.description_material" placeholder="Description"></td>
                                        <td><input class="my-input" v-model="d.qty" placeholder="QTY"></td>
                                        <td><input class="my-input" v-model="d.remark" placeholder="Remark"></td>
                                        <td class="text-center">
                                            <a @click="delMaterial(d, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                            <input type="checkbox" :value="d"  v-model="selectedConsMaterial">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- testEquipment and special tool -->
                    <div class="form-horizontal" v-show="testEquipment">
                        <div class="table-responsive">
                            <el-button @click="addTestEquipment()" size="mini" round icon="fa fa-plus" >Test Equipment </el-button>
                            <el-button @click="formImport('test_equipment')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <!-- <th>Remark</th> -->
                                        <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllTestEquipment' @click="selectAll('testEquipment')"> All
                                           </div>
                                          <el-button @click="deleteAllTestEquipment"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_test_equipment" :key="i">
                                        <td> <input type="text" class="form-control" v-model="d.part_number"> </td>
                                        <td> <input type="text" class="form-control" v-model="d.part_name"></td>
                                        <!-- <td> <input type="text" class="form-control" v-model="d.remark" name="" value="">  </td> -->
                                        <td class="text-center">
                                            <a @click="delTestEquipment(d, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                            <input type="checkbox" :value="d"  v-model="selectedTestEquipment">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="line-dashed"> </div>
                            <el-button @click="addSpecialTools()" size="mini" round icon="fa fa-plus" >Special Tools </el-button>
                            <el-button @click="formImport('specialtool')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                      <th>Part Number</th>
                                      <th>Part Name</th>
                                      <th>Remark</th>
                                       <th class="text-center">
                                           <div>
                                               <input type="checkbox" v-model='selectAllTools' @click="selectAll('tools')"> All
                                           </div>
                                          <el-button @click="deleteAllTools"  size="mini" icon="fa fa-trash " round > Selected </el-button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_special_tools" :key="i">
                                        <td> <input type="text" class="form-control" v-model="d.part_number" name="" value=""></td>
                                        <td> <input type="text" class="form-control" v-model="d.part_name" name="" value=""> </td>
                                        <td> <input type="text" class="form-control" v-model="d.remark" name="" value=""> </td>
                                        <td class="text-center">
                                            <a @click="delSpecialTools(d, i)"><i class="icon-trash" style="font-size:14pt;"></i> </a>
                                            <input type="checkbox" :value="d"  v-model="selectedTools">
                                            <div class="hidden">
                                                {{ d.index = i }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group" v-if="attachmentfield == true">
                        <div class="col-md-12">
                          <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="succesAttach"
                             :show-file-list="false" >
                             <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                         </el-upload>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name Attachment</th>
                                        <th> </th>
                                </tr>
                            </thead>
                            <tr v-for="(a, i) in list_attachment" :key="i">
                                <td>{{ a }}</td>
                                <td> <a @click='delattachment(i)'><i class="fa fa-trash"></i> </a> </td>
                            </tr>
                        </table>
                        </div>
                    </div>

                    <!-- button save -->
                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <button class="btn btn-primary" @click="save('')" >Save to Draft</button>
                            <button class="btn btn-danger" @click="cancel()" >Cancel</button>
                            <!-- <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link> -->
                            <!-- <button class="btn btn-success" @click="submit()" >Save And Submit</button> -->
                            <button v-if="idRequest != 0" class="btn btn-success" @click="input.status == 6 ? beforeSubmit() : submit()" >
                                {{ input.status == 6 ? 'Save And re-Submit' : 'Save And Submit'}}
                            </button>
                            <button v-if="idRequest != 0" class="btn btn-primary" @click="save('preview')" >save and preview</button>
                        </div>
                    </div>
                </div>
			       </div>
        </div>
    </div>

    <el-dialog title="Note Attachment " :visible.sync="NoteDialog" >
        <attachment :id="idRequest" :type="'engine'" @add="addAttachmentResubmit" />
    </el-dialog>

    <!-- dialog personel -->
    <el-dialog title="Personel List " :visible.sync="personelDialog" >
      <div v-loading="loading">
        <EnginePersonel v-if="personelDialog == true && getdatapersonel.length >= 1" @addPersonel="addPersonel" :getdatapersonel='getdatapersonel' :index_personel="index_personel" :data_personel="data_personel" :list_personel="list_personel" />
      </div>
      <div v-if="this.errorMessage != null" class="text-center">
          <p> {{ this.errorMessage }} </p>
          <br>
          <el-button type='primary' icon='el-icon-refresh' @click="getDataPersonel()"> Reload </el-button>
      </div>
      <br>
      <br>
    </el-dialog>

    <el-dialog title="Tools " :visible.sync="ToolsDialog" >
        <tools @add="addTools" />
    </el-dialog>

    <!-- dialog import -->
    <el-dialog :title=" 'Import ' + imports.type " :visible.sync="importFileDialog" >
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
        For format import excel, you can  <a :href="base_url+'document_n_import/engine/sampel_import/'+imports.type+'.xlsx'" target="_blank" style="color:blue!important">download here</a>
    </el-dialog>

    <el-dialog title="Document " :visible.sync="documentDialog"  @keydown.esc="documentDialog = false">
        <Documents type='document' v-if="documentDialog == true"   :index_document="index_document" :data_document="data_document"  @addDocument="addDocument" />
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
import popupAttachment from '../popupAttachment'
import tools from '../../../components/tools'
import PersonelList from '../../../components/PersonelList'
import attachment from './attachmentResubmit'
import Documents from './Engine/EngineDocument'
import EnginePersonel from './Engine/EnginePersonel'
import { log } from 'util'
export default {
    watch : {
        'input.workshop' : function (v, o){
            if(!v){
                return
            }
            this.input.shop_maintenance = v
        },
        'input.aircraft_type': function(v, o) {
            if (!v) {
                return
            }
            this.ability['AIRCRAFT TYPE'] = this.input.aircraft_type ;
        },
        'input.ata_chapter': function(v, o) {
            if (!v) {
                return
            }
            this.ability['ATA CHAPTER'] = this.input.ata_chapter ;
        },
        'input.part_number': function(v, o) {
            if (!v) {
                return
            }
            this.ability['PART NUMBER'] = this.input.part_number ;
        },
    },
    components: { PersonelList, tools, attachment, Documents, popupAttachment, EnginePersonel},
    computed: {
        requestType() { return this.$store.state.requestTypes.find(t => t.id == 3) },
        AircraftType() { return this.$store.state.AircraftType } ,
        RequestNumber() { return this.$store.state.RequestNumber } ,
        // idRequest(){ return this.type },
        PartNumber() { return this.$store.state.PartNumber } ,
        ForRating() { return this.$store.state.ForRating } ,
        Workshop() { return this.$store.state.Workshop } ,
    },
    created() {;
        this.getData()
        this.$store.state.type_of_request = 'engine'
        this.$store.commit('getRequestType');
        this.$store.commit('getAircraftType')
        this.$store.commit('getRequestNumber');
        this.$store.commit('getPartNumber');
        this.$store.commit('getForRating');
        this.$store.commit('getWorkshop');
        this.$store.commit('getcheckPNEngine');
    },
    props: ['type'] ,
    data() {
      return {
          url : BASE_URL +'submit_engine',base_url :BASE_URL, auth_id : AUTH_LOGIN_ID,
          input : {} , err : [] , rating : {} , ability : {}, abilities : {},
          PartNumberDialog : false, err : [], ToolsDialog : false, note : false , list_note : [], NoteDialog : false ,
          list_personel : [], list_tasklist : [], list_vendorlist : [], list_material : [] , list_document_ability : [],
          list_consumable_material :  [], list_tools : [], list_attachment : [] , idRequest : '' ,
          mainform : true, personel : false, tasklist : false, vendorlist:false, material: false , shopability : false, tools : false ,
          personelDialog : false , importFileDialog : false, imports : {}, role_request : ROLE_REQUEST, documentDialog : false, popupAttachmentDialog : false ,
          documents : false, index_document : '', data_document : {}, list_document : [],  testEquipment : false, list_test_equipment :[] , list_special_tools : [],
          index_personel : '', data_personel : [], fixedRatingForChange : {}, attachmentfield : false,
          selectAllTasklist : false ,  selectAllVendorlist : false, selectAllConsMaterial : false,
          selectAllTestEquipment : false , selectAllTools : false ,
          selectedTasklist : [] , selectedVendorlist : [], selectedConsMaterial : [], selectedTestEquipment : [],
          selectedTools : [], getdatapersonel : [], loading : 'false', errorMessage : null
      }
    },
    methods : {
        getDataPersonel(){
            if(this.getdatapersonel.length >= 1){
              return
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
            this.data_personel = ap
        },
        selectAll(d){
            if(d == 'tasklist'){
                this.selectedTasklist = [];
                if (!this.selectAllTasklist) {
                    for (let i in this.list_tasklist) {
                    this.selectedTasklist.push(this.list_tasklist[i]);
                    }
                }
            }
            if(d == 'vendorlist'){
                this.selectedVendorlist = [];
                if (!this.selectAllVendorlist) {
                    for (let i in this.list_vendorlist) {
                    this.selectedVendorlist.push(this.list_vendorlist[i]);
                    }
                }
            }
            if(d == 'consMaterial'){
                this.selectedConsMaterial = [];
                if (!this.selectAllConsMaterial) {
                    for (let i in this.list_material) {
                    this.selectedConsMaterial.push(this.list_material[i]);
                    }
                }
            }
            if(d == 'testEquipment'){
                this.selectedTestEquipment = [];
                if (!this.selectAllTestEquipment) {
                    for (let i in this.list_test_equipment) {
                    this.selectedTestEquipment.push(this.list_test_equipment[i]);
                    }
                }
            }
            if(d == 'tools'){
                this.selectedTools = [];
                if (!this.selectAllTools) {
                    for (let i in this.list_special_tools) {
                    this.selectedTools.push(this.list_special_tools[i]);
                    }
                }
            }
        },
        deleteAllTasklist(){
            if(this.selectedTasklist.length == 0){
                this.$alert('Please Select Data First', 'Warning', {
                    confirmButtonText: 'OK',
                });
                return
            }
            this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                for(var i = this.selectedTasklist.length-1 ; i >= 0; i--){
                    const sorting = this.selectedTasklist.sort(function(a, b){return a.index - b.index});
                    var index = sorting[i].index
                    this.list_tasklist.splice(index, 1)
                }
                var filter = this.selectedTasklist.filter(f => f.id != undefined)
                if(filter.length >= 1){
                    let params = { type: 'Alltasklist', }
                    axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                        console.log(res.data);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
                this.$message({ type: 'success', message: 'Delete Completed' });
                this.selectedTasklist = []
                this.selectAllTasklist = false
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        deleteAllVendorList(){
            if(this.selectedVendorlist.length == 0){
                this.$alert('Please Select Data First', 'Warning', {
                    confirmButtonText: 'OK',
                });
                return
            }
            this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                for(var i = this.selectedVendorlist.length-1 ; i >= 0; i--){
                    const sorting = this.selectedVendorlist.sort(function(a, b){return a.index - b.index});
                    var index = sorting[i].index
                    this.list_vendorlist.splice(index, 1)
                }
                var filter = this.selectedVendorlist.filter(f => f.id != undefined)
                if(filter.length >= 1){
                    let params = { type: 'Allvendorlist', }
                    axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                        console.log(res.data);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
                this.$message({ type: 'success', message: 'Delete Completed' });
                this.selectedVendorlist = []
                this.selectAllVendorlist = false
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        deleteAllConsMaterial(){
            if(this.selectedConsMaterial.length == 0){
                this.$alert('Please Select Data First', 'Warning', {
                    confirmButtonText: 'OK',
                });
                return
            }
            this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                for(var i = this.selectedConsMaterial.length-1 ; i >= 0; i--){
                    const sorting = this.selectedConsMaterial.sort(function(a, b){return a.index - b.index});
                    var index = sorting[i].index
                    this.list_material.splice(index, 1)
                }
                var filter = this.selectedConsMaterial.filter(f => f.id != undefined)
                if(filter.length >= 1){
                    let params = { type: 'AllconsMaterial', }
                    axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                        console.log(res.data);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
                this.$message({ type: 'success', message: 'Delete Completed' });
                this.selectedConsMaterial = []
                this.selectAllConsMaterial = false
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
                    this.list_test_equipment.splice(index, 1)
                }
                var filter = this.selectedTestEquipment.filter(f => f.id != undefined)
                if(filter.length >= 1){
                    let params = { type: 'AlltestEquipment', }
                    axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                        console.log(res.data);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
                this.$message({ type: 'success', message: 'Delete Completed' });
                this.selectedTestEquipment = []
                this.selectAllTestEquipment = false
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        deleteAllTools(){
            if(this.selectedTools.length == 0){
                this.$alert('Please Select Data First', 'Warning', {
                    confirmButtonText: 'OK',
                });
                return
            }
            this.$confirm('Do You Want Delete this selected data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                for(var i = this.selectedTools.length-1 ; i >= 0; i--){
                    const sorting = this.selectedTools.sort(function(a, b){return a.index - b.index});
                    var index = sorting[i].index
                    this.list_special_tools.splice(index, 1)
                }
                var filter = this.selectedTools.filter(f => f.id != undefined)
                if(filter.length >= 1){
                    let params = { type: 'Alltools', }
                    axios.delete(this.url+'/deleteAll', { params: Object.assign(params, filter.map(a => a.id )) }).then((res) => {
                        console.log(res.data);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
                this.$message({ type: 'success', message: 'Delete Completed' });
                this.selectedTools = []
                this.selectAllTools = false
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },

        checkPN(){
          var PN = this.input.part_number[this.input.part_number.length-1]
          var cek = this.$store.state.checkPNEngine.filter(pn => pn.part_number == PN).length
          if(cek >= 1){
              this.$alert("Selected Part Number ("+PN+") already exist in system. Please select menu Add Part Number and/or Add Authority or Change Request.", 'Warning', { confirmButtonText: 'OK', })
              this.input.part_number.splice((this.input.part_number.length-1), 1)
          }
        },
        succesAttach(response, file, fileList){
            this.list_attachment.push(response.file)
        },
        delattachment(d){
            this.list_attachment.splice(d, 1)
        },
        formImport(type){
            this.imports.type = type
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
            data.append('type', this.imports.type);
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/importExcel', data, config ).then((res) => {
                if(res.data.status == 1){
                    this.importFileDialog = false
                    if(res.data.type == 'material'){
                        for (var i = 0; i < res.data.data.length; i++) {
                            var obj = {
                                    part_number : res.data.data[i].part_number,
                                    description_material : res.data.data[i].description_material,
                                    qty : res.data.data[i].qty,
                                    remark : res.data.data[i].remark
                                }
                            this.list_material.push(obj)
                        }
                    }
                    if(res.data.type == 'vendor_list'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    ata: res.data.data[i].ata,
                                    part_name: res.data.data[i].part_name,
                                    vendor: res.data.data[i].vendor,
                                    remark_vendorlist: res.data.data[i].remark,
                                }
                                this.list_vendorlist.push(obj);
                        }
                    }
                    if(res.data.type == 'specialtool'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    part_number: res.data.data[i].part_number,
                                    part_name: res.data.data[i].part_name,
                                    remark: res.data.data[i].remark,

                                }
                                this.list_special_tools.push(obj);
                        }
                    }
                    if(res.data.type == 'test_equipment'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    part_number: res.data.data[i].part_number,
                                    part_name: res.data.data[i].part_name,

                                }
                                this.list_test_equipment.push(obj);
                        }
                    }
                    if(res.data.type == 'tasklist'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    no_group:res.data.data[i].no_group,
                                    description_tasklist: res.data.data[i].description_tasklist,
                                    remark_tasklist: res.data.data[i].remark_tasklist,
                                }
                                this.list_tasklist.push(obj);
                        }
                    }
                    if(res.data.type == 'personel'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    name:res.data.data[i].name,
                                    id_number: res.data.data[i].id_number,
                                    function: res.data.data[i].function,
                                    auth_no_stamp_holder: res.data.data[i].auth_no_stamp_holder,
                                    unit: res.data.data[i].unit,
                                    scope_competency: res.data.data[i].scope_competency,
                                }
                                this.list_personel.push(obj);
                        }
                    }
                    if(res.data.type == 'tools'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    special_tool:res.data.data[i].special_tool,
                                    base_pn: res.data.data[i].base_pn,
                                    tool_desciption: res.data.data[i].tool_desciption,
                                    task: res.data.data[i].task,
                                    est_arrival: res.data.data[i].est_arrival,
                                }
                                this.list_tools.push(obj);
                        }
                    }

                    const input = this.$refs.fileInput
                    input.type = 'text'
                    input.type = 'file'

                    loading.close()
                }else{
                    loading.close()
                    alert('Import Gagal')
                }
            }).catch((err) => {
                loading.close()
                this.$alert('Upload Failed, Format excel Not match', 'Warning', {
                    confirmButtonText: 'OK',
                });
                console.log(err);
            })
        },
        beforeSubmit(){
          this.$confirm('Do You Want to Save with Upload and Note  ?', 'Warning', {  confirmButtonText: 'Yes', cancelButtonText: 'No', type: 'warning'}).then(() => {
              this.note = true
          }).catch(() => {
              this.submit()
          });
        },
        getData(id){
            if(id == undefined || id == null){
                this.idRequest = this.type
            }else{
                this.idRequest = id
            }
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            if(this.idRequest == 0){
                loading.close();
                this.input.request_type = 'Add'
            }
            axios.get(this.url+'/'+this.idRequest).then((res) => {
                loading.close();
                this.ability = JSON.parse(res.data[0].engine_shop_ability.summary_of_maintenance)
                this.list_consumable_material = JSON.parse(res.data[0].engine_shop_ability.consumable_material)

                this.input = res.data[0].engine_request
                if(res.data[0].engine_request.aircraft_type != null){
                    this.input.aircraft_type = res.data[0].engine_request.aircraft_type.split('|')
                }else{
                    this.input.aircraft_type = []
                }
                if(res.data[0].engine_request.part_number != null){
                    this.input.part_number = res.data[0].engine_request.part_number.split('|')
                }else{
                    this.input.part_number = []
                }

                this.input.request_type = res.data[0].request_type
                this.input.request_id = this.idRequest
                this.input.part_number = res.data[0].engine_request.part_number

                this.rating = JSON.parse(res.data[0].engine_request.for_rating)
                this.fixedRatingForChange = JSON.parse(res.data[0].engine_request.for_rating)


                this.input.request_number = res.data[0].request_number

                this.input.ability_inspection = res.data[0].engine_shop_ability.ability_inspection
                this.input.ability_testing = res.data[0].engine_shop_ability.ability_testing
                this.input.ability_repair = res.data[0].engine_shop_ability.ability_repair
                this.input.ability_modification = res.data[0].engine_shop_ability.ability_modification
                this.input.ability_overhauled = res.data[0].engine_shop_ability.ability_overhauled

                this.input.shop_maintenance = this.input.workshop
                this.input.number_ability = res.data[0].engine_shop_ability.number_ability
                this.input.manufacture_documentation_drawing = res.data[0].engine_shop_ability.manufacture_documentation_drawing
                this.input.inspection = res.data[0].engine_shop_ability.inspection
                this.input.tool_equipment = res.data[0].engine_shop_ability.tool_equipment
                this.input.special_work = res.data[0].engine_shop_ability.special_work
                this.input.particular = res.data[0].engine_shop_ability.particular
                this.input.available_qualified = res.data[0].engine_shop_ability.available_qualified

                this.list_document = res.data[0].engine_document
                this.list_test_equipment = res.data[0].engine_test_equipment
                this.list_special_tools = res.data[0].engine_special_tools

                this.list_note = res.data[0].attachment_resubmit
                this.input.status = res.data[0].status


                this.list_personel = res.data[0].engine_personel
                this.list_tasklist = res.data[0].engine_tasklist_number
                this.list_vendorlist = res.data[0].engine_vendor_list
                this.list_material = res.data[0].engine_consumable_material
                this.list_tools = res.data[0].engine_tool
                if(res.data[0].engine_request.attachment != null ){
                    this.list_attachment = res.data[0].engine_request.attachment.split('|')
                }

                if(res.data[0].engine_shop_ability.document_requirement != null){
                    const da = res.data[0].engine_shop_ability.document_requirement.split('|')
                    const stp_number = res.data[0].engine_shop_ability.special_tool_part_number.split('|')
                    const stp_name = res.data[0].engine_shop_ability.special_tool_part_name.split('|')
                    const tep_number = res.data[0].engine_shop_ability.test_equipment_part_number.split('|')
                    const tep_name = res.data[0].engine_shop_ability.test_equipment_part_name.split('|')
                    const remark = res.data[0].engine_shop_ability.remark.split('|')

                    var doc_abl = [];
                    for(var i = 0 ; i < da.length; i++){
                        if(i != (da.length-1)){
                            var obj = { document_requirement: da[i],
                                test_equipment_part_name: stp_name[i],
                                test_equipment_part_number: stp_number[i],
                                special_tool_part_name: tep_name[i],
                                special_tool_part_number: tep_number[i],
                                remark: remark[i],
                            }
                            doc_abl.push(obj);
                        }
                    }
                    this.list_document_ability = doc_abl
                }
            })
            .catch((err) => {

            })
        },
        save(preview){
            this.input.master_request_id = this.requestType.id
            this.input.personel = this.list_personel
            this.input.tasklist = this.list_tasklist
            this.input.vendorlist = this.list_vendorlist
            this.input.material = this.list_material
            this.input.tools = this.list_tools
            this.input.attachment = this.list_attachment
            this.input.summary_of_maintenance = JSON.stringify(this.ability)
            this.input.ablity = JSON.stringify(this.abilities)
            if(jQuery.isEmptyObject(this.rating)){
              this.input.for_rating = null
            }else{
              this.input.for_rating = JSON.stringify(this.rating)
            }
            if(this.input.facilities == undefined &&  this.input.certifying_staff  == undefined &&  this.input.approved_data  == undefined &&  this.input.qualified_personel  == undefined &&  this.input.special_tools  == undefined &&  this.input.consumable == undefined ){
                this.input.manager_statement = null
            }else{
                this.input.manager_statement = 'OK'
            }

            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.document_ability = this.list_document_ability
            this.input.list_document = this.list_document
            this.input.list_test_equipment = this.list_test_equipment
            this.input.list_special_tools = this.list_special_tools

            if(preview == 'preview'){
              var text = '& Preview '
            }else{
              var text = ''
            }
            this.$confirm('Do You Want Save to Draft '+text+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
              axios.post(this.url, this.input).then((res) => {
                console.log(res.data);
                if(res.data.status === 1){
                  if(preview == 'preview'){
                    if(this.type == 0){
                      this.$router.push({ name: 'form_engine', params: { type: res.data.id } })
                      this.input.request_id = res.data.id
                      this.preview(res.data.id)
                    }
                    this.getData(res.data.id)
                    this.preview(res.data.id)
                  }else{
                    if(this.type == 0){
                      this.$router.push({ name: 'form_engine', params: { type: res.data.id } })
                      this.input.request_id = res.data.id
                      this.idRequest = res.data.id
                      this.getData(res.data.id)
                    }else{
                      this.$router.push('/engine_requests');
                    }
                    this.input = {}
                    this.scrollToTop()
                    this.err = []
                  }
                  loading.close();
                }else{
                  loading.close();
                  this.$alert('Request Failed', 'Warning', {
                    confirmButtonText: 'OK',
                  });
                }
              })
              .catch((error) => { console.log(error);  this.err = error.response.data.errors; loading.close() })
            }).catch(() => {
                loading.close();
                this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        submit(type){
            this.input.master_request_id = this.requestType.id
            this.input.personel = this.list_personel
            this.input.tasklist = this.list_tasklist
            this.input.vendorlist = this.list_vendorlist
            this.input.material = this.list_material
            this.input.tools = this.list_tools
            this.input.summary_of_maintenance = JSON.stringify(this.ability)
            this.input.ablity = JSON.stringify(this.abilities)
            this.input.for_rating = JSON.stringify(this.rating)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.document_ability = this.list_document_ability
            this.input.list_document = this.list_document
            this.input.list_test_equipment = this.list_test_equipment
            this.input.list_special_tools = this.list_special_tools

            const tasklist = this.list_tasklist.filter(cek => cek.no_group == null || cek.description_tasklist == null || cek.remark_tasklist == null)
            const vendorlist = this.list_vendorlist.filter(cek => cek.ata == null || cek.part_name == null || cek.vendor == null )
            const material = this.list_material.filter(cek => cek.code_number == null || cek.description_material == null )
            const tools = this.list_tools.filter(cek => cek.special_tool == null || cek.base_pn == null || cek.tool_desciption == null || cek.task == null || cek.est_arrival == null )
            const cek_consumable_material = this.list_consumable_material.filter(cek => cek.part_number == null || cek.desciption == null || cek.qty == null || cek.remark == 0)
            const documentability = this.list_document_ability.filter(cek => cek.document_requirement == null || cek.test_equipment_part_number == null || cek.test_equipment_part_name == null
                                                                            || cek.special_tool_part_number == null || cek.special_tool_part_name == null|| cek.remark == null)

            if(tasklist.length >= 1){
                this.$alert("Please Fill data tasklist ", 'Warning', { confirmButtonText: 'OK', }); this.tasklistForm()
            }
            if(vendorlist.length >= 1){
                this.$alert("Please Fill data vendor list", 'Warning', { confirmButtonText: 'OK', }); this.vendorlistForm()
            }

            if(cek_consumable_material.length >= 1){
                this.$alert("Please Fill data in Material", 'Warning', { confirmButtonText: 'OK', }); this.materialForm()
                return
            }
            if(tools.length >= 1){
                this.$alert("Please Fill data in Tools", 'Warning', { confirmButtonText: 'OK', }); this.toolsForm()
                return
            }


            if(this.list_personel.length == 0){
                this.$alert("Personel Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.personelForm()
                return
            }
            if(this.list_tasklist.length == 0){
                this.$alert("Tasklist Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.tasklistForm()
                return
            }
            if(this.list_vendorlist.length == 0){
                this.$alert("Vendorlist Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.vendorlistForm()
                return
            }


            if(this.list_personel.length != 0 && this.list_tasklist.length != 0 &&  this.list_vendorlist.length != 0
                && tasklist.length == 0 && vendorlist.length == 0
              ){
                const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                if(this.input.status == 6 && type != 'resubmit' ){
                    var request = 'without Upload Document'
                }else{
                    var request = ''
                }

                this.$confirm('Do You Want to Submit this Request '+request+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                  axios.post(this.url+'/submit',  this.input ).then((res) => {
                    if(res.data.status === 1){
                      loading.close();
                      this.$alert("Submit With Request Number "+this.input.request_number+" Success", 'Success', { confirmButtonText: 'OK', });
                      this.input = {}
                      this.$router.push('/request');
                      this.scrollToTop()
                    }else{
                      loading.close();
                      this.$alert('Request Failed', 'Warning', {
                        confirmButtonText: 'OK',
                      });
                    }
                    console.log(res.data);
                  })
                  .catch((error) => {
                    console.log(error);
                    this.err = error.response.data.errors
                    loading.close();
                  })
                }).catch(() => {
                    loading.close();
                    this.$message({ type: 'info', message: 'Submit Canceled' });
                });
            }
        },
        preview(id){
          window.open(this.url+"/detail/"+id, '_blank')
        },
        mainForm(){
            this.mainform = true
            this.shopability = false
            this.tasklist = false
            this.personel = false
            this.vendorlist = false
            this.material = false
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        personelForm(){
            this.mainform = false
            this.tasklist = false
            this.shopability = false
            this.vendorlist = false
            this.material = false
            this.personel = true
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        tasklistForm(){
            this.mainform = false
            this.personel = false
            this.shopability = false
            this.vendorlist = false
            this.material = false
            this.tasklist = true
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        vendorlistForm(){
            this.mainform = false
            this.personel = false
            this.shopability = false
            this.tasklist = false
            this.material = false
            this.vendorlist = true
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        materialForm(){
            this.mainform = false
            this.personel = false
            this.shopability = false
            this.tasklist = false
            this.vendorlist = false
            this.material = true
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        abilityForm(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = true
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        toolsForm(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = false
            this.tools = true
            this.note = false
            this.testEquipment = false
            this.documents = false
            this.attachmentfield = false
        },
        testEquipmentForm(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = false
            this.tools = false
            this.note = false
            this.testEquipment = true
            this.documents = false
            this.attachmentfield = false
        },
        documentForm(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = false
            this.tools = false
            this.note = false
            this.testEquipment = false
            this.documents = true
            this.attachmentfield = false
        },
        Note(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = false
            this.tools = false
            this.note = true
            this.attachmentfield = false
        },
        attachmentForm(){
            this.mainform = false
            this.personel = false
            this.tasklist = false
            this.vendorlist = false
            this.material = false
            this.shopability = false
            this.tools = false
            this.testEquipment = false
            this.note = false
            this.attachmentfield = true
        },
        //Material
        addMaterial(){
          this.list_material.push({
            part_number : '',
            description_material : '',
            qty : '',
            remark : ''
          })
        },
        delMaterial(d,i){
          if(d.id == undefined ){
            this.list_material.splice(i, 1)
          }else{
            this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              axios.delete(this.url+'/'+ d.id+'?type=material').then((res) => {
                this.list_material.splice(i, 1)
                this.$message({ type: 'success', message: 'Delete completed' });
              })
              .catch((err) => {  console.log(err); })
            }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
          }
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
            }
            this.documentDialog = false
        },
        delDocument(id, i){

          if(id == undefined ){
              this.list_document.splice(i, 1)
          }else{
              this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: ' OK ', cancelButtonText: ' Cancel ', type: 'warning' }).then(() => {
                axios.delete(this.url+'/'+ id+'?type=document').then((res) => {
                  this.list_document.splice(i, 1)
                  this.$message({ type: 'success', message: 'Document Success deleted'});
                  this.getData()
                })
                .catch((err) => {
                  console.log(err);
                })
              }).catch(() => {
                this.$message({ type: 'info',  message: 'Delete canceled' });
              });
          }
        },
        addPersonel(d){
            if(d.index == null ){
              this.list_personel.push({
                  name: d.name,
                  id_number: d.id_number,
                  function : d.function,
                  auth_no_stamp_holder: d.auth_no_stamp_holder ,
                  unit: d.unit,
                  scope_competency: d.scope_competency,
                  nominate: d.nominate,
                  training_certificate: d.training_certificate,
                  personal_ability: d.personal_ability,
                  certificate_competence: d.certificate_competence,
                  staff_authorization: d.staff_authorization
              });
            }else{
                this.list_personel[d.index].name = d.name
                this.list_personel[d.index].id_number = d.id_number
                this.list_personel[d.index].function = d.function
                this.list_personel[d.index].auth_no_stamp_holder = d.auth_no_stamp_holder
                this.list_personel[d.index].unit = d.unit
                this.list_personel[d.index].scope_competency = d.scope_competency
                this.list_personel[d.index].nominate = d.nominate
                this.list_personel[d.index].training_certificate = d.training_certificate
                this.list_personel[d.index].personal_ability = d.personal_ability
                this.list_personel[d.index].certificate_competence = d.certificate_competence
                this.list_personel[d.index].staff_authorization = d.staff_authorization
            }
            this.personelDialog = false
            this.personel = {}
        },
        delPersonel(d, i){
            if(d.id == undefined ){
                this.list_personel.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=personel').then((res) => {
                          this.list_personel.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {  console.log(err); })
                }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
            }
        },
        addTasklist(p){
            this.list_tasklist.push({
                no_group:"",
                description_tasklist: "",
                remark_tasklist: "",
            });
        },
        delTasklist(d, i){
            if(d.id == undefined ){
                this.list_tasklist.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=tasklist').then((res) => {
                          this.list_tasklist.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => { console.log(err); })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        addVendorlist(p){
            this.list_vendorlist.push({
                ata:"",
                part_name: "",
                vendor: "",
                remark_vendorlist: "",
            });
        },
        delVendorlist(d, i){
            if(d.id == undefined ){
                this.list_vendorlist.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=vendorlist').then((res) => {
                          this.list_vendorlist.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => { console.log(err); })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        addTools(d){
            if (!!this.list_tools.find(lt => lt.base_pn == d.PARTNUMBER)) {
                this.$alert('Tools Already Added, You cant add again', 'warning', { confirmButtonText: 'OK', });
                return
            }else{
                this.$message({
                  type: 'success',
                  message: 'Tools Success Added'
                });
            }

            this.list_tools.push({
                special_tool:"",
                base_pn: d.PARTNUMBER,
                tool_desciption: "",
                task: "",
                est_arrival: "",
            });
        },
        delTools(d, i){
          alert(d)
          return
            if(d.id == undefined ){
                this.list_tools.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=tools').then((res) => {
                          this.list_tools.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => { console.log(err);  })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Delete canceled' });
                });
            }
        },
        document_ability(p){
            this.list_document_ability.push({
                document_requirement:"",
                test_equipment_part_name: '',
                test_equipment_part_number: '',
                special_tool_part_name: '',
                special_tool_part_number: '',
                remark: "",
            });
        },
        delDocumentAbility(d, i){
            this.list_document_ability.splice(i, 1)
        },
        addConsumableMaterial(p){
            this.list_consumable_material.push({
                part_number:"",
                desciption: '',
                qty: '',
                remark: '',
            });
        },
        delConsumableMaterial(d, i){
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
        addTestEquipment(){
          this.list_test_equipment.push({
              part_number : '',
              part_name : '',
              remark : ''
          })
        },
        delTestEquipment(d, i){
          if(d.id == undefined ){
              this.list_test_equipment.splice(i, 1)
          }else{
              this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                    axios.delete(this.url+'/'+ d.id+'?type=test_equipment').then((res) => {
                        this.list_test_equipment.splice(i, 1)
                        this.$message({ type: 'success', message: 'Delete completed' });
                    })
                    .catch((err) => { console.log(err);  })
              }).catch(() => {
                  this.$message({ type: 'info', message: 'Delete canceled' });
              });
          }
        },
        addSpecialTools(){
          this.list_special_tools.push({
              part_number : '',
              part_name : '',
              remark : ''
          })
        },
        delSpecialTools(d, i){
          if(d.id == undefined ){
              this.list_special_tools.splice(i, 1)
          }else{
              this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                    axios.delete(this.url+'/'+ d.id+'?type=specialtools').then((res) => {
                        this.list_special_tools.splice(i, 1)
                        this.$message({ type: 'success', message: 'Delete completed' });
                    })
                    .catch((err) => { console.log(err);  })
              }).catch(() => {
                  this.$message({ type: 'info', message: 'Delete canceled' });
              });
          }
        },
        cancel(){
          this.$confirm('Do You Want Close this Request Without Save ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              this.$router.push('/engine_requests');
              this.scrollToTop()
          }).catch(() => {
              this.$message({ type: 'info', message: 'Close canceled' });
          });

        },
        scrollToTop() {
          window.scrollTo(0,0);
        }


    }
}
</script>
<style lang="css" media="html" scoped>
.my-input {
    border: none;
    background-color: none;
    padding: 5px 0 5px 10px;
}

.el-select {
    width: 100%;
}

.el-date-editor.el-input, .el-date-editor.el-input__inner {
    width: 100%;
}

.el-input__inner, .el-input__icon .el-input--suffix{
    height: 32px;
    line-height: 32px;
}

</style>
