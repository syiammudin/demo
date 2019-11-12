<template >
<div v-if="role_request == 5">
    <div class="col-lg-12  z-index-41" >
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Vendor Management</h1>
            </div>
            <div class="panel-body">
                <!-- <br> -->
                <div class="form-horizontal">
                    <div v-show='firstForm' class="form-group">
                        <div class="form-group">
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">To </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="QUALITY SYSTEM & AUDITING">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">From </label>
                                        <div class="col-md-8">
                                          <input type="text" class="form-control" v-model="input.from" @click="addUnit(input.from)" readonly placeholder="Form">
                                            <!-- <el-input placeholder="Form" readonly v-model="input.from" @click="addUnit(input.from)"> </el-input> -->
                                            <span v-if="err.from" class="text-danger"> {{ err.from[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Dept. </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Dept"  v-model="input.dept"> </el-input>
                                            <span v-if="err.dept" class="text-danger"> {{ err.dept[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Phone </label>
                                        <div class="col-md-8">
                                            <el-input type='number' placeholder="Phone" prefix-icon="fa fa-plus"  v-model="input.phone"> </el-input>
                                            <span v-if="err.phone" class="text-danger"> {{ err.phone[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="title-sub">
                                <strong>VENDOR</strong>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Vendor Name </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor Name"  v-model="input.vendor_name"> </el-input>
                                            <span v-if="err.vendor_name" class="text-danger"> {{ err.vendor_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Address (Street)</label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor Address"  v-model="input.vendor_address"> </el-input>
                                            <span v-if="err.vendor_address" class="text-danger"> {{ err.vendor_address[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">City </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor City"  v-model="input.vendor_city"> </el-input>
                                            <span v-if="err.vendor_city" class="text-danger"> {{ err.vendor_city[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">State </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor State"  v-model="input.vendor_state"> </el-input>
                                            <span v-if="err.vendor_state" class="text-danger"> {{ err.vendor_state[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Zip Code </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor Zip Code" type='number'  v-model="input.vendor_zip_code"> </el-input>
                                            <span v-if="err.vendor_zip_code" class="text-danger"> {{ err.vendor_zip_code[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Vendor Phone </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor Phone" type="number" prefix-icon="fa fa-plus"  v-model="input.vendor_phone"> </el-input>
                                            <span v-if="err.vendor_phone" class="text-danger"> {{ err.vendor_phone[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Vendor Fax </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Vendor Fax" type="number" prefix-icon="fa fa-plus" v-model="input.vendor_fax"> </el-input>
                                            <span v-if="err.vendor_fax" class="text-danger"> {{ err.vendor_fax[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Parent Company </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Parent Company"  v-model="input.parent_company"> </el-input>
                                            <span v-if="err.parent_company" class="text-danger"> {{ err.parent_company[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="title-sub">
                                <strong>CONTACT</strong>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Contact Name </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Contact Name"  v-model="input.contact_name"> </el-input>
                                            <span v-if="err.contact_name" class="text-danger"> {{ err.contact_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Contact Email </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Contacts email"  v-model="input.contact_email"> <template slot="prepend">@</template> </el-input>
                                            <span v-if="err.contact_email" class="text-danger"> {{ err.contact_email[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Contact Title </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Contact Title"  v-model="input.contact_title"> </el-input>
                                            <span v-if="err.contact_title" class="text-danger"> {{ err.contact_title[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Supplier Code </label>
                                        <div class="col-md-8">
                                            <el-input placeholder="Supplier Code"  v-model="input.supplier_code"> </el-input>
                                            <span v-if="err.supplier_code" class="text-danger"> {{ err.supplier_code[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line-dashed"></div>
                        <div class="col-md-12 form-group form-group">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Item Proposed From Procurement From the Source </label>
                                <div class="col-md-9">
                                    <el-input placeholder="Item Proposed From Procurement From the Source "  v-model="input.item_proposed"> </el-input>
                                    <span v-if="err.item_proposed" class="text-danger"> {{ err.item_proposed[0] }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Applicable Drawing And/Or Specifications </label>
                                <div class="col-md-9">
                                    <el-input placeholder="Applicable Drawing And/Or Specifications "  v-model="input.aplication_drawing"> </el-input>
                                    <span v-if="err.aplication_drawing" class="text-danger"> {{ err.aplication_drawing[0] }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type Of Supplier & Comment </label>
                                <div class="col-md-9">
                                    <el-select v-model="input.type_supplier" filterable clearable placeholder="Select Type Of Supplier" >
                                        <el-option v-for="item in TypeSupplier" :key="item.type_supplier"
                                            :label="item.type_supplier"
                                            :value="item.type_supplier">
                                        </el-option>
                                    </el-select>
                                    {{ input.attachment_lenght }}
                                    <!-- <input type="text" v-model="input.attachment_lenght == $store.state.TypeSupplier.find(t => t.type_supplier == input.type_supplier).attachment_lenght"> -->
                                    <!-- <el-input placeholder="Type Of Supplier & Comment "  v-model="input.type_supplier"> </el-input> -->
                                    <span v-if="err.type_supplier" class="text-danger"> {{ err.type_supplier[0] }}</span>
                                </div>
                            </div>
                            <div class="form-group" v-if="input.attachment != null">
                                <label class="col-md-3 control-label">Attachment </label>
                                <div class="col-md-9">
                                    <div class="">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/vendor_management/'+input.attachment ">{{ input.attachment }}</a> <br>
                                    </div>
                                    <div v-for="(la, i) in list_attachment" :key="i">
                                        <a @click="popupAttachmentDialog = true, link = 'uploads/vendor_management/'+la.attachment ">{{ la.attachment }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary" @click="save()" >Save to Draft</button>
                            <button v-if="type != 0" class="btn btn-warning" @click="sendlink(type)" >Send link to Vendor</button>
                            <button v-if="type != 0" class="btn btn-default" @click="message()" >Send Message to Vendor</button>
                            <button class="btn btn-danger" @click="cancel()">Cancel </button>
                            <button class="btn btn-success" @click="input.status == 6 ? note = true : submit()" v-if="input.status > 0 || input.status != undefined">
                                {{ input.status == 6 ? 'Save And re-Submit' : 'Save And Submit'}}
                            </button>
                            <!-- <button v-if="input.attachment != null" class="btn btn-success" @click="submit()" >Save And Submit</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <el-dialog title="Send Message To Vendor" :visible.sync="MessageDialog" >
        <message v-if="MessageDialog == true" :data='id_message'  @endMessage="endMessage" />
    </el-dialog>

    <el-dialog title="Popup Attachment"  width="70%" :visible.sync="popupAttachmentDialog" >
        <popupAttachment v-if="popupAttachmentDialog == true"  :link="link" />
    </el-dialog>

    <el-dialog title="Unit" width="300"  :visible.sync="unitDialog" >
        <unit @unit="unit" :unit_selected="unit_selected" />
    </el-dialog>

    <el-dialog title="Note and attachment " :visible.sync="note" >
      <div class="form-horizontal">
        <div class="form-group" v-if="input.status == 6">
          <label class="col-md-3 label-control">Note Resubmit</label>
          <div class="col-md-9">
            <input type="text" v-if="input.status == 6" class="form-control" v-model="input.note" name="" value="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-10">
            <button class="btn btn-success" @click="submit()" >re-SUbmit</button>
            <button class="btn btn-danger" @click="note = false" >Cancel</button>
          </div>
        </div>
      </div>
    </el-dialog>
</div>
</template>

<script>
import popupAttachment from '../popupAttachment'
import message from './message'
import unit from './unit'
export default {
    components : { popupAttachment,  message, unit },
    created(){
        this.$store.commit('getTypeSupplier');
        this.getData()
    },
    props : ['type'] ,
    watch: {
        // untuk mendapatkan data pasien onchange
        'input.type_supplier': function(v, o) {
            if(!v){
                return
            }else{
                this.input.attachment_lenght = this.$store.state.TypeSupplier.find(t => t.type_supplier == v).attachment_lenght
            }
        },
    },
    computed : {
        TypeSupplier() { return this.$store.state.TypeSupplier } ,
    },
    data() {
        return {
            url : BASE_URL + 'submit_vendor', base_url : BASE_URL, data : [], link : '', popupAttachmentDialog : false,
            input : {} , firstForm : true, list_name_aproval : [] , list_customers : [], list_curent_capability : [],
            qa : [{ 'id' : 0 , 'name' : 'N/A' }, { 'id' : 1 , 'name' : 'Yes' },{ 'id' : 2 , 'name' : 'No' }] ,
            type_bussines : {}, err : [], document_evidence : {} , role_request : ROLE_REQUEST, MessageDialog : false , id_message : '',
            note: false ,
            list_attachment : [], Soe : [], unitDialog : false, unit_selected : ''
        }
    },

    methods : {
        addUnit(d){
            this.unit_selected = d
            this.unitDialog = true
        },
        unit(data){
              this.input.from  = data
              this.unitDialog = false
        },
        message(id){
            this.id_message = this.input
            this.MessageDialog = true
        },
        endMessage(){
            this.MessageDialog = false
        },
        getData(){
            if (this.type != 0) {
                axios.get(this.url+'/'+this.type).then((res) => {
                    console.log(res.data);
                    this.input = res.data
                    this.list_attachment = res.data.vendor_attachment
                    this.input.attachment_lenght = this.$store.state.TypeSupplier.find(t => t.type_supplier == res.data.type_supplier).length
                })
                .catch((err) => {

                })
            }
        },
        cancel(){
            this.input = {}
            this.scrollToTop()
            this.$router.push('/vendor_management');
        },
        save(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            this.input.to = 'QUALITY SYSTEM & AUDITING'
            axios.post(this.url, this.input).then((res) => {
                console.log(res.data);
                this.scrollToTop()
                if(res.data.status == 1 ){
                    this.input.id = res.data.id
                    this.$message({  type: 'success', message: 'Save to Draft Success, You Can send Link to Vendor Contact'  });
                    this.$router.push({ name: 'form_vendor_management', params: { type: res.data.id } })
                    loading.close()
                }else{
                    loading.close()
                    this.$alert('Failed to Save', 'Warning', {
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch((error) => {
                loading.close()
                this.err = error.response.data.errors; loading.close()
            })
        },
        sendlink(id){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+id).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Send To Vendor Success'  });
                    loading.close()
                    this.$router.push('/vendor_management');
                    this.scrollToTop()
                }else{
                    this.$message({  type: 'warning', message: 'Send To Vendor Failed'  });
                    loading.close()
                }
            })
            .catch((err) => {
                loading.close()

            })
        },
        submit(){
          // console.log(this.input);
          // return this.input ;
            this.input.list_name_aproval = JSON.stringify(this.list_name_aproval)
            this.input.list_customers = JSON.stringify(this.list_customers)
            this.input.list_curent_capability = JSON.stringify(this.list_curent_capability)
            this.input.type_bussines = JSON.stringify(this.type_bussines)
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/submit', this.input).then((res) => {
                console.log(res.data)
                if(res.data.status == 1 ){
                    this.scrollToTop()
                    this.$router.push('/vendor_management');
                    loading.close()
                }else{
                    loading.close()
                    this.$alert('Failed to Save', 'Warning', {
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch((err) => {
                loading.close()

            })
        },
        uploadSuccess(response, file, fileList) {
            if(response.success == true){
                this.list_curent_capability.push({
                    name_document : response.file
                })
            }else{
                this.$message.error(response.message);
            }
        },
        delCurrentCapability(i)
        {
            this.list_curent_capability.splice(i, 1)
        },
        addNameApproval(){
            this.list_name_aproval.push ({
                name : '',
                designation : '',
                stamp : '',
            })
        },
        delNameApproval(d, i){
            this.list_name_aproval.splice(i, 1)
        },
        addCustomer(){
            this.list_customers.push ({
                name_customer : '',
            })
        },
        delCustomer(d, i){
            this.list_customers.splice(i, 1)
        },
        scrollToTop() {
          window.scrollTo(0,0);
        }

    }
}
</script>

<style lang="css">
.title-sub{
    text-align:center; border-bottom : 1px dashed #DDD; margin-left: 100px; margin-right: 100px; margin-bottom: 20px;
}
</style>
