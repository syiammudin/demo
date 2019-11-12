<template >
<div class="">
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Vendor Management</h1>
                </div>
                <div class="panel-body">
                  <div class="col-md-7">
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
                        <el-table-column width="150" prop="request_number" label="No Request" sortable></el-table-column>
                        <el-table-column width="200" prop="vendor_name" label="Vendor Name"></el-table-column>
                        <el-table-column width="200" prop="type_supplier" label="Type Supplier"></el-table-column>
                        <el-table-column width="150" prop="contact_name" label="Contact Name"></el-table-column>
                        <el-table-column width="150" prop="created_at"  label="Request Date"></el-table-column>
                        <el-table-column width="150" prop="user.name"  label="Purcaser"></el-table-column>
                        <el-table-column column-key="status" :filters="$store.state.Status.filter(f => role != 2 ? f.id != 0 : '' ).map(s => { return {text: s.status, value: s.id} })" sortable prop="status" fixed="right"  label="Status" width="200" header-align="center" align='center'>
                            <template slot-scope="scope">
                                <!-- <span :class="'alert  '+ $store.state.Status.find(t => t.id == scope.row.status).notif ">{{ scope.row.status_name }}</span> -->
                              <a @click="dataHistory = scope.row.vendor_management_history, historyModal2 = true" :class="'alert  '+ $store.state.Status.find(t => t.id == scope.row.status).notif ">
                                <i class="fa fa-search"> </i>  {{ $store.state.Status.find(t => t.id == scope.row.status ).status }}
                              </a>
                            </template>
                        </el-table-column>
                        <el-table-column fixed="right" label="#" width='50'>
                          <template slot-scope="scope">
                              <el-dropdown>
                                  <span class="el-dropdown-link">
                                    <i class="fa fa-angle-double-down"></i>
                                  </span>
                                  <el-dropdown-menu slot="dropdown">
                                    <a @click="detail(scope.row)"><el-dropdown-item> <i class="fa fa-eye"></i>Detail</el-dropdown-item></a>
                                    <!-- <div v-if="scope.row.read != null">
                                        <a @click="role == 5 ? showDialog(scope.row) : aprove(scope.row)"><el-dropdown-item v-if="((scope.row.status == 3 && scope.row.qsa_part_approve == auth_id) || scope.row.status == 4 || scope.row.status == 8) && scope.row.read.split('|').find(r => r == auth_id)"><i class="fa fa-check"></i> Approve</el-dropdown-item></a>
                                        <a @click="reject(scope.row)"><el-dropdown-item v-if="((scope.row.status == 3 && scope.row.qsa_part_approve == auth_id) || scope.row.status == 4 || scope.row.status == 8) && scope.row.read.split('|').find(r => r == auth_id)"><i class="fa fa-times"></i> Reject</el-dropdown-item></a>
                                        <a @click="ScoreDialog = true, id_request = scope.row.id"><el-dropdown-item v-if="scope.row.read.split('|').find(r => r == auth_id)"><i class="fa fa-calculator"></i> Score Decision</el-dropdown-item></a>
                                    </div> -->
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
        <viewDecision v-if="ScoreDialog == true" :id="id_request" :type="'vendor'"  />
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
              <label class="label-control col-md-3">Reason to GM</label>
              <div class="col-md-9">
                <textarea  class="form-control" v-model="input.note"></textarea>
              </div>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="button" name="button" class="btn btn-primary btn-sm" @click="aprove(input)">Approve</button>
                        <button type="button" name="button" class="btn btn-danger btn-sm" @click="dialogApprove = false">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
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
                  <td><pre>{{ d.note }}</pre></td>
              </tr>
          </tbody>
      </table>
    </el-dialog>
</div>
</template>

<script>
import viewDecision from '../decision/viewDecision'
export default {
    created(){
      this.$store.commit('getStatus');
      this.$store.commit('getMainFn');
    },
    computed: {
        Status() { return this.$store.state.Status } ,
        MainFn() { return this.$store.state.MainFn } ,
    },
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
    },
    components : { viewDecision } ,
    mounted(){
        this.getData() ;
    },
    data() {
        return {
          input : {} ,
          filters : {},
          sort: 'request_number',
          order: 'descending',
          tableData: {},
          page: 1,
          pageSize: 10,
          data: [] , url : BASE_URL + 'submit_vendor' , dialogVisible: false , auth_id : AUTH_LOGIN_ID ,
          datamain : [] , mainform : true, auth_personel : false , documents : false, materials : false, tools : false,
          formReject : false, input : {}, search : '', role_request : ROLE_REQUEST, ScoreDialog : false, role : ROLE,
          dialogApprove : false, input : {}, resubmitDialog : false, dataHistory : [], loading : true, dataHistory : [], historyModal2 : false
        }
    },
    methods: {
        sortChange(c) {
          if (c.prop != this.sort || c.order != this.order) {
                  this.sort = c.prop; this.order = c.order; this.getData()
              }
        },
        showDialog(data){
            this.dialogApprove = true
            this.input = data
        },
        checkScore(id){
          this.ScoreDialog = true
          this.id_request = id
        },
        detail(data){
           axios.get(this.url+'/read/'+data.id).then((res) => {
               this.getData()
               console.log(res.data);
           })
           .catch((err) => {

           })
           window.location.replace(this.url+"/detail/"+data.id)
           // window.open(this.url+"/detail/"+data.id, '_blank')
        },
      aprove(data){
          console.log(data);
          this.$confirm('Are you sure want to approve this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/approve/'+data.id, data).then((res) => {
                console.log(res.data);
                if(res.data.status == 1 ){
                    this.getData();
                    this.$message({
                        type: 'success',
                        message: 'Approve completed'
                    });
                    this.dialogApprove = false
                    this.input = {}
                }else{
                    this.$message({
                        type: 'danger',
                        message: 'That request Already maked like request '+ res.data.request_number
                    });
                }
                loading.close()
            })
            .catch((err) => {
                loading.close()
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
            axios.put(this.url+'/reject/'+data.id, data).then((res) => {
              console.log(res.data);
              this.getData();
              this.formReject = false
              this.$message({
                 type: 'success',
                 message: 'Request Rejected'
               });
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
          order: this.order,
          type : 'Aproval'
        }
          axios.get(this.url, { params: Object.assign(params, this.filters, this.data) }).then((res) => {
              this.tableData = res.data
              console.log(this.tableData);
              this.loading = false
          })
          .catch((err) => {
              this.loading = false
              console.log(err);
          })
      },
      customFormatter(date) {
        return moment(date).format('DD MMMM YYYY');
      },
    },
}
</script>

<style lang="css">
</style>
