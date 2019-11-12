<template>
    <div class="page-container">
        <div class="main-container gray-bg">

            <div class="main-content" v-if="role != 5 && role != 6">
                <div class="col-lg-7 z-index-41 text-center" >
                    <!-- {{ role }} -->
                    <h1>You Doesn't have permittion to access this Document</h1>
                </div>
            </div>
            <div class="main-content"  v-if="role == 5 || role == 6">
                <div class="col-lg-5 z-index-41" >
                    <div class="panel panel-default">
                        <div class="panel-heading no-border clearfix">
                            <h1 class="page-title">Questionnaire</h1>
                        </div>
                        <div class="panel-body table-responsive" style="width:100%; height: calc(100vh - 115px);">
                            <table class="table table-striped overflow-auto" style="font-size : 8pt;">
                                <thead>
                                    <tr>
                                        <th style="width:45%">Question</th>
                                        <th style="width:20%">Answer</th>
                                        <th style="width:35%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, i) in list_decision" :key="i">
                                        <td>{{ d.question }} </td>
                                        <td>
                                            <select v-if="input.status == 3 || input.status == 8" class="form-control" v-model='d.answer' @click="testting(d.answer)">
                                                <option value="N/A">N/A</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span v-if="input.status == 4">{{ d.answer }}</span>
                                        </td>
                                        <td>
                                            <div  v-if="input.status == 3 || input.status == 8">
                                                <!-- <textarea type="text" v-if="d.answer == 'No' || d.answer == 'N/A'" v-model='d.remark' class="form-control"></textarea> -->
                                                <textarea type="text" class="form-control"></textarea>
                                            </div>
                                            <div  v-else>
                                                {{ d.remark }}
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 v-if="input.status == 8">
                              Note from GM QSA : {{ input.request_history[input.request_history.length - 1].note }}
                            </h4>
                            <h4 v-if="input.request_history[input.request_history.length - 1].note !=  null && input.status != 8">
                              Note from QSA : {{ input.request_history[input.request_history.length - 1].note }}
                            </h4>
                            <h2> Score : {{ input.score }}</h2>
                            <div class="line-dashed"></div>

                            <div class="col-md-12 text-center" v-if="role == 5 || role == 6">
                              <!-- <button type="button" class="btn btn-success" @click="check()" v-if="input.status == 3 && input.qsa_part_approve == auth_id">Check Score</button> -->
                              <!-- <button type="button" class="btn btn-primary" @click="submit()" v-if="role == 5 && (input.status == 3 || input.status == 8) && input.qsa_part_approve == auth_id">Accepted</button> -->

                              <button type="button" class="btn btn-primary" @click="input.status == 8 ? FormSubmit = true :submit() " v-if="role == 5 && (input.status == 3 || input.status == 8) && input.qsa_part_approve == auth_id">Accepted</button>
                              <button type="button" name="button" @click="submit()" class="btn btn-primary" v-if="role == 6 && input.status == 4" >Approve</button>
                              <button v-if="role == 6 && input.status == 4 || (role == 5 && (input.status == 3 || input.status == 8) && input.qsa_part_approve == auth_id)" type="button" class="btn btn-danger" @click="formReject = true">Reject</button>
                              <button type="button" class="btn btn-warning" @click="cancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 z-index-41" >
                    <div class="panel panel-default  ">
                        <div class="panel-heading no-border clearfix">
                            <h1 class="page-title">Document</h1>
                        </div>
                        <div class="panel-body"  >
                            <object style="width:100%; height: calc(100vh - 150px);" type="application/pdf" :data="url+''+documents">
                                <p>Insert your error message here, if the PDF cannot be displayed.</p>
                            </object>
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

    </div>
</template>

