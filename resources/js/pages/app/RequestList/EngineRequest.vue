<template >
<div class="" v-if="role_request == 3 || role == 1 || role == 4 || role == 5 || role == 6">
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Request List Engine</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-7" >
                        <!-- <router-link :to="{ name: 'form_engine', params: { type : '0' } }" class="btn btn-primary"> Create Request</router-link> -->
                        <router-link v-if="role == 2 || role == 3" :to="{ path: 'form_engine/Engine Capability Request/add' }" class="btn btn-primary"> Create Request</router-link>
                        <router-link v-if="role == 2 || role == 3" :to="{ path: 'form_engine/Engine Capability Request/change' }" class="btn btn-success"> Change Request</router-link>
                        <router-link v-if="role == 2 || role == 3" :to="{ path: 'form_engine/Engine Capability Request/delete' }" class="btn btn-danger "> Delete </router-link>
                        <el-popover
                            placement="top-start"
                            width="400"
                            trigger="hover">
                            <el-form label-width="150px" label-position="right" size="mini">
                              <el-form-item label="Request Type">
                                <el-input size="small" placeholder="Request Type" v-model="input.request_type"></el-input>
                              </el-form-item>
                              <el-form-item label="Part Number">
                                <el-input size="small" placeholder="Part Number" v-model="input.part_number"></el-input>
                              </el-form-item>
                              <el-form-item label="ATA Chapter">
                                <el-input size="small" placeholder="ATA" v-mask="'##-##-##'" v-model="input.ata_chapter"></el-input>
                              </el-form-item>
                              <el-form-item label="Aircraft Type">
                                <el-input size="small" placeholder="AC Type" v-model="input.aircraft_type"></el-input>
                              </el-form-item>
                              <el-button size="small" plain type="primary" icon="el-icon-search" @click="getData()">Search</el-button>
                              <el-button size="small" plain type="primary" icon="el-icon-refresh" @click="input = {}, getData()">Reset</el-button>
                            </el-form>
                            <button class="btn btn-primary" slot="reference"><i class="fa fa-search"></i>  Advance Filter</button>
                          </el-popover>
                    </div>
                    <div class="col-md-5 text-right">
                      <el-input @change="getData"
                          placeholder="search"
                          v-model="search"
                          clearable><el-button @click="() => { search = ''; getData(); } " slot="append" icon="el-icon-refresh"></el-button>
                      </el-input>
                    </div>
                    <el-table @sort-change="sortChange" :default-sort="{prop: sort, order: order}" :data="tableData.data" style="width: 100%"
                            @filter-change="(f) => { let c = Object.keys(f)[0]; filters[c] = Object.values(f[c]); page = 1; getData(); }"
                            v-loading="loading">
                        <el-table-column type="expand">
                          <template slot-scope="scope">
                              <div class="col-md-10">
                                  <el-steps :active="parseInt(scope.row.status)" :finish-status="scope.row.status == 6 ? 'error' : 'success'" >
                                      <el-step title="Submit" v-if="scope.row.status >= 1"  description="User"></el-step>
                                      <el-step title="Accept" v-if="scope.row.status >= 2"  description="Manager"></el-step>
                                      <el-step title="Accept" v-if="scope.row.status >= 3 && scope.row.status != 6"  description="Genereal Manager" ></el-step>
                                      <el-step title="Approve" v-if="scope.row.status >= 4"  description="QSA" ></el-step>
                                      <el-step title="Approve" v-if="scope.row.status >= 5"  description="GM QSA" ></el-step>
                                      <el-step title="Reject" v-if="scope.row.status >= 6"  description="GM QSA" ></el-step>

                                      <!-- <el-step title="Processing" description="User" v-if="track == 0"></el-step> -->
                                      <el-step title="Processing" description="Manager" v-if="scope.row.status == 1"></el-step>
                                      <el-step title="Processing" description="General Manager" v-if="scope.row.status == 2"></el-step>
                                      <el-step title="Processing" description="QSA" v-if="scope.row.status == 3"></el-step>
                                      <el-step title="Processing" description="GM QSA" v-if="scope.row.status == 4"></el-step>

                                      <el-step title="Step 1" v-if="scope.row.status == 0" description="User"></el-step>
                                      <el-step title="Step 2" v-if="scope.row.status < 1" description="Manager"></el-step>
                                      <el-step title="Step 3" v-if="scope.row.status < 2" description="General Manager"></el-step>
                                      <el-step title="Step 4" v-if="scope.row.status < 3" description="QSA"></el-step>
                                      <el-step title="Step 5" v-if="scope.row.status < 4" description="GM QSA"></el-step>
                                  </el-steps>
                              </div>
                          </template>
                        </el-table-column>
                        <el-table-column sortable prop="request_number" label="No Request" width="150"></el-table-column>
                        <el-table-column sortable prop="request_type" label="Request type" width="150">
                            <template slot-scope="scope">
                                {{ scope.row.request_type }} ({{ scope.row.step_request_type }})
                            </template>
                        </el-table-column>
                        <el-table-column sortable prop="part_number"  label="Part Number" width="200"></el-table-column>
                        <el-table-column sortable prop="ata_chapter"  label="Ata Chapter" width="150"></el-table-column>
                        <el-table-column sortable prop="aircraft_type" label="Aircraft Type" width="200"></el-table-column>
                        <el-table-column sortable prop="created_at" label="Date" width="200"></el-table-column>
                        <el-table-column column-key="status" :filters="$store.state.Status.filter(f => f.id != 7).map(s => { return {text: s.status, value: s.id} })" sortable prop="status" fixed="right"  label="Status" width="200" header-align="center" align='center'>
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
                                    <a  @click="detail(scope.row)"><el-dropdown-item ><i class="fa fa-eye"></i> Detail</el-dropdown-item></a>
                                    <router-link :to="{ name: 'form_engine', params: { type : scope.row.id } }"><el-dropdown-item v-if="(scope.row.status == 0 || scope.row.status == 6 ) && scope.row.user_id == auth_id"><i class="fa fa-edit"></i> Edit Request </el-dropdown-item></router-link>
                                    <router-link :to="{ name : 'tracking', params: { type : scope.row.id } }"><el-dropdown-item><i class="fa fa-edit"></i>Tracking and Histories  </el-dropdown-item></router-link>
                                    <div v-if="scope.row.status_read != null">
                                            <div v-if="scope.row.status == 1 && role == 3 || scope.row.status == 2 && role == 4">
                                                <a @click="checked(scope.row.id)">
                                                    <el-dropdown-item v-if="(role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2)  && scope.row.status_read.split('|').find(r => r == auth_id)">
                                                        <i class="fa fa-check"></i> Accept
                                                    </el-dropdown-item>
                                                </a>
                                            </div>
                                            <div v-else>
                                                <el-dropdown-item v-if="(role == 3 && scope.row.status !=0 || role == 4 && scope.row.status !=0 ) && scope.row.status_read.split('|').find(r => r == auth_id)">
                                                    <a ><i class="fa fa-check"></i> Already Accept</a>
                                                </el-dropdown-item>
                                            </div>
                                            <a @click="reject(scope.row)">
                                                <el-dropdown-item v-if="(role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2) && scope.row.status_read.split('|').find(r => r == auth_id)">
                                                        <i class="fa fa-times"></i> Reject
                                                </el-dropdown-item>
                                            </a>
                                    </div>
                                    <a @click="checkScore(scope.row.id)"><el-dropdown-item v-if="scope.row.score != null && (role == 5 || role == 6)"><i class="fa fa-calculator"></i> Score Decision</el-dropdown-item></a>
                                    <a @click="resubmitDialog = true , id = (scope.row.id)" target="_blank"><el-dropdown-item v-if="scope.row.step_request_type == 're-Submit'"><i class="fa fa-file-o"></i> Reason re-Submit </el-dropdown-item></a>
                                    <a @click="deleted(scope.row)" target="_blank"><el-dropdown-item v-if="scope.row.user_id == auth_id"><i class="fa fa-trash"></i> Delete </el-dropdown-item></a>
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
            </div>
        </div>
    </div>

    <el-dialog title="History Request" :visible.sync="historyModal" >
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
                  <td><pre>{{ d.note }}</pre> </td>
              </tr>
          </tbody>
      </table>
      <span slot="footer" class="dialog-footer">
        <el-button @click="historyModal = false">Close</el-button>
        <!-- <el-button type="primary" @click="dialogVisible = false">Confirm</el-button> -->
      </span>
    </el-dialog>

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
    <el-dialog title="Decision Score " :visible.sync="ScoreDialog" >
        <viewDecision v-if="ScoreDialog == true" :id="id_request" />
    </el-dialog>
    <el-dialog title="Note Resubmit " :visible.sync="resubmitDialog" >
        <resubmit v-if="resubmitDialog == true" :id="id" type="engine"/>
   </el-dialog>
