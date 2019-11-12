<template>
    <div class="page-container">
        <div class="main-container gray-bg">
            <div class="main-content" v-if="role != 5 && role != 6">
                <div class="col-lg-7 z-index-41 text-center" >
                    <h1>You Doesn't have permittion to access this Document</h1>
                </div>
            </div>
            <div class="main-content"  v-else>
                <div class="col-lg-7 z-index-41" >
                    <div class="panel panel-default  ">
                        <div class="panel-heading no-border clearfix">
                            <h1 class="page-title">Document</h1>
                        </div>
                        <div class="panel-body">
                            <iframe :src="url+documents" style="width:100%; height: calc(100vh - 150px);"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 z-index-41" >
                    <div class="panel panel-default  ">
                        <div class="panel-heading no-border clearfix">
                            <h1 class="page-title">Questionnaire</h1>
                        </div>
                        <div class="panel-body table-responsive" style="width:100%; height: calc(100vh - 115px);">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Question </th>
                                        <th>Max Score</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d,i) in list_decision" :key="i">
                                        <td>{{ d.question }} </td>
                                        <td>{{ d.max_score }} </td>
                                        <td>
                                            <el-select v-model="d.score" :disabled="role == 6" @change="testing(d.score)" filterable placeholder="Select" >
                                                <el-option v-for="n in parseInt(d.max_score) " :key="n" :label="n" :value="n" ></el-option>
                                            </el-select>
                                            <!-- <span v-else="input.status == 2">{{ d.answer }}</span> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 v-if="input.status == 8">
                              <!-- {{ input.VendorManagementHistory }} -->
                              Note from GM QSA : {{ input.vendor_management_history[input.vendor_management_history.length - 1].note }}
                            </h4>
                            <h4 v-if="input.vendor_management_history[input.vendor_management_history.length - 1].note !=  null && input.status != 8">
                              Note from QSA : {{ input.vendor_management_history[input.vendor_management_history.length - 1].note }}
                            </h4>
                            <h2> Score : {{ input.score }}</h2>
                            <div class="line-dashed"></div>
                            <div class="col-md-12 text-center" v-if="role == 5 || role == 6">
                              <a @click="role == 5 ? showDialog(input) : submit()" v-if="role == 5 && (input.status == 3 || input.status == 8) && input.qsa_part_approve == auth_id" class="btn btn-primary">Accepted</a>
                              <button type="button" name="button" @click="submit()" class="btn btn-primary" v-if="role == 6 && input.status == 4" >Approve</button>
                              <button type="button" class="btn btn-danger" @click="formReject = true">Reject</button>
                              <button type="button" class="btn btn-warning" @click="cancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <el-dialog title="Form Reject " :visible.sync="formReject" >
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3">Number Request</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" readonly v-model="input.request_number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Note Reject</label>
                    <div class="col-md-9">
                        <textarea  class="form-control" v-model="input.note"></textarea>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="formReject = false">Close</el-button>
                    <el-button @click="rejectProses(input)" type="danger">Reject</el-button>
                </span>
            </form>
        </el-dialog>

        <el-dialog title="Form re-Accept " :visible.sync="FormSubmit" >
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3">Number Request</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" readonly v-model="input.request_number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Note</label>
                    <div class="col-md-9">
                        <textarea  class="form-control" v-model="input.note"></textarea>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="formReject = false">Close</el-button>
                    <el-button @click="submit()" type="primary">Submit</el-button>
                </span>
            </form>
        </el-dialog>


        <el-dialog title="Decision Score " :visible.sync="dialogApprove" >
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="label-control col-md-3">Product Service</label>
                    <div class="col-md-9">
                        <textarea  class="form-control" v-model="input.product_service"></textarea>
                    </div>
                </div>
                <div class="form-group" v-if="input.type_supplier == 'Maintenance Function'">
                    <label class="label-control col-md-3">Main Fn</label>
                    <div class="col-md-9">
                        <el-select v-if="input.type_supplier == 'Maintenance Function'" onloadedmetadata="" v-model="input.main_fn" multiple  filterable clearable placeholder="Main Fn" >
                            <el-option v-for="(mf, i) in MainFn " :key="i" :label="mf.label" :value="mf.label"> </el-option>
                        </el-select>
                    </div>
                </div>

                <div class="form-group" v-if="input.status == 8">
                  <label class="label-control col-md-3">Reason to GM QSA</label>
                  <div class="col-md-9">
                    <textarea  class="form-control" v-model="input.note"></textarea>
                  </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" name="button" class="btn btn-primary btn-sm" @click="submit()">Approve</button>
                            <button type="button" name="button" class="btn btn-danger btn-sm" @click="dialogApprove = false">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
