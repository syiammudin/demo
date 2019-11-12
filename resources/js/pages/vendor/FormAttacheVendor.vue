<template >
    <div class="page-container">
        <div class="main-container gray-bg">
            <div class="main-content" >
                <div v-if='input.status_vendor == 0 '>
                    <div class="col-lg-6  z-index-41" >
                        <div class="panel panel-default  ">
                            <div class="panel-heading no-border clearfix">
                                <h1 class="page-title">Vendor Form Data</h1>
                            </div>
                            <div class="panel-body">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> <strong>Name of Vendor</strong> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_name">
                                            <span v-if="err.vendor_name" class="text-danger"> {{ err.vendor_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 ">Street</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_address">
                                            <span v-if="err.vendor_address" class="text-danger"> {{ err.vendor_address[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">City</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_city">
                                            <span v-if="err.vendor_city" class="text-danger"> {{ err.vendor_city[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 ">State</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_state">
                                            <span v-if="err.vendor_state" class="text-danger"> {{ err.vendor_state[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 ">Zip Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_zip_code">
                                            <span v-if="err.vendor_zip_code" class="text-danger"> {{ err.vendor_zip_code[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Telephone</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_phone">
                                            <span v-if="err.vendor_phone" class="text-danger"> {{ err.vendor_phone[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 ">Fax</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.vendor_fax">
                                            <span v-if="err.vendor_fax" class="text-danger"> {{ err.vendor_fax[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Primary Contact</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.contact_name">
                                            <span v-if="err.contact_name" class="text-danger"> {{ err.contact_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 ">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.contact_title">
                                            <span v-if="err.contact_title" class="text-danger"> {{ err.contact_title[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="input.contact_email">
                                            <span v-if="err.contact_email" class="text-danger"> {{ err.contact_email[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="line-dashed"></div>


                                    <div class="form-group">
                                        <div class="col-md-12 form-group">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Type Bussines </label>
                                                <div class="col-sm-9 checkbox checkbox-replace checkbox-success">
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Airline']">
                                                        <label for="checkbox6">Airline </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['Supplier']">
                                                        <label for="checkbox6">Supplier </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Certificate Repair Station']">
                                                        <label for="checkbox6">Certified Repair Station </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['Machine Welding']">
                                                        <label for="checkbox6">Machine / Welding </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Original Equipment Manufacturer']">
                                                        <label for="checkbox6">Original Equipment Manufacturer </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['Fabricator']">
                                                        <label for="checkbox6">Fabricator </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Plating / Special Process']">
                                                        <label for="checkbox6">Plating / Special Process </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['Calibration Lab']">
                                                        <label for="checkbox6">Calibration Lab </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Accessory / Repair']">
                                                        <label for="checkbox6">Accessory / Repair </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['GSE']">
                                                        <label for="checkbox6">CGSE </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['NDI / NDT']">
                                                        <label for="checkbox6">NDI / NDT </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" v-model="type_bussines['Distibutor']">
                                                        <label for="checkbox6">Distibutor </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  class="form-control"  v-model="type_bussines['Others']">
                                                        <label for="checkbox6">Others </label>
                                                    </div>
                                                    <div class="col-md-12" v-if="type_bussines['Others']">
                                                        <input v-if="type_bussines['Others']" type="text" class="form-control" v-model="type_bussines['Other Value']">
                                                    </div>
                                                    <span v-if="err.type_bussines" class="text-danger"> {{ err.type_bussines[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Age Organization </label>
                                                <div class="col-md-9">
                                                    <input class='form-control' placeholder="Age Organization  "  v-model="input.age_organization">
                                                    <span v-if="err.age_organization" class="text-danger"> {{ err.age_organization[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Employee </label>
                                                <div class="col-md-9">
                                                    <input class='form-control' placeholder="Total Employee " type='number' v-model="input.total_employee">
                                                    <span v-if="err.total_employee" class="text-danger"> {{ err.total_employee[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Supervisors </label>
                                                <div class="col-md-9">
                                                    <input class='form-control' placeholder="Total Supervisors " type='number' v-model="input.total_supervisors">
                                                    <span v-if="err.total_supervisors" class="text-danger"> {{ err.total_supervisors[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Inspectors </label>
                                                <div class="col-md-9">
                                                    <input class='form-control' placeholder="Total Inspecors " type='number' v-model="input.total_inspectors">
                                                    <span v-if="err.total_inspectors" class="text-danger"> {{ err.total_inspectors[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Personnel </label>
                                                <div class="col-md-9">
                                                    <input class='form-control' placeholder="Total Personel " type='number' v-model="input.total_personel">
                                                    <span v-if="err.total_personel" class="text-danger"> {{ err.total_personel[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 " style="margin-left:10px; font-style: justify;">Name, Designation and stamp of approval signatories on approved cerficate or certificate of comfomance </label>
                                                <div class="col-md-12">
                                                    <table class="table table-striped"  style="margin-left:10px; font-style: justify;" >
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Designation</th>
                                                                <th><el-button @click="addNameApproval()"  size="mini" icon="fa fa-plus" round ></el-button></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(d, i) in list_name_aproval" :key="i">
                                                                <td> <input type="text" class="form-control" v-model='d.name'>  </td>
                                                                <td> <input type="text" class="form-control" v-model='d.designation'>  </td>
                                                                <td> <a @click="delNameApproval(d, i)"><i class="fa fa-trash"></i></a> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <span v-if="err.list_name_aproval" class="text-danger"> {{ err.list_name_aproval[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">List Customer</label>
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th><el-button @click="addCustomer()"  size="mini" icon="fa fa-plus" round ></el-button></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(d,i) in list_customers" :key="i">
                                                                <td> <input type="text" class="form-control" v-model='d.name_customer'>  </td>
                                                                <td> <a @click="delCustomer(d, i)"><i class="fa fa-trash"></i></a> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <span v-if="err.list_customers" class="text-danger"> {{ err.list_customers[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="col-md-3 control-label"><strong>List Current Capability</strong> </label>
                                                    <div class="col-md-9">
                                                    <input type="text" v-model="input.list_curent_capability" class="form-control" placeholder="list curent capability">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Representative in Indonesia</label>
                                                <div class="col-md-9">
                                                  <textarea name="name" class="form-control" v-model="input.representative_indonesia" cols="80"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Documentary Evidence</label>
                                                <div class="col-sm-9 checkbox checkbox-replace checkbox-success">

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['DGCA']">
                                                                <label for="checkbox6">Indonesia DGCA Certificate </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['dgca_no_certificate']" class="form-control" v-if="document_evidence['DGCA'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['DGCA'] == true"  v-model="document_evidence['dgca_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['DGCA'] == true"  v-model="document_evidence['dgca_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['FAA']">
                                                                <label for="checkbox6">FAA Certificate </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['faa_no_certificate']" class="form-control" v-if="document_evidence['FAA'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['FAA'] == true"  v-model="document_evidence['faa_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['FAA'] == true"  v-model="document_evidence['faa_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['EASA']">
                                                                <label for="checkbox6">EASA Certificate </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['easa_no_certificate']" class="form-control" v-if="document_evidence['EASA'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['EASA'] == true"  v-model="document_evidence['easa_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['EASA'] == true"  v-model="document_evidence['easa_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['EASO']">
                                                                <label for="checkbox6">EASO Certificate </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['easo_no_certificate']" class="form-control" v-if="document_evidence['EASO'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['EASO'] == true"  v-model="document_evidence['easo_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['EASO'] == true"  v-model="document_evidence['easo_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['ASA']">
                                                                <label for="checkbox6">ASA Certificate </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['asa_no_certificate']" class="form-control" v-if="document_evidence['ASA'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['ASA'] == true"  v-model="document_evidence['asa_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['ASA'] == true"  v-model="document_evidence['asa_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['ISO']">
                                                                <label for="checkbox6">ISO </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['iso_no_certificate']" class="form-control" v-if="document_evidence['ISO'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['ISO'] == true"  v-model="document_evidence['iso_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['ISO'] == true"  v-model="document_evidence['iso_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['Calibration Lab']">
                                                                <label for="checkbox6">Calibration Lab Certificate</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['cl_no_certificate']" class="form-control" v-if="document_evidence['Calibration Lab'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Calibration Lab'] == true"  v-model="document_evidence['cl_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Calibration Lab'] == true"  v-model="document_evidence['cl_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-12" v-if="document_evidence['Calibration Lab'] == true">
                                                                <div class="col-md-12">
                                                                  <input type="checkbox"  v-model="document_evidence['KAN']">
                                                                  <label for="checkbox6">KAN</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <input type="text" v-model="document_evidence['kan_no_certificate']" class="form-control" v-if="document_evidence['KAN'] == true" placeholder="No Certificate">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker v-if="document_evidence['KAN'] == true"  v-model="document_evidence['kan_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker v-if="document_evidence['KAN'] == true"  v-model="document_evidence['kan_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" v-if="document_evidence['Calibration Lab'] == true">
                                                                <div class="col-md-12">
                                                                  <input type="checkbox" v-model="document_evidence['OtherCalibration']">
                                                                  <label for="checkbox6">Other</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                  <input type="input" v-model="document_evidence['OtherCalibration_value']" class="form-control" v-if="document_evidence['OtherCalibration'] == true">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <input type="text" v-model="document_evidence['other_calibration_lab_no_certificate']" class="form-control" v-if="document_evidence['OtherCalibration'] == true" placeholder="No Certificate">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker v-if="document_evidence['OtherCalibration'] == true"  v-model="document_evidence['other_calibration_la_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker v-if="document_evidence['OtherCalibration'] == true"  v-model="document_evidence['other_calibration_la_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['OEM']">
                                                                <label for="checkbox6">OEM</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['oem_no_certificate']" class="form-control" v-if="document_evidence['OEM'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['OEM'] == true"  v-model="document_evidence['oem_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['OEM'] == true"  v-model="document_evidence['oem_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['STC / TSOA']">
                                                                <label for="checkbox6">STC / TSOA</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['stctsoa_no_certificate']" class="form-control" v-if="document_evidence['STC / TSOA'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['STC / TSOA'] == true"  v-model="document_evidence['stctsoa_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['STC / TSOA'] == true"  v-model="document_evidence['stctsoa_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['Current Capability List']">
                                                                <label for="checkbox6">Current Capability List</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['current_no_certificate']" class="form-control" v-if="document_evidence['Current Capability List'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Current Capability List'] == true"  v-model="document_evidence['current_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Current Capability List'] == true"  v-model="document_evidence['current_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['Inspection Procedural Manual']">
                                                                <label for="checkbox6">Inspection Procedural Manual/ Exposition Manual /Quality Procedure manual/Quality Manual </label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" v-model="document_evidence['inspection_no_certificate']" class="form-control" v-if="document_evidence['Inspection Procedural Manual'] == true" placeholder="No Certificate">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Inspection Procedural Manual'] == true"  v-model="document_evidence['inspection_issue_date']" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-date-picker v-if="document_evidence['Inspection Procedural Manual'] == true"  v-model="document_evidence['inspection_exp_date']" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="checkbox"  v-model="document_evidence['Other']">
                                                                <label for="checkbox6">Other</label>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                              <button v-if="document_evidence['Other'] == true" class="btn btn-primary" type="button" name="button" @click="addOtherEvidence()"> <i class="fa fa-plus"></i> </button>
                                                            </div>
                                                            <div v-for="(d, i) in otherDoc_evidence" :key="i"  class="form-horizontal row">
                                                              <div class="form-group">
                                                                <div class="col-md-8">
                                                                  <input type="text" class="form-control" v-model="d.other_value">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <button type="button" class="btn btn-danger" name="button" @click="otherDoc_evidence.splice(i, 1)"><i class="fa fa-trash"></i> </button>
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <div class="col-md-4">
                                                                  <input type="text" v-model="d.other_no_certificate" class="form-control" placeholder="No Certificate">
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker  v-model="d.other_issue_date" type="date" placeholder="Issue Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <el-date-picker  v-model="d.other_exp_date" type="date" placeholder="Exp. Date" value-format="yyyy-MM-dd"></el-date-picker>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span v-if="err.document_evidence" class="text-danger"> {{ err.document_evidence[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Date Last Eksternal Audit</label>
                                                <div class="col-md-9">
                                                    <el-date-picker v-model="input.date_audit" type="date" placeholder="Last Audit" value-format="yyyy-MM-dd">
                                                    </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6  z-index-41">
                        <div class="panel panel-default  ">
                            <div class="panel-heading no-border clearfix">
                                <h1 class="page-title">Vendor Form Qualification</h1>
                            </div>
                            <div class="panel-body form-horizontal ">
                                <div class="form-group">
                                    <div class="col-md-12 form-group" style="padding-left:30px;">
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Is your organization in any way approved by Indonesian DGCA, FAA, EASA, any others
                                                National Civil Aviation Authority or International/National Accreditation Body e.g.:
                                                LBA, Bureau Verieties, etc. <br>
                                                If Yes, Specify
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_organization'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Do you have a Quality Assurance Program. If yes, is it the form of written Procedure ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_quality_assurance'>
                                                    <option v-for="(d, i) in qa" :key="i"  :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Is your QA system bases upon military, National, or International Quality system standards ? If applicable, indicate which of the following were in practice.
                                                <br>
                                                (MIL-STD-9858A,
                                                MIL-I-45206A,
                                                ASQC-C1 Series(American),
                                                Can 3-x 299, Cat. 1 through 4 (Canadian),
                                                BS5750, Parts 1 through 4 (British),
                                                AS1821, 1822, 1823 (Australian),
                                                ISO/DIS 9000 (All levels) (International Standards Organization),
                                                ISO/IEC 17025:2005,
                                                ANSI/NCSL Z540-1:1994,
                                                AQAP-1,-4,-9(NATO),
                                                Others:(specify))
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_qa_system'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Indicate your source/s of supply : <br>
                                                (Original Equipment Manufacturer's (OEM),
                                                OEM-Licensed sub-contractors,
                                                Alternate source vendors approved by OEM,
                                                PMA-Approved sources,
                                                Sources as defined in Military Qualified,
                                                Products List (for AN, MS, NAS standards),
                                                Surplus Airline Inventory,
                                                Other industry source )
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_indicate_supply'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Are all Part inspected upon receipt ? <br>
                                                An reinpected prior to shipment ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_part_inspection'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Do you maintened any quality records or rating on your suppliers ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_maintain_quality'>
                                                    <option v-for="(d,i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Do you have a program to re-certify your stock of routable and repairable periodically ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_program_recertify'>
                                                    <option v-for="(d,i ) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Do you have shelf life control policies and procedure ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_control_policies'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Do you maintain trace-ability of all parts ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_trace_ability'>
                                                    <option v-for="(d,i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                (for suppliers in the USA only) <br>
                                                Can you provide a material certification for new parts like the example below  <br>
                                                All part covered by this document were produced by a manufacturer holding a FAA approved production inspection system issued under FAR 21, sub-part F, or sub-part G <br>
                                                there parts were produced by the prima manufacturer. None of these parts have been subjected to reverse stress or heat and unless otherwise stated are new and unused. (or words to that effect)
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_for_usa_only'>
                                                    <option v-for="(d,i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                can you provide the folowing should need arise ? <br>
                                                your Purchase Order, use to acquire the part.
                                                Repair Order, if applicable.
                                                Part incoming certificate/serviceable tag, or invoice from tour supplier. Factory/Manufacturing Certificate (for fasteners).
                                                Any other documents tracing back the birth history of the part.
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_provide'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10 text-left">
                                                Does Your company implement Safety Management System (SMS) ?
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" v-model='input.evaluation_implement_sms'>
                                                    <option v-for="(d, i) in qa" :key="i" :value="d.id">{{ d.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12  z-index-41" >
                        <div class="panel panel-default form-horizontal ">
                            <div class="line-dashed"></div>
                            <div class="form-group">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary" @click="save()" >Save Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 z-index-41" v-show="buttonForm"  v-else >
                    <div class="panel panel-default form-horizontal ">
                        <div class="line-dashed"></div>
                        <div class="form-group" v-if="input.status == 0 || (input.status_vendor == 1 && input.status == 7 || input.status == 6)">
                            <div class="form-group col-lg-12 text-center">
                                <button class="btn btn-primary" @click="print()" >Print</button>
                                <button class="btn btn-warning" @click="input.status_vendor = 0" >Edit</button>
                            </div>
                            <!-- <div class="form-group col-lg-12 text-center">
                                <button v-for="v, i in attachment_lenght" @click="UpDoc(v, i)" style="margin-left:5px;margin-right:5px"  class="btn btn-danger" > {{ v.name_attachment }} </button>
                            </div> -->
                            <div class="col-lg-4"></div>
                            <div class="form-group col-lg-4" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Document Type</th>
                                            <th>File</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Attachment Document</td>
                                            <td>{{ input.attachment }}</td>
                                            <td> <button class="btn btn-success" @click="attachmentForm = true, buttonForm = false" >Upload Document Questionare</button></td>
                                        </tr>
                                        <tr v-for="(at, i) in attachment_lenght" :key="i">
                                            <td>{{ at.name_attachment }}</td>
                                            <td>{{ at.attachment }}</td>
                                            <td><button @click="UpDoc(at, i)" style="margin-left:5px;margin-right:5px"  class="btn btn-danger" > {{ at.name_attachment }} </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-12 text-center">
                                <button type="button" @click="send()" class="btn"><i class="fa fa-send-o"></i> Send Document </button>
                            </div>
                        </div>
                        <div class="form-group" v-else>
                            <div class="col-lg-12 text-center">
                                <h2> Your Document Already Submitted </h2>
                            </div>
                        </div>
                        <div class="line-dashed"></div>
                    </div>
                </div>

                <div v-show="attachmentForm">
                    <div>
                        <div class="panel panel-default form-horizontal ">
                            <div class="form-group">
                                <div class="login-container">
                                    <div class="login-content">
                                        <div class="form-group text-center" >
                                            <el-upload
                                                class="upload-demo"
                                                drag
                                                :action="url+'/attachment'"
                                                :on-success="onSuccess"
                                                :on-preview="handlePreview"
                                                :on-remove="handleRemove"
                                                :file-list="fileList"
                                                :on-change="handleChange"
                                                >
                                                <i class="el-icon-upload"></i>
                                                <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                                                <div class="el-upload__tip" slot="tip">(.PDF) The Document Should PDF</div>
                                            </el-upload>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 z-index-41">
                        <div class="panel panel-default form-horizontal ">
                            <div class="line-dashed"></div>
                            <div class="form-group">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary" @click="upload()" >Upload</button>
                                    <button class="btn btn-danger" @click="cancel()" >Cancel</button>
                                </div>
                            </div>
                            <div class="line-dashed"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <el-dialog :title="'Upload '+title_form " :visible.sync="VendorAttachmentDialog" >
            <vendorattachment v-if="VendorAttachmentDialog == true" :id='id_vendor_attachment' :index='index' @endAttach="endAttach" />
        </el-dialog>
    </div>
</template>

<script>
import vendorattachment from './vendorattachment'
export default {
    components: {  vendorattachment },
    props : ['vendor_id', 'token'],
    data() {
        return {
            base_url : BASE_URL , attach : {},
            data : [] , mainForm: true, attachmentForm : false, buttonForm : true,
            input : {}, url : BASE_URL + 'vendor_attach', search : '', page : 1 , type_bussines : {}, err : [], fileList: [],
            list_name_aproval : [],list_customers : [], list_curent_capability: [], document_evidence : {},
            type : '', dataHistory : [], formReject : false , qa : [{ 'id' : '1', 'name':'Yes' } ,{ 'id' : '2', 'name':'No' },{ 'id' : '0', 'name':'N/A' }]
            , attachment_lenght : [] , VendorAttachmentDialog : false, id_vendor_attachment : '', title_form : '',  index : '', otherDoc_evidence : []
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        addOtherEvidence(){
            this.otherDoc_evidence.push({
              other :"",
              other_no_certificate :"",
              other_issue_date :"",
              other_exp_date : "",
            })
        },
        send(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/send', { 'id' : this.input.id }).then((res) => {
                this.$message({  type: 'success', message: 'Send Attachment Success'  });
                loading.close()
                this.scrollToTop()
            })
            .catch((err) => {
                this.$message({  type: 'failed', message: 'Error Process, Please Reload and Send Again'  });
                loading.close()
            })
        },
        UpDoc(d, i){
            this.id_vendor_attachment = d.id
            this.title_form = d.name_attachment
            this.index = i
            this.VendorAttachmentDialog = true
        },
        endAttach(d){
            this.attachment_lenght[d.index].attachment = d.attachment
            this.VendorAttachmentDialog = false
        },
        onSuccess(){

        },
        upload(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+this.vendor_id, this.attach ).then((res) => {
                this.$message({  type: 'success', message: 'Upload Success'  });
                this.input.attachment = this.attach.attachment
                this.buttonForm = true
                this.attachmentForm = false
                loading.close()
                this.scrollToTop()
            })
            .catch((err) => {
                loading.close()

            })
        },
        handlePreview(file){
            console.log(file);
        },
        handleRemove(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                console.log(res.data);
            })
            .catch((err) => {

            })
        },
        handleChange(file, fileList){
            if(file.response != null){
                this.attach.attachment = file.response.file
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        save(){
            if(this.list_name_aproval.length == 0){
                this.input.list_name_aproval = ''
            }else{
                this.input.list_name_aproval = JSON.stringify(this.list_name_aproval)
            }
            if(this.list_customers.length == 0){
                this.input.list_customers = ''
            }else{
                this.input.list_customers = JSON.stringify(this.list_customers)
            }

            this.input.type_bussines = JSON.stringify(this.type_bussines)
            this.input.document_evidence = JSON.stringify(this.document_evidence)
            this.input.other_document_evidence_value = JSON.stringify(this.otherDoc_evidence)
            this.input.list_curent_capability = JSON.stringify(this.input.list_curent_capability)

            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url, this.input).then((res) => {
                console.log(res.data);
                this.$message({  type: 'success', message: 'Save Success'  });
                this.getData()
                this.scrollToTop()
                loading.close()
            })
            .catch((error) => {
                this.err = error.response.data.errors
                loading.close()
            })
        },
        getData(){
            axios.get(this.url+'/'+ this.vendor_id).then((res) => {
                this.input = res.data
                this.list_name_aproval = JSON.parse(res.data.list_name_aproval)
                this.list_customers = JSON.parse(res.data.list_customers)
                this.type_bussines = JSON.parse(res.data.type_bussines)
                this.document_evidence = JSON.parse(res.data.document_evidence)
                this.input.list_curent_capability = JSON.parse(res.data.list_curent_capability)
                this.attachment_lenght = res.data.vendor_attachment
                if(res.data.other_document_evidence_value != null){
                  this.otherDoc_evidence = JSON.parse(res.data.other_document_evidence_value)
                }else{
                    this.otherDoc_evidence = []
                }
            })
            .catch((err) => {

            })
        },
        print(){
            window.open(this.url+"/print/"+this.input.id+'?token='+this.input.token, '_blank')
        },
        addNameApproval(){
            this.list_name_aproval.push({
                name : '',
                designation : ''
            })
        },
        delNameApproval(d, i){
            this.list_name_aproval.splice(i, 1)
        },
        addCustomer(){
            this.list_customers.push({
                name_customer : ''
            })
        },
        delCustomer(d, i){
            this.list_customers.splice(i, 1)
        },
        cancel(){
            this.buttonForm = true
            this.attachmentForm = false
        },
        scrollToTop() {
          window.scrollTo(0,0);
        }
    }
}
</script>

<style lang="css">
</style>
