<template >
<div>
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">NON-DISCLOSURE AGREEMENT </h1>
                </div>
                <div class="panel-body" v-if="tableShow == true">
                    <div class="col-md-7" >
                        <button v-if="role == 2" type="button" name="button" class="btn btn-primary btn-sm" @click="tableShow = false">Add NDA</button>
                    </div>
                    <div class="col-md-5 text-right">
                        <el-input @change="getData"
                            placeholder="search"
                            v-model="search"
                            clearable><el-button @click="() => { search = ''; getData(); } " slot="append" icon="el-icon-refresh"></el-button>
                        </el-input>
                    </div>
                    <el-table :data="tableData.data" style="width: 100%" v-loading="loading">
                        <el-table-column sortable prop="user.name" label="Name"></el-table-column>
                        <el-table-column sortable prop="agent" label="Agent"></el-table-column>
                        <el-table-column sortable prop="periode" label="Periode"></el-table-column>
                        <el-table-column sortable prop="periode" label="#">
                          <template slot-scope="scope">
                              <el-button type="primary" icon="fa fa-eye" size="mini" round
                              @click="detailData = scope.row, popupAttachmentDialog = true "> See Detail</el-button>
                          </template>
                        </el-table-column>
                        <el-table-column sortable prop="status" label="Status">
                          <template slot-scope="scope">
                              <a @click="histories(scope.row)" :class="'alert  '+ $store.state.Status.find(t => t.id == scope.row.status).notif ">
                                <i class="fa fa-search"> </i>  {{ $store.state.Status.find(t => t.id == scope.row.status ).status }}
                              </a>
                          </template>
                        </el-table-column>
                        <el-table-column fixed="right" label="#" align="center" width="60">
                          <template slot-scope="scope">
                              <el-dropdown>
                                  <span class="el-dropdown-link">
                                    <i class="fa fa-angle-double-down"></i>
                                  </span>
                                  <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item v-if='role == 1 && (scope.row.status > 0 && scope.row.status < 3)'>
                                      <a ><i class="fa fa-times"></i> Nothing Action </a>
                                    </el-dropdown-item>
                                    <a @click="checked(scope.row.id)">
                                      <el-dropdown-item v-if="role == 2 && (scope.row.status == 0 || scope.row.status == 4)">
                                        <i class="fa fa-check"></i> {{ scope.row.status == 0 ? 'Submit' : 'Re-Submit' }}
                                      </el-dropdown-item>
                                    </a>
                                    <a :href="url+'/detail/'+scope.row.id" target="_blank" v-if='scope.row.status == 3'>
                                      <el-dropdown-item >
                                        <i class="fa fa-file-o"></i> Detail Attachment
                                      </el-dropdown-item>
                                    </a>
                                    <a @click="edit(scope.row)">
                                      <el-dropdown-item v-if="role == 2 && (scope.row.status == 0 || scope.row.status == 4)">
                                        <i class="fa fa-pencil"></i> Edit
                                      </el-dropdown-item>
                                    </a>
                                    <div v-if="(role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2)">
                                      <a @click="checked(scope.row.id)">
                                        <el-dropdown-item v-if="
                                          (role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2)">
                                          <i class="fa fa-check"></i> Accept
                                        </el-dropdown-item>
                                      </a>
                                    </div>
                                    <div v-else>
                                      <el-dropdown-item v-if='role != 2'>
                                        <a ><i class="fa fa-times"></i> Nothing Action </a>
                                      </el-dropdown-item>
                                    </div>
                                    <a @click="reject(scope.row)">
                                      <el-dropdown-item v-if="(role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2)">
                                        <i class="fa fa-times"></i> Reject
                                      </el-dropdown-item>
                                    </a>
                                    <a @click="deleted(scope.row)" target="_blank"><el-dropdown-item v-if="scope.row.user_id == auth_id && (scope.row.status == 0 || scope.row.status == 4)"><i class="fa fa-trash"></i> Delete </el-dropdown-item></a>
                                  </el-dropdown-menu>
                              </el-dropdown>
                              <!--  </a>
                              <a @click="viewDetail(scope.row)"> <i class="icon-eye "></i> </a> -->
                          </template>
                        </el-table-column>
                      </el-table>

                  <br>
                  <el-pagination
                  background
                  @size-change="(s) => { pageSize = s; getData(); }"
                  @current-change="(p) => { page = p; getData(); }"
                  :page-size="pageSize"
                  :page-sizes="[10, 25, 50, 100]"
                  layout="prev, pager, next, sizes, total"
                  :total="tableData.total">
                  </el-pagination>
                </div>

                <!-- form  -->
                <div class="panel-body" v-else>
                  <div v-show="mainform" class="form-horizontal">
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Name of User</label>
                          <div class="col-sm-10">
                              <input type="text"  placeholder="Name of User" readonly :value="name" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Buyer</label>
                          <div class="col-sm-10">
                              <el-input placeholder="Buyer" v-model="input.buyer"></el-input>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Seller</label>
                          <div class="col-sm-10">
                            <el-input placeholder="Seller" v-model="input.seller"></el-input>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Agent</label>
                          <div class="col-sm-10">
                            <el-input placeholder="Agent" v-model="input.agent"></el-input>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Effective of Day</label>
                          <div class="col-sm-10">
                            <el-input placeholder="Effective of Day" v-model="input.effective_date"></el-input>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Periode</label>
                          <div class="col-sm-10">
                            <el-date-picker v-model="input.periode" type="date" placeholder="Periode" value-format="yyyy-MM-dd" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Investment</label>
                          <div class="col-sm-10">
                            <el-input placeholder="Investment" v-model="input.investment"></el-input>
                          </div>
                      </div>
                      <!-- <div class="form-group">
                          <label class="col-sm-2 control-label">Agent</label>
                          <div class="col-sm-10">
                              <textarea name="name" rows="5" class="form-control" v-model="input.attachment"></textarea>
                          </div>
                      </div> -->
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-primary" @click="input.id == undefined ?  save() : update()" >{{ input.id == undefined ? 'Save' : 'Update' }}</button>
                          <button class="btn btn-danger" @click="tableShow = true, input = {}" >Cancel</button>
                        </div>
                      </div>

                  </div>
                </div>
            </div>
        </div>
    </div>


    <el-dialog title="History Request" :visible.sync="historyModal" >
      <el-steps :active="parseInt(status)" :finish-status="status == 4 ? 'error' : 'success'" v-if="historyModal == true">
          <el-step title="Submit" v-if="status >= 1"  description="User"></el-step>
          <el-step title="Accept" v-if="status >= 2"  description="Manager"></el-step>
          <el-step title="Approve" v-if="status >= 3 && status != 6"  description="HRD" ></el-step>
          <el-step title="Reject" v-if="status >= 4"  description="Reject" ></el-step>
          <!-- <el-step title="Approve" v-if="status >= 5"  description="GM QSA" ></el-step>
          <el-step title="Reject" v-if="status >= 6"  description="GM QSA" ></el-step> -->

          <!-- <el-step title="Processing" description="User" v-if="track == 0"></el-step> -->
          <el-step title="Processing" description="Manager" v-if="status == 1"></el-step>
          <el-step title="Processing" description="General Manager" v-if="status == 2"></el-step>
          <!-- <el-step title="Processing" description="QSA" v-if="status == 3"></el-step>
          <el-step title="Processing" description="GM QSA" v-if="status == 4"></el-step> -->

          <el-step title="Step 1" v-if="status == 0" description="User"></el-step>
          <el-step title="Step 2" v-if="status < 1" description="Manager"></el-step>
          <el-step title="Step 3" v-if="status < 2" description="HRD"></el-step>
          <!-- <el-step title="Step 4" v-if="status < 3" description="QSA"></el-step>
          <el-step title="Step 5" v-if="status < 4" description="GM QSA"></el-step> -->
      </el-steps>
      <br>
      <hr>
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Status </th>
                  <th># </th>
                  <th>Note </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(d, n) in dataHistory" :key="n">
                  <td>{{ n+1 }}</td>
                  <td>{{ d.created_at }}</td>
                  <td>{{ $store.state.Status.find(t => t.id == d.status).status }}</td>
                  <td>{{ d.aproval }}</td>
                  <td> <pre>{{ d.note }}</pre> </td>
              </tr>
          </tbody>
      </table>
      <span slot="footer" class="dialog-footer">
        <el-button @click="historyModal = false">Close</el-button>
        <!-- <el-button type="primary" @click="dialogVisible = false">Confirm</el-button> -->
      </span>
    </el-dialog>

    <el-dialog title="Popup Attachment"  width="30%" :visible.sync="popupAttachmentDialog" >
      <table class="table table-striped table-hover">
        <tbody>
          <tr>
            <td>Name of user</td>
            <td>{{detailData.user_id}}</td>
          </tr>
          <tr>
            <td>Buyer</td>
            <td>{{detailData.buyer}}</td>
          </tr>
          <tr>
            <td>Seller</td>
            <td>{{detailData.seller}}</td>
          </tr>
          <tr>
            <td>Agent</td>
            <td>{{detailData.agent}}</td>
          </tr>
          <tr>
            <td>Effective Date</td>
            <td>{{ detailData.effective_date }} Days, Since {{ detailData.periode  }}</td>
          </tr>
          <tr>
            <td>Investment </td>
            <td>{{ detailData.investment }}</td>
          </tr>
        </tbody>
      </table>
        <br>
    </el-dialog>

    <el-dialog title="Form Reject " :visible.sync="formReject" >
        <form class="form-horizontal">

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
</div>
</template>

