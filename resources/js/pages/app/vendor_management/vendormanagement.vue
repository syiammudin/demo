<template >
<div v-if="role_request == 5 || role == 1 || role == 4 || role == 5|| role == 6">
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Vendor Management</h1>
            </div>
            <div class="panel-body">
                <div v-show="mainForm">
                    <div class="col-md-7">
                        <router-link v-if="role == 2" :to="{ name: 'form_vendor_management', params: { type : '0' } }" size="mini" class="btn btn-sm btn-primary" round > Add Data</router-link>
                        <el-popover
                        placement="top-start"
                        width="500"
                        trigger="hover">
                        <el-form label-width="150px" label-position="right" size="mini">
                          <el-form-item label="Type Supplier">
                            <el-input size="small" placeholder="Type Supplier" v-model="input.type_supplier"></el-input>
                          </el-form-item>
                          <el-form-item label="Dept">
                            <el-input size="small" placeholder="Dept" v-model="input.dept"></el-input>
                          </el-form-item>
                          <el-form-item label="Vendor Name">
                            <el-input size="small" placeholder="Vendor Name" v-model="input.vendor_name"></el-input>
                          </el-form-item>
                          <el-button size="small" plain type="primary" icon="el-icon-search" @click="getData()">Search</el-button>
                          <el-button size="small" plain type="primary" icon="el-icon-refresh" @click="input = {}, getData()">Reset</el-button>
                        </el-form>
                        <button class="btn btn-primary btn-sm" slot="reference"><i class="fa fa-search"></i>  Advance Filter</button>
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
                                  <el-steps :active="customStatus(scope.row.status)" :finish-status="scope.row.status == 6 ? 'error' : 'success'" >
                                    <el-step description="Draft" title=""></el-step>
                                    <el-step description="Document completion by vendor" title=""></el-step>
                                    <el-step description="Submit by User" title=""></el-step>
                                    <el-step description="Manager approval" title=""></el-step>
                                    <el-step description="GM approval" title=""></el-step>
                                    <el-step description="Quality Approval" title=""></el-step>
                                    <el-step description="Completed" title=""></el-step>
                                  </el-steps>
                              </div>
                          </template>
                        </el-table-column>
                        <el-table-column sortable prop="request_number" width="150" label="No Request" ></el-table-column>
                        <el-table-column sortable prop="type_supplier" width="170" label="Type Supplier" ></el-table-column>
                        <el-table-column sortable prop="dept" label="DEPT" width="100"></el-table-column>
                        <el-table-column sortable prop="vendor_name" label="Vendor Name" width="220"></el-table-column>
                        <el-table-column sortable prop="contact_email" label="Email" width="250"></el-table-column>
                        <el-table-column sortable prop="contact_name" label="Contact" width="100"></el-table-column>
                        <el-table-column sortable prop="contact_title" label="Title" ></el-table-column>
                        <el-table-column sortable prop="created_at" label="Date"  width="100"></el-table-column>
                        <el-table-column column-key="status" :filters="$store.state.Status.filter(f => f.id != 7).map(s => { return {text: s.status, value: s.id} })" sortable prop="status" fixed="right"  label="Status" width="200" header-align="center" align='center'>
                            <template slot-scope="scope">
                              <a @click="dataHistory = scope.row.vendor_management_history, historyModal2 = true" :class="'alert  '+ $store.state.Status.find(t => t.id == scope.row.status).notif ">
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
                                      <a @click="histories(scope.row.vendor_management_history, scope.row.status)" target="_blank"><el-dropdown-item ><i class="fa fa-eye"></i> History </el-dropdown-item></a>
                                      <a @click="detail(scope.row)" target="_blank"> <el-dropdown-item ><i class="fa fa-eye"></i> Detail</el-dropdown-item> </a>
                                      <a @click="ScoreDialog = true, id_request = scope.row.id"><el-dropdown-item><i class="fa fa-calculator"></i> Score Decision</el-dropdown-item></a>
                                      <!-- <a :href="base_url+'vendor_attach/print/'+scope.row.id+'?token='+scope.row.token" target="_blank"><el-dropdown-item v-if='scope.row.attachment != null'><i class="fa fa-eye"></i> Document Vendor </el-dropdown-item></a> -->
                                      <router-link :to="{ name: 'form_vendor_management', params: { type : scope.row.id } }"><el-dropdown-item v-if="scope.row.status == 0 || scope.row.status == 6 || scope.row.status == 7"><i class="fa fa-pencil"></i> Edit</el-dropdown-item></router-link>
                                      <a @click="deleted(scope.row.id)" target="_blank"><el-dropdown-item v-if="scope.row.user_id == auth_id && scope.row.status == 0"><i class="fa fa-trash"></i> Delete </el-dropdown-item></a>
                                      <div v-if="scope.row.read != null">
                                              <!-- <a @click="aprove(scope.row)"><el-dropdown-item v-if="(role == 5 || role == 6) && (scope.row.status == 3 || scope.row.status == 4) && scope.row.read.split('|').find(r => r == auth_id)"><i class="fa fa-check"></i>  Aprove </el-dropdown-item></a> -->
                                              <div v-if="scope.row.status == 1 || scope.row.status == 2 || scope.row.status == 3">
                                                    <a @click="checked(scope.row.id)">
                                                      <el-dropdown-item v-if="((role == 3 && scope.row.status == 1) || (role == 4 && scope.row.status == 2))  && scope.row.read.split('|').find(r => r == auth_id)">
                                                        <i class="fa fa-check"></i> Accept
                                                      </el-dropdown-item>
                                                    </a>
                                                   <el-dropdown-item v-if="((role == 3 && scope.row.status >= 2) || (role == 4 && scope.row.status >= 3))  && scope.row.read.split('|').find(r => r == auth_id)">
                                                       <a ><i class="fa fa-check"></i> Already Checked</a>
                                                   </el-dropdown-item>
                                              </div>
                                          <a @click="reject(scope.row)"><el-dropdown-item v-if="role == 3 && scope.row.status == 1 || role == 4 && scope.row.status == 2 && scope.row.read.split('|').find(r => r == auth_id)"> <i class="fa fa-times"></i> Reject</el-dropdown-item></a>
                                      </div>
                                      <a @click="resubmitDialog = true , dataHistory = scope.row.vendor_management_history.filter(d => d.status == 1 && d.note != null)" target="_blank" v-if="scope.row.vendor_management_history.filter(d => d.status == 6).length > 0"><el-dropdown-item ><i class="fa fa-file-o"></i> Note re-Submit </el-dropdown-item></a>
                                    </el-dropdown-menu>
                                </el-dropdown>
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
    <el-dialog title="History Vendor Management" width="80%" :visible.sync="historyModal" >
        <el-steps :active="customStatus(track)" :finish-status="track == 6 ? 'error' : 'success'" >
            <el-step description="Draft" title=""></el-step>
            <el-step description="Document completion by vendor" title=""></el-step>
            <el-step description="Submit by User" title=""></el-step>
            <el-step description="Manager approval" title=""></el-step>
            <el-step description="GM approval" title=""></el-step>
            <el-step description="Quality Approval" title=""></el-step>
            <el-step description="Completed" title=""></el-step>
         </el-steps>
         <div class="line-dashed"></div>
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
                    <td>{{ d.name }}</td>
                    <td><pre>{{ d.note }}</pre></td>
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
                <label class="col-md-3">Vendor</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" readonly v-model="input.vendor_name">
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
        <viewDecision v-if="ScoreDialog == true" :id="id_request" :type="'vendor'" />
    </el-dialog>

    <el-dialog title="Resubmit Note " width="40%" :visible.sync="resubmitDialog" >
      <div class="" v-if="resubmitDialog == true">
        Note : {{ dataHistory[dataHistory.length - 1].note }}
      </div>
    </el-dialog>

    <el-dialog title="Note" :visible.sync="historyModal2" >
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
                  <td>{{ d.note }}</td>
              </tr>
          </tbody>
      </table>
    </el-dialog>