</div>
</template>

<script>
  import viewDecision from '../decision/viewDecision'
  import resubmit from './viewResubmitnote'
  import moment from 'moment'
  export default {
    components : { viewDecision, resubmit},
    computed: {
        Status() { return this.$store.state.Status } ,
        filteredList() {
            return this.data.map(d => {
                        d.status_name = this.$store.state.Status.find(t => t.id == d.status).status
                        return d
                    })
                    .filter(data => !this.search
                                    || data.request_number.toLowerCase().includes(this.search.toLowerCase())
                                    || data.request_type.toLowerCase().includes(this.search.toLowerCase())
                                    || data.status_name.toLowerCase().includes(this.search.toLowerCase())
                                    || data.created_at.toLowerCase().includes(this.search.toLowerCase())
                                    || data.engine_request.part_number.toLowerCase().includes(this.search.toLowerCase())
                                    || (data.engine_request.ata_chapter != null && data.engine_request.ata_chapter.toLowerCase().includes(this.search.toLowerCase()))
                                    || (data.engine_request.aircraft_type != null && data.engine_request.aircraft_type.toLowerCase().includes(this.search.toLowerCase()))
                                )
        }
    },
    created() {
        this.$store.commit('getStatus');
    },
    mounted(){
        this.getData() ;
    },
    data() {
        return {
            input : {},
            filters : {},
            sort: 'request_number',
            order: 'descending',
            tableData: {},
            page: 1,
            pageSize: 10,
            dataHistory : [], role : ROLE,  resubmitDialog : false, id : '',
            auth_id : AUTH_LOGIN_ID , ScoreDialog : false , loading : true,
            data: [] , url : BASE_URL + 'submit_engine' , dialogVisible: false ,
            datamain : [] , mainform : true, auth_personel : false , documents : false, materials : false, tools : false,
            historyModal : false ,search : '', formReject : false, input:{}, role_request : ROLE_REQUEST
        }
    },
    methods: {
        sortChange(c) {
          if (c.prop != this.sort || c.order != this.order) {
                  this.sort = c.prop; this.order = c.order; this.getData()
              }
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
           window.open(this.url+"/detail/"+data.id+' - Detail Engine Request', '_blank')
        },
      deleted(data){
          this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
              axios.delete(this.url +'/'+data.id+'?type=delete_request').then((res) => {
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
          axios.get(this.url+'/'+data.id).then((res) => {
              this.historyModal = true
              this.dataHistory = res.data[0].request_history
          })
          .catch((err) => {
              console.log(err);
          })
      },
      reject(data){
          this.formReject = true
          this.input = data
      },
      rejectProses(data){
          this.$confirm('Are you sure want to Reject this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/reject/'+data.id, data).then((res) => {
              this.input = {}
              this.getData();
              this.formReject = false
              this.$message({
                 type: 'success',
                 message: 'Request Rejected'
               });
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
      checked(id){
          this.$confirm('Do you want to Accept this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
              axios.put(this.url + '/checked/'+ id, id).then((res) => {
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
                  console.log(res.data);
                  loading.close()
              })
          }).catch(() => {
            this.$message({
              type: 'info',
              message: 'Approve canceled'
            });
          });
      },
      viewDetail(data){
          this.datamain = data.engine_request
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
      mainForm(){
        this.mainform = true
        this.auth_personel = false
        this.documents = false
        this.materials = false
        this.tools = false
      },
      authPersonel(){
        this.mainform = false
        this.auth_personel = true
        this.documents = false
        this.materials = false
        this.tools = false
      },
      Documents(){
        this.mainform = false
        this.auth_personel = false
        this.documents = true
        this.materials = false
        this.tools = false
      },
      Materials(){
        this.mainform = false
        this.auth_personel = false
        this.documents = false
        this.materials = true
        this.tools = false
      },
      Tools(){
        this.mainform = false
        this.auth_personel = false
        this.documents = false
        this.materials = false
        this.tools = true
      },
      customFormatter(date) {
        return moment(date).format('DD MMMM YYYY');
      },
    },
  }
</script>

<style lang="css">

</style>