<script>
import moment from 'moment'
import popupAttachment from '../app/popupAttachment'
  export default {
    components: { popupAttachment },
    computed: {
        Status() { return this.$store.state.Status } ,
    },
    created() {
        this.$store.commit('getStatus');
    },
    mounted(){
        this.getData() ;
    },
    data() {
        return {
            name : AUTH_LOGIN_NAME, formReject : false , detailData : [],
            link : '', popupAttachmentDialog : false ,
            tableShow : true ,
            input:{} ,
            filters : {},
            sort: 'request_number',
            order: 'descending',
            tableData: {},
            page: 1,
            pageSize: 10,
            dataHistory : [], role : ROLE, resubmitDialog : false, id : '',
            auth_id : AUTH_LOGIN_ID , ScoreDialog : false , loading : true,
            data: [] , url : BASE_URL + 'Nda' , dialogVisible: false ,
            datamain : [] , mainform : true, auth_personel : false , documents : false, materials : false, tools : false,
            historyModal : false ,search : '', input:{} , formReject : false, role_request : ROLE_REQUEST ,
            fileList : [], status
        }
    },
    methods: {
      edit(data){
          this.tableShow = false
          this.input = JSON.parse(JSON.stringify(data))
      },
      save(){
          axios.post(this.url, this.input).then((res) => {
            if(res.data.status == 1){
              this.getData()
              this.tableShow = true
              alert('Succes Save')
            }
          })
          .catch((err) => {
            console.log(err);
          })
          .finally(() => {

          })
      },
      update(){
          axios.put(this.url+'/'+this.input.id, this.input).then((res) => {
            if(res.data.status == 1){
              this.getData()
              this.tableShow = true
              alert('Update Save')
            }
          })
          .catch((err) => {
            console.log(err);
          })
          .finally(() => {

          })
      },
      onProses(response, file, fileList){
          this.input.attachment = response.file
      },
      checkScore(id){
          this.ScoreDialog = true
          this.id_request = id
      },
      detail(data){
        if(this.role == 4 && data.status == 1){
          console.log('masih level manager loo');
        }else{
          axios.get(this.url+'/read/'+data.id).then((res) => {
            this.getData()
            console.log(res.data);
          })
          .catch((err) => {

          })
        }
         window.open(this.url+"/detail/"+data.id, '_blank')
      },
      deleted(data){
          this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
              axios.delete(this.url+'/'+data.id+'?type=delete_request').then((res) => {
                  this.$message({
                      type: 'success',
                      message: 'Request deleted'
                  });
                  this.getData()
              })
              .catch((err) => {
                  console.log(err);
              })
          }).catch(() => {
            this.$message({
              type: 'info',
              message: 'Delete canceled'
            });
          });

      },
      histories(data){
        this.historyModal = true
        this.dataHistory = data.request_history
        this.status = data.status
      },
      checked(id){
          this.$confirm('Do you want to Accept this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
              const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
              axios.put(this.url + '/approve/'+ id, id).then((res) => {
                console.log(res.data);
                  if(res.data.status = 1){
                      this.getData()
                      this.$message({
                          type: 'success',
                          message: 'Request Checked'
                      });
                  }
                  loading.close()
              })
              .catch((err) => {
                  loading.close()
                  console.log(res.data);
              })
          }).catch(() => {
            this.$message({
              type: 'info',
              message: 'Approve canceled'
            });
          });
      },
      viewDetail(data){
          this.datamain = data.aircraft_request
          console.log(data);
          this.dialogVisible = true
      },
      getData(){
        let params = {
          pageSize: this.pageSize,
          page: this.page,
          search : this.search,
          sort: this.sort,
          order: this.order
        }
          axios.get(this.url, { params: Object.assign(params, this.filters, this.input) }).then((res) => {
              this.tableData = res.data
              this.loading = false
          })
          .catch((err) => {
              this.loading = false
              console.log(err);
          })
      },
      reject(data){
          this.formReject = true
          console.log(data);
          this.input = data
      },
      rejectProses(data){
          this.$confirm('Are you sure want to Reject this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/reject/'+data.id, data ).then((res) => {
              this.formReject = false
              this.$message({
                 type: 'success',
                 message: 'Request Rejected'
               });
               this.input = {}
               this.getData();
               loading.close()
            })
            .catch((err) => {
                console.log(err);
                loading.close()
            })
          }).catch(() => {
            this.$message({
              type: 'info',
              message: 'Approve canceled'
            });
          });

      },
      customFormatter(date) {
        return moment(date).format('DD MMMM YYYY');
      },
    },
  }
</script>

<style lang="css">
  .alert{
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
  }
  .alert a:hover{
      color: white;
      background-color: red;
      border-color: #ebccd1;
  }
</style>