</div>
</template>

<script>
import FormVM from './FormVendorManagement'
import viewDecision from '../decision/viewDecision'
import moment from 'moment'
export default {
    components : {
        FormVM, viewDecision
    },
    computed : {
            Status() { return this.$store.state.Status } ,
            filteredData() {
                return this.data.map(d => {
                            d.status_name = this.$store.state.Status.find(t => t.id == d.status).status
                            return d
                        })
                        .filter(data => !this.search || data.vendor_name.toLowerCase().includes(this.search.toLowerCase()) ||
                                        data.dept.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.contact_name.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.created_at.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.type_supplier.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.status_name.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.contact_email.toLowerCase().includes(this.search.toLowerCase())  ||
                                        data.contact_title.toLowerCase().includes(this.search.toLowerCase())
                                )
            }
    },
    created(){
            this.$store.commit('getStatus');
    },
    data(){
        return {
          input : {} ,
            filters : {},
            sort: 'request_number',
            order: 'descending',
            tableData: {},
            page: 1,
            pageSize: 10,
            ScoreDialog : false , id_request : '',
            data : [] , mainForm: true, auth_id : AUTH_LOGIN_ID, role : ROLE , role_request : ROLE_REQUEST ,
            input : {}, url : BASE_URL + 'submit_vendor', search : '', page : 1 , base_url : BASE_URL ,
            type : '', historyModal : false, dataHistory : [], formReject : false, track : 0, resubmitDialog : false, dataHistory : [],
            loading : false, dataHistory : [], historyModal2 : false
        }
    },
    mounted(){
        this.getData() ;
    },
    methods : {
        sortChange(c) {
          if (c.prop != this.sort || c.order != this.order) {
                  this.sort = c.prop; this.order = c.order; this.getData()
              }
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
        histories(data, status){
            console.log(data);
            this.dataHistory = data
            this.track = status
            this.historyModal = true
        },
        deleted(id){
            this.$confirm('Do you want Delete this Request ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                axios.delete(this.url+'/'+id).then((res) => {
                    this.$message({ type: 'success', message: 'Delete Success'})
                    this.getData()
                })
                .catch((err) => {

                })
            }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled'});
            });

        },
        nextPage(page) {
            this.page = page
            console.log(page);
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
                console.log(this.tableData);
                this.loading = false
            })
            .catch((err) => {
                this.loading = false
                console.log(err);
            })
        },
        submit(){
            this.FormVendorManagement = false
            this.mainForm = true
        },
        edit(data){
            this.type = data
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
        aprove(data){
            this.$confirm('Are you sure want to approve this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
                axios.put(this.url+'/approve/'+data.id).then((res) => {
                    console.log(res.data);
                    // if(res.data.status == 1 ){
                    //     this.getData();
                    //     this.$message({
                    //         type: 'success',
                    //         message: 'Approve completed'
                    //     });
                    // }else{
                    //     this.$message({
                    //         type: 'danger',
                    //         message: 'That request Already maked like request '
                    //     });
                    // }
                    loading.close() ;
                })
                .catch((err) => {
                    loading.close() ;
                })
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Approve canceled'
                });
            });
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
        customStatus(d) {
            if(d == 0){
                return 1;
            }
            if(d == 1){
                return 3;
            }
            if(d == 2){
                return 4;
            }
            if(d == 3){
                return 5
            }
            if(d == 4){
                return 6
            }
            if(d == 5){
                return 7
            }
            if(d == 6){
                return 8
            }
            if(d == 7){
                return 2
            }
        },
        customFormatter(date) {
          return moment(date).format('DD MMMM YYYY');
        },
    },

}
</script>

<style lang="css">
</style>
