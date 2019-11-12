<template >
<div class="" >
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Request Engine</h1>
                </div>
                <div class="panel-body">
                  <div class="col-md-7">
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
                        <el-table-column prop="request_number" label="No Request" sortable></el-table-column>
                        <el-table-column prop="request_type" label="Request Type"></el-table-column>
                        <el-table-column prop="part_number" label="Part Number"></el-table-column>
                        <el-table-column prop="aircraft_type" label="Aircraft Type"></el-table-column>
                        <el-table-column prop="ata_chapter" label="ATA Chapter"></el-table-column>
                        <el-table-column prop="created_at" label="Date"></el-table-column>
                        <el-table-column column-key="status" :filters="$store.state.Status.filter(f => f.id != 7).map(s => { return {text: s.status, value: s.id} })" sortable prop="status" fixed="right"  label="Status" width="200" header-align="center" align='center'>
                            <template slot-scope="scope">
                                <a @click="histories(scope.row)" :class="'alert  '+ $store.state.Status.find(t => t.id == scope.row.status).notif ">
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
                                    <a @click="resubmitDialog = true, id = scope.row.id" v-if="scope.row.step_request_type == 're-Submit'"><el-dropdown-item> <i class="fa fa-file-o"></i>Note Resubmit</el-dropdown-item></a>
                                    <!-- <div v-if="scope.row.status_read != null">
                                      <a @click="aprove(scope.row)"><el-dropdown-item v-if="((scope.row.status == 3 && scope.row.qsa_part_approve == auth_id) || scope.row.status == 4) && scope.row.status_read.split('|').find(r => r == auth_id)"><i class="fa fa-check"></i> Aprove</el-dropdown-item></a>
                                      <a @click="reject(scope.row)"><el-dropdown-item v-if="((scope.row.status == 3 && scope.row.qsa_part_approve == auth_id) || scope.row.status == 4) && scope.row.status_read.split('|').find(r => r == auth_id)"><i class="fa fa-times"></i> Reject</el-dropdown-item></a>
                                         <a @click="checkScore(scope.row.id)"><el-dropdown-item v-if="scope.row.status_read.split('|').find(r => r == auth_id)"><i class="fa fa-calculator"></i> Score Decision</el-dropdown-item></a>
                                    </div> -->
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
        <viewDecision v-if="ScoreDialog == true" :id="id_request" />
    </el-dialog>

    <el-dialog title="Note Resubmit " :visible.sync="resubmitDialog" >
        <resubmit v-if="resubmitDialog == true" :id="id" type="engine"/>
   </el-dialog>
   <el-dialog title="Note" :visible.sync="historyModal" >
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
import resubmit from './../RequestList/viewResubmitnote'
export default {
    created(){
      this.$store.commit('getStatus');
    },
    computed : {
      Status() { return this.$store.state.Status } ,
      filteredList() {
          return this.data.map(d => {
                      d.status_name = this.$store.state.Status.find(t => t.id == d.status).status
                      return d
                  }).filter(data => !this.search
                                  || data.request_number.toLowerCase().includes(this.search.toLowerCase())
                                  || data.status_name.toLowerCase().includes(this.search.toLowerCase())
                                  || data.created_at.toLowerCase().includes(this.search.toLowerCase())
                                  || data.request_type.toLowerCase().includes(this.search.toLowerCase())
                                  || (data.engine_request.ata_chapter != null && data.engine_request.ata_chapter.toLowerCase().includes(this.search.toLowerCase()))
                                  || (data.engine_request.aircraft_type != null && data.engine_request.aircraft_type.toLowerCase().includes(this.search.toLowerCase()))
                              )
      }
    },
    components : { viewDecision, resubmit },
    mounted(){
        this.getData() ;
    },
    data() {
        return {
          filters : {},
          sort: 'request_number',
          order: 'descending',
          tableData: {},
          page: 1,
          pageSize: 10,
          data: [] , url : BASE_URL + 'submit_engine' , dialogVisible: false , auth_id : AUTH_LOGIN_ID , search : '',
          datamain : [] , mainform : true, auth_personel : false , documents : false, materials : false, tools : false,
          formReject : false, input : {}, role_request : ROLE_REQUEST, ScoreDialog : false, resubmitDialog : false, id : '',
          historyModal : false, dataHistory : [], loading : true
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
          const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
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
          this.$confirm('Are you sure want to approve this Request ?', 'Notify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/approve/'+data.id).then((res) => {
                console.log(res.data);
                if(res.data.status == 1 ){
                    this.getData();
                    this.$message({
                        type: 'success',
                        message: 'Approve completed'
                    });
                }else if(res.data.status == 2 ){
                    this.getData();
                    this.$alert('Part Number with number '+ res.data.note +' Already used Please remove Part Number', 'Redudance Data', {
                      confirmButtonText: 'OK',
                      callback: action => {
                        this.$message({
                          type: 'info',
                          message: `action: ${ action }`
                        });
                      }
                    });
                }else{
                    this.$message({
                        type: 'danger',
                        message: 'That request Already maked like request '+ res.data.request_number
                    });
                }
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
          axios.get(this.url, { params: Object.assign(params, this.filters) }).then((res) => {
              this.tableData = res.data
              this.loading = false
          })
          .catch((err) => {
              this.loading = false
              console.log(err);
          })
      },
    },
}
</script>

<style lang="css">
</style>
