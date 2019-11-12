<template>
<div v-if="role_request == 4">
    <div class="col-lg-12  z-index-41" v-if="input.status == undefined || input.status == 0 || input.status == 6">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Special Process Request</h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li v-if="idRequest != 0" :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="mainForm()" >Main Form</a></li>
                    <li v-if="idRequest != 0" :class="shopability === true ? 'active' : ''"><a aria-expanded="true" @click="abilityForm()" >Shop Ability</a></li>
                    <li v-if="idRequest != 0" :class="documents === true ? 'active' : ''"><a aria-expanded="true" @click="documentForm()" >Document</a></li>
                    <li v-if="idRequest != 0" :class="personel === true ? 'active' : ''"><a aria-expanded="true" @click="personelForm()" >Personnel</a></li>
                    <li v-if="idRequest != 0" :class="tools === true ? 'active' : ''"><a aria-expanded="true" @click="toolsForm()" >Special Tools</a></li>
                    <li v-if="idRequest != 0" :class="test_equipment === true ? 'active' : ''"><a aria-expanded="true" @click="testEquipmentForm()" >Test Equipment</a></li>
                    <li v-if="idRequest != 0" :class="material === true ? 'active' : ''"><a aria-expanded="true" @click="materialForm()" >Material</a></li>

                    <!-- <li :class="sheetlist === true ? 'active' : ''"><a aria-expanded="true" @click="sheetlistForm()" >Sheet List</a></li>
                    <li :class="partlist === true ? 'active' : ''"><a aria-expanded="true" @click="partlistForm()" >Part List</a></li>
                    <li :class="note === true ? 'active' : ''" v-if="input.status == 6"><a aria-expanded="false" @click="Note()">Note Resubmit</a></li> -->
                </ul>
                <br>
                <div class="form-horizontal">
                    <!-- main  form  -->
                    <div v-show="mainform">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> Request Number </label>
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
                                <span v-if="err.request_type" class="text-danger"> {{ err.aircraft_type[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">NDT Mehtods</label>
                            <div class="col-sm-9">
                                <el-select :disabled="input.request_type == 'Change' || input.request_type == 'Delete' || input.request_type == 'Add Change'" v-model="input.part_number" filterable clearable placeholder="Select NDT Methods" >
                                    <el-option v-for="item in NdtMethods" :key="item.ndt_method"
                                        :label="item.ndt_method"
                                        :value="item.ndt_method">
                                    </el-option>
                                </el-select>
                                <!-- <input type="text" class="form-control" v-model="input.part_number" placeholder="Number of Document"> -->
                                <span v-if="err.part_number" class="text-danger" > {{ err.part_number[0].replace("part number","NDT Method") }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Engine/Component Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" v-model="input.engine_name" placeholder="Engine/Component Name">
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
                                    <el-option v-for="item in AircraftType" :key="item.code"
                                        :label="item.aircraft_type"
                                        :value="item.aircraft_type">
                                    </el-option>
                                </el-select>
                                <span v-if="err.aircraft_type" class="text-danger"> {{ err.aircraft_type[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">ATA Chapter</label>
                            <div class="col-sm-9">
                                <input type="tel" v-mask="'##-##-##'"  class="form-control" v-model="input.ata_chapter" placeholder="ATA Chapter">
                                <span v-if="err.ata_chapter"  class="text-danger"> {{ err.ata_chapter[0] }}</span>
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
                              <div class="col-md-3" v-for='(f, i) in ForRating' style="height:50px;" :key="i">
                                  <input type="checkbox"  :disabled="input.request_type == 'Change' || ((rating[f.name_of_rating] == null  || fixedRatingForChange[f.name_of_rating] == false) && input.request_type == 'Delete') || (fixedRatingForChange[f.name_of_rating]  == true  && input.request_type == 'Add Change')" class="form-control"  v-model="rating[f.name_of_rating]">
                                  <label for="checkbox6">{{ f.name_of_rating }} </label>
                                  <el-select :disabled="(input.request_type == 'Add Change' && fixedRatingForChange[f.name_of_rating] == true) || input.request_type == 'Change'" v-if="rating[f.name_of_rating] == true"  v-model="rating[i]" filterable clearable placeholder="Select Rating" >
                                      <el-option v-for="item in $store.state.ForRating.find(t => t.id == f.id).desciption.split(',')" :key="item"
                                          :label="item"
                                          :value="item">
                                      </el-option>
                                      <div class="hidden">
                                          {{ rating[i+'_name'] = f.name_of_rating }}
                                      </div>
                                  </el-select>
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
                                <div class="col-lg-12">
                                    <span v-if="err.aproval_request_carry_out" class="text-danger"> {{ err.aproval_request_carry_out[0] }}</span>
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
                    </div>

                    <!-- shop ability form -->
                    <div v-show="shopability">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class=" form-group">
                                    <label class="col-sm-2 control-label">SHOP ABILITY NUMBER</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="input.shop_ability_number" placeholder="Number Ability">
                                        <span v-if="err.shop_ability_number" class="text-danger"> {{ err.shop_ability_number[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">NDT METHOD</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" v-model="input.ndt_method" name="" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">REFERENCES </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="input.reference" placeholder="Nomenclature">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ABILITY</label>
                                    <div class="col-md-10 checkbox checkbox-replace checkbox-success">
                                        <div class="col-md-3 ">
                                            <input type="checkbox" class="form-control" v-model='ability.on_wing'>
                                            <label for="checkbox6">On Wing </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox"  class="form-control" v-model='ability.removed'>
                                            <label for="checkbox6">Removed </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">  REQUIREMENT</label>
                                  <div class="col-md-10 checkbox checkbox-replace checkbox-success">
                                    <div class="col-md-3 ">
                                      <input type="checkbox" class="form-control" v-model='special_facility.dark_room'>
                                      <label for="checkbox6">Dark Room </label>
                                    </div>
                                    <div class="col-md-3">
                                      <input type="checkbox"  class="form-control" v-model='special_facility.exposure_room'>
                                      <label for="checkbox6">Exposure Room </label>
                                    </div>
                                    <div class="col-md-3">
                                      <input type="checkbox"  class="form-control" v-model='special_facility.not_required'>
                                      <label for="checkbox6">Not Required </label>
                                    </div>
                                  </div>
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
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/special/document/'+d.manual_status_confirmation">
                                            {{ d.manual_status_confirmation}}
                                        </a><br v-if="d.manual_status_confirmation != null">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/special/document/'+d.component_maintenance_manual">
                                            {{d.component_maintenance_manual}}
                                        </a><br v-if="d.component_maintenance_manual != null">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/special/document/'+d.proposed_pd_sheet">
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

                    <!-- Persone Form  -->
                    <div v-show="personel">
                        <div class="form-horizontal" v-show='personel'>
                            <el-button @click="showDialogPersonel(null, null)" size="mini" round icon="fa fa-plus" >Add Personnel</el-button>
                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Nominate</th>
                                            <th>Name</th>
                                            <th>Id Number</th>
                                            <th>Level</th>
                                            <th>Attachment</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(d, i) in list_personel" :key="i">
                                            <td> {{ d.nominate }}</td>
                                            <td> {{ d.name }}</td>
                                            <td> {{ d.id_number }}</td>
                                            <td> {{ d.level }}</td>
                                            <td>
                                                <a @click="popupAttachmentDialog = true, link = 'uploads/special/personel/'+d.training_certificate">{{ d.training_certificate }}</a> <br v-if="d.training_certificate != null">
                                                <a @click="popupAttachmentDialog = true, link = 'uploads/special/personel/'+d.personal_ability">{{ d.personal_ability }}</a> <br v-if="d.certificate_competence != null ">
                                                <a @click="popupAttachmentDialog = true, link = 'uploads/special/personel/'+d.certificate_competence">{{ d.certificate_competence }}</a> <br v-if="d.staff_authorization != null">
                                                <a @click="popupAttachmentDialog = true, link = 'uploads/special/personel/'+d.staff_authorization">{{ d.staff_authorization }}</a>
                                            </td>
                                            <td>
                                              <el-button @click="delPersonel(d, i)" size="mini" circle icon="fa fa-trash" ></el-button>
                                              <el-button @click="showDialogPersonel(i, d)" size="mini" circle icon="fa fa-pencil" ></el-button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Sheetlist list -->
                    <div v-show='sheetlist'>
                        <el-button @click="addSheetlist()"  size="mini" icon="fa fa-plus" round > Add Sheet List </el-button>
                        <el-button @click="formImport('sheetlist')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>

                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>PD Sheet No.</th>
                                        <th>Desciption</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_sheetlist" :key="i">
                                        <td><input class="my-input" v-model="d.category" placeholder="Category"></td>
                                        <td><input class="my-input" v-model="d.pd_sheet_number" placeholder="Sheet Number"></td>
                                        <td><input class="my-input" v-model="d.description" placeholder="Description"></td>
                                        <td> <a @click="delSheetlist(d, i)"><i class="icon-trash"></i> </a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tools list -->
                    <div v-show='tools'>
                        <!-- <el-button @click="ToolsDialog = true"  size="mini" icon="fa fa-plus" round > Add Tools </el-button> -->
                        <el-button @click="addTools()"  size="mini" icon="fa fa-plus" round > Add Tools </el-button>
                        <!-- <el-button @click="formImport('tools')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button> -->

                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <!-- <th>QTY</th> -->
                                        <!-- <th>Remark</th> -->
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_tools" :key="i">
                                        <td><input class="form-control" v-model="d.part_name" placeholder="Part Number"></td>
                                        <td><input class="form-control" v-model="d.tool_name" placeholder="Part Name"></td>
                                        <!-- <td><input class="my-input" v-model="d.qty" placeholder="Qty"></td> -->
                                        <!-- <td><input class="my-input" v-model="d.availability" placeholder="Remark"></td> -->
                                        <td> <a @click="delTools(d, i)"><i class="icon-trash"></i> </a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- test Equipment -->
                    <div v-show='test_equipment'>
                        <!-- <el-button @click="ToolsDialog = true"  size="mini" icon="fa fa-plus" round > Add Tools </el-button> -->
                        <el-button @click="addTestEquipment()"  size="mini" icon="fa fa-plus" round > Add Test Equipment </el-button>

                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <!-- <th>Remark</th> -->
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_test_equipment" :key="i">
                                        <td><input class="form-control" v-model="d.part_number" placeholder="Part Number"></td>
                                        <td><input class="form-control" v-model="d.part_name" placeholder="Part Name"></td>
                                        <!-- <td><input class="my-input" v-model="d.remark" placeholder="Remark"></td> -->
                                        <td> <a @click="delTestEquipment(d, i)"><i class="icon-trash"></i> </a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- material -->
                    <div v-show='material'>
                        <!-- <el-button @click="ToolsDialog = true"  size="mini" icon="fa fa-plus" round > Add Tools </el-button> -->
                        <el-button @click="addMaterial()"  size="mini" icon="fa fa-plus" round > Add Material </el-button>

                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <th>Remark</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_material" :key="i">
                                        <td><input class="form-control" v-model="d.part_number" placeholder="Part Number"></td>
                                        <td><input class="form-control" v-model="d.part_name" placeholder="Part Name"></td>
                                        <td><input class="form-control" v-model="d.remark" placeholder="Remark"></td>
                                        <td> <a @click="delMaterial(d, i)"><i class="icon-trash"></i> </a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- partlist list -->
                    <div v-show='partlist'>
                        <el-button @click="addPartlist()"  size="mini" icon="fa fa-plus" round > Add partlist </el-button>
                        <el-button @click="formImport('partlist')"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>

                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Part Name</th>
                                        <th>Exampe of Partname</th>
                                        <th>Vendor Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_partlist" :key="i">
                                        <td><input class="my-input" v-model="d.part_name" placeholder="Part Name"></td>
                                        <td><input class="my-input" v-model="d.example_part_number" placeholder="Exampe of Part Name"></td>
                                        <td><input class="my-input" v-model="d.vendor_name" placeholder="Vendor Name"></td>
                                        <td> <a @click="delPartlist(d, i)"><i class="icon-trash"></i> </a> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <button class="btn btn-primary" @click="save()" >Save to Draft</button>
                            <button class="btn btn-danger" @click="cancel" >Cancel</button>
                            <!-- <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link> -->
                            <!-- <button class="btn btn-success" @click="submit()" >Save And Submit</button> -->
                            <button v-if="idRequest != 0" class="btn btn-success" @click="input.status == 6 ? beforeSubmit() : submit()" >
                                {{ input.status == 6 ? 'Save And re-Submit' : 'Save And Submit'}}
                            </button>
                            <button v-if="idRequest != 0" class="btn btn-primary" @click="save('preview')"  >save and preview</button>
                        </div>
                    </div>
                </div>
            </div>

            {{ }}
        </div>
    </div>

    <!-- dialog personel -->
    <el-dialog title="Personel List" :visible.sync="personelDialog" >
      <div v-loading="loading">
        <specialPersonel v-if="personelDialog == true && getdatapersonel.length >= 1" @addPersonel="addPersonel" :getdatapersonel='getdatapersonel' :index_personel="index_personel" :data_personel="data_personel"  :list_personel="list_personel" />
      </div>
      <div v-if="this.errorMessage != null" class="text-center">
          <p> {{ this.errorMessage }} </p>
          <br>
          <el-button type='primary' icon='el-icon-refresh' @click="getDataPersonel()"> Reload </el-button>
      </div>
      <br>
      <br>
    </el-dialog>

    <el-dialog title="Personel List" :visible.sync="QualifiedPersonelDialog" >
        <PersonelList  @addQualifiedPersonel="addQualifiedPersonel" :type_personel="type_personel"/>
    </el-dialog>

    <el-dialog title="Tools " :visible.sync="ToolsDialog" >
        <tools @add="addTools" />
    </el-dialog>
    <el-dialog title="Note Attachment " :visible.sync="NoteDialog" >
        <attachment :id="type" :type="'special'" @add="addAttachmentResubmit" />
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
        For format import excel, you can  <a :href="base_url+'document_n_import/special/sampel_import/'+imports.type+'.xlsx'" target="_blank">download here</a>
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
import PersonelList from '../../../components/PersonelList'
import tools from '../../../components/tools'
import attachment from './attachmentResubmit'
import Documents from './special/specialDocument'
import specialPersonel from './special/specialPersonel'
import popupAttachment from '../popupAttachment'
export default {
    components: { PersonelList, tools, attachment, Documents, popupAttachment, specialPersonel},
    props: ['type'] ,
    mounted(){
        this.getData();
    },
    watch : {
        'input.workshop' : function (v, o){
            if(!v){
                return
            }
            this.input.shop_maintenance = v
        },
        'input.part_number': function(v, o) {
            if (!v) {
                return
            }
            this.input.ndt_method = this.input.part_number ;
        },
    },
    computed : {
        requestType() { return this.$store.state.requestTypes.find(t => t.id == 4) },
        AircraftType() { return this.$store.state.AircraftType } ,
        RequestNumber() { return this.$store.state.RequestNumber } ,
        // idRequest(){ return this.type },
        PartNumber() { return this.$store.state.PartNumber } ,
        Workshop() { return this.$store.state.Workshop } ,
        ForRating() { return this.$store.state.ForRating } ,
        NdtMethods() { return this.$store.state.NdtMethods } ,
    },
    created(){
        this.$store.state.type_of_request = 'special'
        this.$store.commit('getRequestType');
        this.$store.commit('getAircraftType')
        this.$store.commit('getRequestNumber');
        this.$store.commit('getPartNumber');
        this.$store.commit('getForRating');
        this.$store.commit('getWorkshop');
        this.$store.commit('getNdtMethods');
    },
    data(){
        return {
            url : BASE_URL +'submit_special',base_url :BASE_URL, auth_id : AUTH_LOGIN_ID, err : [] , popupAttachmentDialog : false, link : '',
            data : [], input : {}, rating : {},ability : {}, ToolsDialog : false ,
            mainform : true , shopability : false, personel : false , sheetlist : false, tools : false, partlist : false,
            personelDialog : false , importFileDialog : false , imports : {},
            list_document_ability : [], list_attachment: [], list_consumable_material : [], role_request : ROLE_REQUEST,
            list_personel : [] , list_sheetlist : [] , list_tools : [] , list_partlist : [] , manual_revision : {},
            note : false , list_note : [], NoteDialog : false , idRequest : '',
            list_qualified_personel : [] , type_personel : '', QualifiedPersonelDialog : false, aproval_request_carry_out : {},
            documents : false, tools : false, test_equipment : false, material : false, special_facility  : {} , ability : {},
            list_document : [] , documentDialog : false, index_document : '', data_document : [],
            list_test_equipment : [], list_material : [], fixedRatingForChange :  [], data_personel : [] , index_personel : '',
            getdatapersonel : [], loading : 'false', errorMessage : null
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
            if(this.idRequest != 0 ){
                axios.get(this.url+'/'+this.idRequest).then((res) => {
                    this.input = res.data.special_request
                    if(res.data.special_request.aircraft_type != null){
                        this.input.aircraft_type = res.data.special_request.aircraft_type.split('|')
                    }else{
                        this.input.aircraft_type = []
                    }
                    this.input.status = res.data.status
                    this.input.part_number = res.data.special_request.part_number
                    this.input.request_id = this.idRequest
                    this.input.request_type = res.data.request_type
                    this.input.request_number = res.data.request_number
                    this.input.shop_maintenance = this.input.workshop
                    this.input.shop_ability_number = res.data.special_shop_ability.shop_ability_number
                    this.input.ndt_method = res.data.special_shop_ability.ndt_method
                    this.input.reference = res.data.special_shop_ability.reference
                    if(res.data.special_shop_ability.ability !=  null){
                      this.ability = JSON.parse(res.data.special_shop_ability.ability)
                    }
                    if(res.data.special_shop_ability.special_facility != null){
                      this.special_facility = JSON.parse(res.data.special_shop_ability.special_facility)
                    }

                    if(res.data.special_request.aproval_request_carry_out !=  null){
                        this.aproval_request_carry_out = JSON.parse(res.data.special_request.aproval_request_carry_out)
                    }


                    this.list_note = res.data.attachment_resubmit
                    this.input.status = res.data.status
                    if(res.data.special_request.for_rating != null){
                      this.rating = JSON.parse(res.data.special_request.for_rating)
                      this.fixedRatingForChange = JSON.parse(res.data.special_request.for_rating)
                    }
                    this.manual_revision = JSON.parse(res.data.special_request.manual_revision)

                    if(res.data.special_request.attachment != null){
                        this.list_attachment = res.data.special_request.attachment.split('|')
                    }

                    this.list_document_ability = JSON.parse(res.data.special_shop_ability.equipment_tools)
                    this.list_qualified_personel = JSON.parse(res.data.special_shop_ability.qualified_personel)
                    this.list_consumable_material = JSON.parse(res.data.special_shop_ability.consumable_material)

                    this.list_personel = res.data.special_personel
                    this.list_sheetlist = res.data.special_sheet_list
                    this.list_tools = res.data.special_tools
                    this.list_partlist = res.data.special_part_list
                    this.list_document = res.data.special_document
                    this.list_test_equipment = res.data.special_test_equipment
                    this.list_material = res.data.special_material

                    this.list_attachment = res.data[0].engine_request.attachment.split('|')
                })
                .catch((err) => {

                })
            }else{
                this.input.request_type = 'Add'
            }
        },
        formImport(type){
            this.imports.type = type
            this.importFileDialog = true
        },
        succesAttach(response, file, fileList){
            this.list_attachment.push(response.file)
        },
        delattachment(d){
            this.list_attachment.splice(d, 1)
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
                    if(res.data.type == 'personel'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    name:res.data.data[i].name,
                                    id_number: res.data.data[i].id_number,
                                    job_title: res.data.data[i].job_title,
                                    auth_no_stamp_holder: res.data.data[i].auth_no_stamp_holder,
                                    unit: res.data.data[i].unit,
                                    scope_competency: res.data.data[i].scope_competency,
                                }
                                this.list_personel.push(obj);
                        }
                    }
                    if(res.data.type == 'sheetlist'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    category:res.data.data[i].category,
                                    pd_sheet_number: res.data.data[i].pd_sheet_number,
                                    desciption: res.data.data[i].desciption,
                                }
                                this.list_sheetlist.push(obj);
                        }
                    }
                    if(res.data.type == 'tools'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    part_name:res.data.data[i].part_name,
                                    tool_name: res.data.data[i].tool_name,
                                    qty: res.data.data[i].qty,
                                    availability: res.data.data[i].availability,
                                }
                                this.list_tools.push(obj);
                        }
                    }
                    if(res.data.type == 'partlist'){
                        for (var i = 0; i < res.data.data.length; i++) {
                                var obj = {
                                    part_name:res.data.data[i].part_name,
                                    example_part_number: res.data.data[i].example_part_number,
                                    vendor_name: res.data.data[i].vendor_name,
                                }
                                this.list_partlist.push(obj);
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
                console.log(err);
                loading.close()
                this.$alert("Import Failed, Format Excel not Match", 'Warning', { confirmButtonText: 'OK', });
            })
        },
        save(preview){
            this.input.master_request_id = this.requestType.id
            this.input.equipment_tools =  JSON.stringify(this.list_document_ability)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            // this.input.qualified_personel = JSON.stringify(this.list_qualified_personel)
            this.input.personel = this.list_personel
            this.input.sheetlist = this.list_sheetlist
            this.input.tools = this.list_tools
            this.input.partlist = this.list_partlist
            this.input.list_document = this.list_document
            this.input.list_material = this.list_material
            this.input.list_test_equipment = this.list_test_equipment
            this.input.attachment = this.list_attachment
            // this.input.for_rating = JSON.stringify(this.rating)
            // this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
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
            if(this.input.facilities == undefined &&  this.input.certifying_staff  == undefined &&  this.input.approved_data  == undefined &&  this.input.qualified_personel  == undefined &&  this.input.special_tools  == undefined &&  this.input.consumable == undefined ){
                this.input.manager_statement = null
            }else{
                this.input.manager_statement = 'OK'
            }

            this.input.manual_revision = JSON.stringify(this.manual_revision)
            this.input.ability = JSON.stringify(this.ability)
            this.input.special_facility = JSON.stringify(this.special_facility)
            if(preview == 'preview'){
              var text = '& Preview '
            }else{
              var text = ''
            }
            const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            this.$confirm('Do You Want Save to Draft '+text+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
              axios.post(this.url, this.input).then((res) => {
                if(preview == 'preview'){
                  if(this.type == 0){
                    this.$router.push({ name: 'form_special', params: { type: res.data.id } })
                    this.input.request_id = res.data.id
                    this.getData(res.data.id)
                  }
                  this.getData(res.data.id)
                  window.open(this.url+"/detail/"+res.data.id, '_blank')
                }else{
                  if(this.type == 0){
                    this.$router.push({ name: 'form_special', params: { type: res.data.id } })
                    this.input.request_id = res.data.id
                    this.idRequest = res.data.id
                    this.getData(res.data.id)
                  }else{
                    this.$router.push('/special_request');
                  }
                  this.scrollToTop()
                  this.input = {}
                  this.err = []
                }
                loading.close();
              })
              .catch((error) => {
                this.err = error.response.data.errors; loading.close()
                loading.close();
              })
            }).catch(() => {
                this.$message({ type: 'info', message: 'Delete canceled' });
                loading.close();
            });
        },
        submit(type){
            this.input.master_request_id = this.requestType.id
            this.input.equipment_tools =  JSON.stringify(this.list_document_ability)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            // this.input.qualified_personel = JSON.stringify(this.list_qualified_personel)

            this.input.personel = this.list_personel
            this.input.sheetlist = this.list_sheetlist
            this.input.tools = this.list_tools
            this.input.partlist = this.list_partlist
            this.input.list_document = this.list_document
            this.input.list_test_equipment = this.list_test_equipment
            this.input.list_material = this.list_material
            this.input.for_rating = JSON.stringify(this.rating)
            this.input.manual_revision = JSON.stringify(this.manual_revision)
            this.input.aproval_request_carry_out = JSON.stringify(this.aproval_request_carry_out)
            if(this.ability.length > 0 ){
              this.input.ability = JSON.stringify(this.ability)
            }
            if(this.special_facility.length > 0){
              this.input.special_facility = JSON.stringify(this.special_facility)
            }

            if(this.list_personel.length == 0){
              this.$alert("Personel Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.personelForm()
              return
            }
            if(this.list_tools.length == 0){
              this.$alert("Special Tools Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.toolsForm()
              return
            }
            if(this.list_test_equipment.length == 0){
              this.$alert("Test Equipment Can't be null", 'Warning', { confirmButtonText: 'OK', }); this.testEquipmentForm()
              return
            }


            if(this.list_personel.length != 0 && this.list_tools.length != 0 && this.list_test_equipment.length != 0){
               if(this.input.status == 6 && type != 'resubmit' ){
                   var request = 'without Upload Document'
               }else{
                   var request = ''
               }

                this.$confirm('Do You Want to Submit this Request '+request+' ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                    const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                    axios.post(this.url+'/submit', this.input).then((res) => {
                      this.$alert("Submit With Request Number "+this.input.request_number+" Success", 'Success', { confirmButtonText: 'OK', });
                      this.input = {}
                      this.$router.push('/special_request');
                      this.scrollToTop()
                      loading.close();
                    })
                    .catch((error) => {
                      this.err = error.response.data.errors; loading.close()
                      loading.close();
                    })
                }).catch(() => {
                    this.$message({ type: 'info', message: 'Submit Canceled' });
                });
            }
        },
        document_ability(p){
            this.list_document_ability.push({
                document_required :"",
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
        addPersonel(d){
          if(d.index == null ){
              this.list_personel.push({
                  nominate: d.nominate,
                  name: d.name,
                  id_number : d.id_number,
                  level : d.level,
                  training_certificate: d.training_certificate,
                  personal_ability: d.personal_ability,
                  certificate_competence: d.certificate_competence,
                  staff_authorization: d.staff_authorization,
              });
          }else{
              this.list_personel[d.index].nominate = d.nominate
              this.list_personel[d.index].name = d.name
              this.list_personel[d.index].id_number = d.id_number
              this.list_personel[d.index].level = d.level
              this.list_personel[d.index].training_certificate = d.training_certificate
              this.list_personel[d.index].personal_ability = d.personal_ability
              this.list_personel[d.index].certificate_competence = d.certificate_competence
              this.list_personel[d.index].staff_authorization = d.staff_authorization
          }
          this.personelDialog = false

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

        addQualifiedPersonel(p){
            if (!!this.list_qualified_personel.find(lp => lp.id_number == p.personel_number)) {
                return
            }
            this.$message({  type: 'success', message: 'Qualified Personel Added' });
            this.list_qualified_personel.push({
                name: p.full_name,
                id_number: p.personel_number,
                level : p.position_name
            });
        },

        delQualifiedPersonel(d, i){
            this.list_qualified_personel.splice(i, 1)
        },
        // add Sheetlist
        addSheetlist(p){
            this.list_sheetlist.push({
                category: "",
                pd_sheet_number: "",
                description : "",
            });
        },

        delSheetlist(d, i){
            if(d.id == undefined ){
                this.list_sheetlist.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=sheetlist').then((res) => {
                          this.list_sheetlist.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {  console.log(err); })
                }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
            }
        },

        // add Tools
        addTools(d){
            this.list_tools.push({
                part_name: "",
                // tool_name: d.DESCRIPTION,
                tool_name: '',
                qty : "",
                availability : "",
            });
        },

        delTools(d, i){
            if(d.id == undefined ){
                this.list_tools.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=tools').then((res) => {
                          this.list_tools.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {  console.log(err); })
                }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
            }
        },

        //test Equipment
        addTestEquipment(){
            this.list_test_equipment.push({
              part_number : '',
              part_name : '',
              remark : ''
            })
        },
        delTestEquipment(d,i){
            if(d.id == undefined ){
                this.list_test_equipment.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=test_equipment').then((res) => {
                          this.list_test_equipment.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {  console.log(err); })
                }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
            }
        },

        //Material
        addMaterial(){
            this.list_material.push({
              part_number : '',
              part_name : '',
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


        // add partlist
        addPartlist(p){
            this.list_partlist.push({
                part_name: "",
                example_part_number : "",
                vendor_name : "",
            });
        },

        delPartlist(d, i){
            if(d.id == undefined ){
                this.list_partlist.splice(i, 1)
            }else{
                this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                      axios.delete(this.url+'/'+ d.id+'?type=tools').then((res) => {
                          this.list_partlist.splice(i, 1)
                          this.$message({ type: 'success', message: 'Delete completed' });
                      })
                      .catch((err) => {  console.log(err); })
                }).catch(() => { this.$message({ type: 'info', message: 'Delete canceled' }); });
            }
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
        mainForm(){
          this.mainform = true
          this.shopability = false
          this.personel = false
          this.documents = false
          this.tools = false
          this.test_equipment = false
          this.material = false
        },
        documentForm(){
          this.mainform = false
          this.shopability = false
          this.personel = false
          this.documents = true
          this.tools = false
          this.test_equipment = false
          this.material = false
        },
        abilityForm(){
          this.mainform = false
          this.shopability = true
          this.personel = false
          this.documents = false
          this.tools = false
          this.test_equipment = false
          this.material = false
        },
        personelForm(){
          this.mainform = false
          this.shopability = false
          this.personel = true
          this.documents = false
          this.tools = false
          this.test_equipment = false
          this.material = false
        },
        toolsForm(){
          this.mainform = false
          this.shopability = false
          this.personel = false
          this.documents = false
          this.tools = true
          this.test_equipment = false
          this.material = false
        },
        testEquipmentForm(){
          this.mainform = false
          this.shopability = false
          this.personel = false
          this.documents = false
          this.tools = false
          this.test_equipment = true
          this.material = false
        },
        materialForm(){
          this.mainform = false
          this.shopability = false
          this.personel = false
          this.documents = false
          this.tools = false
          this.test_equipment = false
          this.material = true
        },




        sheetlistForm(){
          this.mainform = false
          this.shopability = false
          this.personel = false
          this.sheetlist = true
          this.tools = false
          this.partlist = false
          this.note = false
        },
        partlistForm(){
            this.mainform = false
            this.shopability = false
            this.personel = false
            this.sheetlist = false
            this.tools = false
            this.partlist = true
            this.note = false
        },
        Note(){
            this.mainform = false
            this.shopability = false
            this.personel = false
            this.sheetlist = false
            this.tools = false
            this.partlist = false
            this.note = true
        },
        scrollToTop() {
          window.scrollTo(0,0);
        },
        cancel(){
          this.$confirm('Do You Want Close this Request Without Save ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              this.$router.push('/special_request');
              this.scrollToTop()
          }).catch(() => {
              this.$message({ type: 'info', message: 'Close canceled' });
          });

        },

    }
}
</script>

<style lang="css" scoped>
.el-select {
    width: 100%;
}
</style>