export default {
    props : ['id_request', 'documents'],

    computed: {
        Questionare() { return this.$store.state.Questionare } ,
        MainFn() { return this.$store.state.MainFn } ,
    },
    created() {
        this.$store.commit('getQuestionare');
        this.$store.commit('getMainFn');
    },
    data() {
        return{
            url : BASE_URL, list_decision : [], score : '', input : {}, role : ROLE,  auth_id : AUTH_LOGIN_ID, formReject : false, FormSubmit : false, data : [],
            dialogApprove : false
        }
    },
    mounted(){
      this.getData() ;
    },
    methods :{
        showDialog(data){
            this.dialogApprove = true
            this.input.main_fn = data.maint_fn.split(',')
        },
        testing(c){
          const total = this.list_decision.length
          const sum = this.list_decision.filter(scr => scr.score != null ).reduce((t, c) => { return t + parseInt(c.score)}, 0)
          this.input.score =  sum ;
        },
        addDecision(){
            this.list_decision.push({
                question : '',
                answer : '',
            })
        },
        delDecision(i){
            this.list_decision.splice(i, 1)
        },
        check(){
            const total = this.list_decision.length
            const sum = this.list_decision.reduce((t, c) => { return t + parseInt(c.score)}, 0)
            this.input.score =  sum ;
        },
        getData(){
            axios.get(this.url+'submit_decision/'+this.id_request+'?type=vendor').then((res) => {
                this.input = res.data
                this.master_request_id = res.data.master_request_id
                if(res.data.decision != null) {
                    this.list_decision = JSON.parse(res.data.decision)
                }else{
                    this.list_decision = JSON.parse(this.$store.state.Questionare.find(d => parseInt(d.master_request_id) == res.data.master_request_id).questionare )
                }
            })
            .catch((err) => {

            })
        },
        submit(){
            const total = this.list_decision.length
            const decision = this.list_decision.filter(d => d.score === undefined)
            const score = this.list_decision.reduce((t, c) => { return t + parseInt(c.score)}, 0)
            this.input.score =  parseFloat(score).toFixed(2) ;
            if(this.list_decision.length == 0){
              this.$alert("No List Question, Please Refresh this page or call Admin to Add New Question", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
              return
            }
            this.input.decision = JSON.stringify(this.list_decision)
            this.input.id = this.id_request

            if(total == 0){
                this.$alert("This Decision can't be null", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
            }
            if(decision.length >= 1){
                this.$alert("Question for decision can't be null", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
            }

            if(total > 0 && decision.length == 0){
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                axios.put(this.url+'submit_vendor/approve/'+this.id_request, this.input).then((res) => {
                    if(res.data.status == 1){
                        this.$message({  type: 'success', message: 'Decision Success Submitted' });
                        window.location.replace(this.url+'#/aproval_vendor')
                        loading.close()
                    }else{
                        this.$alert('This Decision Failed to Submitte. Please Reload and Re-Submit Decision', 'warning', {  type: 'danger', confirmButtonText: 'OK', });
                        loading.close()
                    }
                })
                .catch((err) => {
                    loading.close()
                })
            }
        },
        rejectProses(data){
            this.$confirm('Are you sure want to Reject this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
              axios.put(this.url+'submit_vendor/reject/'+data.id, data).then((res) => {
                this.getData();
                this.formReject = false
                this.$message({
                   type: 'success',
                   message: 'Request Rejected'
                 });
                 window.location.replace(this.url+'#/aproval_vendor')
              })
              .catch((err) => {
                  console.log(err);
              })
            }).catch(() => {
              this.$message({
                type: 'info',
                message: 'Approve canceled'
              });
            });

        },
        cancel(){
            window.location.replace(this.url+'#/aproval_vendor')
        }
    }
}
</script>

<style lang="css">
</style>