<script>
export default {
    props : ['id_request', 'documents','type'],

    computed: {
        Questionare() { return this.$store.state.Questionare } ,
    },
    created() {
        this.$store.commit('getQuestionare');
        this.getData() ;
    },
    data() {
        return{
            url : BASE_URL, list_decision : [], score : '', input : {}, role : ROLE , auth_id : AUTH_LOGIN_ID, formReject : false, test : '', FormSubmit : false
        }
    },

    mounted(){
        if (this.role == 5) {
            this.getData() ;
        }
    },
    methods :{
        testting(d){
          const total = this.list_decision.filter(d => d.answer != 'N/A' && d.answer != null)
          const nilai = this.list_decision.filter(d => d.answer == 'Yes')
          const score = (nilai.length/total.length) * 100
          this.input.score =  parseFloat(score).toFixed(2) ;
        },
        approve(){
              window.close()
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
            const total = this.list_decision.filter(d => d.answer != 'N/A')
            const nilai = this.list_decision.filter(d => d.answer == 'Yes')
            const score = (nilai.length/total.length) * 100
            this.input.score =  parseFloat(score).toFixed(2) ;
        },
        getData(){
            axios.get(this.url+'submit_decision/'+this.id_request).then((res) => {
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
            const total = this.list_decision.filter(d => d.answer != 'N/A')
            const nilai = this.list_decision.filter(d => d.answer == 'Yes')
            const decision = this.list_decision.filter(d => d.answer == null)
            const score = (nilai.length/total.length) * 100
            this.input.score =  parseFloat(score).toFixed(2) ;

            if(this.list_decision.length == 0){
              this.$alert("No List Question, Please Refresh this page or call Admin to Add New Question", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
              return
            }

            this.input.decision = JSON.stringify(this.list_decision)
            this.input.id = this.id_request

            if(total.length <= 0){
                this.$alert("This Decision can't be null", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
            }
            if(decision.length >= 1){
                this.$alert("Question for decision can't be null", 'warning', {  type: 'danger', confirmButtonText: 'OK', });
            }

            if(total.length > 0 && decision.length == 0){
                if(this.type == 1){
                  var link = this.url+'submit_aircraft/approve/'+this.id_request ;
                }
                if(this.type == 2){
                  var link = this.url+'submit_component/approve/'+this.id_request ;
                }
                if(this.type == 3){
                  var link = this.url+'submit_engine/approve/'+this.id_request ;
                }
                if(this.type == 4){
                  var link = this.url+'submit_special/approve/'+this.id_request ;
                }
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                axios.put(link, this.input).then((res) => {
                    if(res.data.status == 1){
                        this.$message({  type: 'success', message: 'Decision Success Submitted' });
                        loading.close()

                        if(this.type == 1){
                            window.location.replace(this.url+'#/aproval_aircraft')
                        }
                        if(this.type == 2){
                            window.location.replace(this.url+'#/aproval_component')
                        }
                        if(this.type == 3){
                            window.location.replace(this.url+'#/aproval_engine')
                        }
                        if(this.type == 4){
                            window.location.replace(this.url+'#/aproval_special')
                        }
                    }else if(res.data.status == 2){
                          console.log(res.data.note);
                        if(this.type == 1){

                          // var warning = 'That request '+ res.data.note.request_type +' ('+ res.data.note.authority + ') for '+ res.data.note.aircraft_type + ' in ' + res.data.note.maintenance_area_value + ' with customer ' + res.data.note.aircraft_request.customer + ' to '+ res.data.note.aircraft_request.ability +' Already maked, Please Check Again, please Reject ' ;
                          const warning = 'Request '+ res.data.note.request_type +' ('+ res.data.note.aircraft_rating + ') for '+ res.data.note.aircraft_type + ' in ' + res.data.note.maintenance_area_value + ' with customer ' + res.data.note.customer + ' to ' + res.data.note.ability+' Already be a master in this Area, Please Check Again or Reject this Reqeust'
                          this.$alert( warning,{
                                      confirmButtonText: 'OK',
                                      callback: action => {
                                        this.$message({
                                          type: 'info',
                                          message: `action: ${ action }`
                                        });
                                      }
                                  }
                              );
                        }else{
                          this.$alert('Part Number with number '+ res.data.note +' Already used, Please Reject', 'Redudance Data', {
                            confirmButtonText: 'OK',
                            callback: action => {
                              this.$message({
                                type: 'info',
                                message: `action: ${ action }`
                              });
                            }
                          });
                        }
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
        rejectProses(){
          if(this.type == 1){
            var link = this.url+'submit_aircraft/reject/'+this.id_request ;
          }
          if(this.type == 2){
            var link = this.url+'submit_component/reject/'+this.id_request ;
          }
          if(this.type == 3){
            var link = this.url+'submit_engine/reject/'+this.id_request ;
          }
          if(this.type == 4){
            var link = this.url+'submit_special/reject/'+this.id_request ;
          }
          const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
          axios.put(link, this.input).then((res) => {
              this.$message({  type: 'success', message: 'Decision Success Submitted' });
              loading.close()

              if(this.type == 1){
                  window.location.replace(this.url+'#/aproval_aircraft')
              }
              if(this.type == 2){
                  window.location.replace(this.url+'#/aproval_component')
              }
              if(this.type == 3){
                  window.location.replace(this.url+'#/aproval_engine')
              }
              if(this.type == 4){
                  window.location.replace(this.url+'#/aproval_special')
              }
          })
          .catch((err) => {

          })
        },
        cancel(){
            if(this.type == 1){
                window.location.replace(this.url+'#/aproval_aircraft')
            }
            if(this.type == 2){
                window.location.replace(this.url+'#/aproval_component')
            }
            if(this.type == 3){
                window.location.replace(this.url+'#/aproval_engine')
            }
            if(this.type == 4){
                window.location.replace(this.url+'#/aproval_special')
            }
        }
    }
}
</script>

<style lang="css">
</style>
