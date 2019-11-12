<template >
<div class="">
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Component Capability</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-7" v-if='role == 5'>
                        <button type="button" class="btn btn-primary btn-sm" name="button" @click="FormDialog = true">Create Capability</button>
                    </div>
                    <el-table :data="tableData.data" style="width: 100%"
                      @sort-change="sortChange" :default-sort="{prop: sort, order: order}"
                      @filter-change="(f) => { let c = Object.keys(f)[0]; filters[c] = Object.values(f[c]); page = 1; getData(); }"
                    >
                        <el-table-column prop="type_capability_list" label="Type Capability" ></el-table-column>
                        <el-table-column sortable column-key="authority" prop="authority" label="Authority" align="center"
                          :filters="authorityFilter.map(s => { return {text: s, value: s }})"
                        ></el-table-column>
                        <el-table-column sortable column-key="issue" prop="issue" label="Issue" align="center"
                          :filters="issueFilter.map(s => { return {text: Issue[s-1].issue, value: s }})"
                        >
                          <template slot-scope="scope">
                              {{ Issue[scope.row.issue-1].issue }}
                          </template>
                        </el-table-column>
                        <el-table-column prop="revision" label="Revision" align="center"></el-table-column>
                        <el-table-column prop="form_type" label="Form Type" align="center"></el-table-column>
                        <el-table-column prop="user.name" label="Created By" align="center"></el-table-column>
                        <el-table-column prop="created_at" label="Date" width="200"></el-table-column>
                        <el-table-column  label="Detail">
                            <template slot-scope="scope">
                                <!-- <a :href="url+'/'+scope.row.id+'?type=component'" target="_blank" class="btn btn-primary btn-xs">Detail</a> -->
                                <button type="button" class="btn btn-xs btn-primary " @click="DetailDialog = true, dataDetail = scope.row, type = scope.row.form_type, authority = scope.row.authority, issue = Issue[scope.row.issue-1].issue " name="button">Detail</button>
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

    <el-dialog title="Create Capability List" :visible.sync="FormDialog" >
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-2 control-label label-control">Authority</label>
                <div class="col-md-10">
                    <el-select v-model="input.authority" filterable clearable placeholder="Select Authority" >
                        <el-option v-for="item in ForRating" :key="item.name_of_rating"
                            :label="item.name_of_rating"
                            :value="item.name_of_rating">
                        </el-option>
                    </el-select>
                    <span v-if="err.authority" class="text-danger"> {{ err.authority[0] }}</span>
                </div>
                <input type="hidden" name=""  v-model="input.form_type">
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label label-control">Option </label>
                <div class="col-md-10">
                    <el-select v-model="input.option" filterable clearable placeholder="Select Option" >
                        <el-option label="Issue" value="issue"></el-option>
                        <el-option label="Revision" value="revision"></el-option>
                        <el-option label="Temporary Revision" value="temporary"></el-option>
                        <el-option label="EkstractTo Excel" value="ekstractExcel"></el-option>
                    </el-select>
                    <span v-if="err.option" class="text-danger"> {{ err.option[0] }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                    <button type="button" name="button" class="btn btn-primary btn-sm" @click="createCapability">Generate</button>
                </div>
            </div>
        </div>
    </el-dialog>

    <el-dialog :title="'Capability List '+authority " width="70%" :visible.sync="DetailDialog" >
        <div class="col-md-6 text-left">
            Issue : {{ issue }}
        </div>
        <div class="col-md-6 text-right">
            Revision : {{ dataDetail.revision }}
        </div>
        <br>
        <br>
        <DGCA v-if='DetailDialog == true && type == 1' :dataDetail="dataDetail" :type="type" />
        <FAA  v-if='DetailDialog == true && type == 2' :dataDetail="dataDetail" :type="type" />
        <EASA v-if='DetailDialog == true && type == 3' :dataDetail="dataDetail" :type="type" />
        <CAAM v-if='DetailDialog == true && type == 4' :dataDetail="dataDetail" :type="type" />
        <CAAC v-if='DetailDialog == true && type == 5' :dataDetail="dataDetail" :type="type" />
        <CAAS v-if='DetailDialog == true && type == 6' :dataDetail="dataDetail" :type="type" />
        <CAAP v-if='DetailDialog == true && type == 7' :dataDetail="dataDetail" :type="type" />
    </el-dialog>
</div>
</template>

<script>
import DGCA from './DetailComponent/componentdgca'
import EASA from './DetailComponent/componenteasa'
import CAAM from './DetailComponent/componentcaam'
import CAAP from './DetailComponent/componentcaap'
import FAA from './DetailComponent/componentfaa'
import CAAC from './DetailComponent/componentcaac'
import CAAS from './DetailComponent/componentcaas'
export default {
    components : { DGCA, EASA, CAAM, CAAP, FAA, CAAC, CAAS },
    created(){
        this.$store.commit('getForRating');
        this.$store.commit('getIssue');
        this.$store.state.type_caplist = 'component'
        this.$store.commit('getshortCaplist');
    },
    computed : {
        ForRating() { return this.$store.state.ForRating } ,
        Issue() { return this.$store.state.Issue } ,
    },
    watch : {
        'input.authority' : function(v, o){
            if(!v){
                return
            }
            this.input.form_type = this.$store.state.ForRating.find(f => f.name_of_rating === v).form_type
        }
    },
    data() {
        return {
            filters : {},
            page: 1,
            pageSize: 10,
            tableData : {},
            sort: 'id',
            order: 'descending',
            url : BASE_URL + 'action_capability',  input : {}, DetailDialog : false , dataDetail : [], FormDialog : false, id : '',
            base_url : BASE_URL, role : ROLE, type : '', authority : '', err : [], issue : '',
            authorityFilter : [] ,
            issueFilter : []
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        sortChange(c) {
          if (c.prop != this.sort || c.order != this.order) {
                  this.sort = c.prop; this.order = c.order; this.getData()
              }
        },
        detail(id, rating){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
            axios.get(this.url+'/exportexcel/'+id+'?rating='+rating).then((res) => {
                loading.close()
            })
            .catch((err) => {
                loading.close()
            })
        },
        getData(){
            let params = {
              pageSize: this.pageSize,
              page: this.page,
              sort: this.sort,
              order: this.order
            }
            axios.get(this.url+'?type=component', { params :Object.assign(params, this.filters) }).then((res) => {
                this.tableData = res.data
                this.$store.state.type_caplist = 'component'
                this.$store.commit('getshortCaplist');
                this.authorityFilter = [...new Set(this.$store.state.shortCaplist.map(x => x.authority))]
                this.issueFilter = [...new Set(this.$store.state.shortCaplist.map(x => x.issue))]
            })
            .catch((err) => {

            })
        },
        createCapability(){
          if(this.input.option == 'temporary'){
              axios.get(this.url+'/temporary/1?type=cek&authority='+this.input.authority).then((res) => {
                  if(res.data.status == 0){
                      this.$alert("No New Data or Change "+this.input.authority+" in the Master Configs Table", 'Warning', { confirmButtonText: 'OK', });
                      return
                  }
                  this.FormDialog = false
                  window.open(this.url+"/temporary/1?authority="+this.input.authority, '_blank')
                  this.input = {}
              }).
              catch((err) => {
                  console.log(err);
              })
          }else if(this.input.option == 'ekstractExcel'){
              axios.get(this.url+'/ekstractExcel/1?type=cek&authority='+this.input.authority).then((res) => {
                  if(res.data.status == 0){
                      this.$alert("No New Data or Change "+this.input.authority+" in the Master Configs Table", 'Warning', { confirmButtonText: 'OK', });
                      return
                  }
                  this.FormDialog = false
                  window.open(this.url+"/temporary/1?authority="+this.input.authority, '_blank')
                  this.input = {}
              }).
              catch((err) => {
                  console.log(err);
              })
          }else{
              this.input.type = 'component'
              this.$confirm('Do you want Create Capability List ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
                axios.post(this.url, this.input).then((res) => {
                  console.log(res.data);
                  if(res.data.status == 1){
                    this.input.type_supplier = {}
                    this.$message({
                      type: 'success',
                      message: 'Create Capability List Success'
                    });
                  }else{
                    this.$message({
                      type: 'error',
                      message: 'Data with authority '+ this.input.authority +' does not yet exist, Please Make Request First !'
                    });
                  }
                  this.FormDialog = false
                  this.input = {}
                  loading.close()
                  this.getData()
                })
                .catch((error) => {
                  loading.close()
                  this.err = error.response.data.errors; loading.close()

                })
              }).catch(() => {
                this.$message({
                  type: 'danger',
                  message: 'Create Capability List Canceled'
                });
              });
          }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
