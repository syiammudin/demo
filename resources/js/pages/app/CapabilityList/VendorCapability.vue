<template>
    <div class="">
        <div class="row">
            <div class="col-lg-12  z-index-41">
                <div class="panel panel-default  ">
                    <div class="panel-heading no-border clearfix">
                        <h1 class="page-title">Vendor Capability</h1>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-7"  v-if='role == 5'>
                            <button type="button" class="btn btn-primary btn-sm" name="button" @click="FormDialog = true">Create Capability</button>
                        </div>
                        <el-table :data="tableData.data" style="width: 100%"
                            @sort-change="sortChange" :default-sort="{prop: sort, order: order}"
                            @filter-change="(f) => { let c = Object.keys(f)[0]; filters[c] = Object.values(f[c]); page = 1; getData(); }"
                          >
                            <!-- <el-table-column prop="type_capability_list" label="Type Capability" sortable></el-table-column> -->
                            <el-table-column prop="type_capability_list" label="Capability Type"></el-table-column>
                            <el-table-column sortable prop="issue" label="Issue" align="center"
                            column-key="issue" :filters="issue.map(s => { return {text: Issue[s-1].issue, value: s }})">
                              <template slot-scope="scope">
                                  {{ Issue[scope.row.issue-1].issue }}
                              </template>
                            </el-table-column>
                            <el-table-column prop="revision" label="Revision" align="center"></el-table-column>
                            <el-table-column prop="user.name" label="Created By" align="center"></el-table-column>
                            <el-table-column prop="created_at" label="Date" width="200"></el-table-column>
                            <el-table-column  label="Detail">
                                <template slot-scope="scope">
                                    <!-- <button type="button" class="btn btn-xs btn-primary " @click="DetailDialog = true, dataDetail = scope.row" name="button">Detail</button> -->
                                    <a type="button" class="btn btn-xs btn-primary " :href="url+'/'+scope.row.id+'?type=vendor'" target="_blank" name="button">Detail</a>
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

        <el-dialog :title="'Capability List Vendor '+ dataDetail.type_supplier" :visible.sync="DetailDialog" >
            <a type="button" name="button" class="btn btn-primary btn-sm" :href="url+'/'+dataDetail.id+'?type=vendor'" target="blank"> <i class="fa fa-print"></i> Print </a>
            <table class="table table-striped" style="font-size:8pt">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name vendor</th>
                        <th>Vendor Code</th>
                        <th v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Material Supplier' || dataDetail.type_supplier == 'Repair Station' " >DGCA</th>
                        <th v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Repair Station' ">FAA</th>
                        <th v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Repair Station' ">EASA</th>
                        <th v-if="dataDetail.type_supplier == 'Maintenance Function'">NC</th>
                        <th v-if="dataDetail.type_supplier == 'Calibration'">KAN</th>
                        <th v-if="dataDetail.type_supplier == 'Material Supplier'">ASA</th>
                        <th v-if="dataDetail.type_supplier == 'Calibration' || dataDetail.type_supplier == 'Material Supplier'" >ISO</th>
                        <th v-if="dataDetail.type_supplier == 'Calibration' || dataDetail.type_supplier == 'Material Supplier'" >OTHER</th>
                        <th>Last Update</th>
                        <th v-if="dataDetail.type_supplier == 'Maintenance Function'">Main Fn</th>
                        <th>Product Service</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(d, i)  in dataDetail.vendor_capablity_list_detail" :key="i">
                        <td>{{ (i++) + 1 }}</td>
                        <td>{{ d.supplier_name }} <br> {{ d.address }} <br> {{ d.email }} </td>
                        <td>{{ d.vendor_code }} </td>
                        <td v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Material Supplier' || dataDetail.type_supplier == 'Repair Station' "> <input type="checkbox" name="" disabled :checked="d.dgca == 1 ? true : false ">  </td>
                        <td v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Repair Station' "> <input type="checkbox" name="" disabled :checked="d.faa == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Maintenance Function' || dataDetail.type_supplier == 'Repair Station' "> <input type="checkbox" name="" disabled :checked="d.easa == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Maintenance Function'"> <input type="checkbox" name="" disabled :checked="d.nc == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Calibration'"> <input type="checkbox" name="" disabled :checked="d.kan == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Material Supplier'"> <input type="checkbox" name="" disabled :checked="d.asa == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Calibration' || dataDetail.type_supplier == 'Material Supplier'" > <input type="checkbox" name="" disabled :checked="d.iso == 1 ? true : false "> </td>
                        <td v-if="dataDetail.type_supplier == 'Calibration' || dataDetail.type_supplier == 'Material Supplier'" > <input type="checkbox" name="" disabled :checked="d.other == 1 ? true : false "> </td>
                        <td>{{ d.last_update }} </td>
                        <td v-if="dataDetail.type_supplier == 'Maintenance Function'">
                            {{ d.maint_fn }}
                        </td>
                        <td>{{ d.product_service }} </td>
                    </tr>
                </tbody>
            </table>
        </el-dialog>

        <el-dialog title="Create Capability List" :visible.sync="FormDialog" >
            <div class="form-horizontal">
                <!-- <div class="form-group">
                    <label class="col-md-2 control-label label-control">Type Supplier</label>
                    <div class="col-md-10">
                        <el-select v-model="input.type_supplier" filterable clearable placeholder="Select Supplier Type" >
                            <el-option v-for="item in TypeSupplier" :key="item.type_supplier"
                                :label="item.type_supplier"
                                :value="item.type_supplier">
                            </el-option>
                        </el-select>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-md-2 control-label label-control">Option </label>
                    <div class="col-md-10">
                        <el-select v-model="input.option" filterable clearable placeholder="Select Option" >
                            <el-option label="Issue" value="issue"></el-option>
                            <el-option label="Revision" value="revision"></el-option>
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
    </div>
</template>

<script>
export default {
    created(){
        this.$store.state.type_caplist = 'vendor'
        this.$store.commit('getTypeSupplier');
        this.$store.commit('getIssue');
        this.$store.commit('getshortCaplist');
    },
    computed : {
        TypeSupplier() { return this.$store.state.TypeSupplier } ,
        Issue() { return this.$store.state.Issue } ,
    },
    data() {
        return {
            filters : {},
            page: 1,
            pageSize: 10,
            tableData : {},
            sort: 'id',
            order : 'descending',
            issue : [],
            url : BASE_URL + 'action_capability', data : [], input : {}, DetailDialog : false , dataDetail : [], FormDialog : false,
            base_url : BASE_URL, role : ROLE, err : []
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
        getData(){
            let params = {
              pageSize: this.pageSize,
              page: this.page,
            }
            axios.get(this.url, { params :Object.assign(params, this.filters) }).then((res) => {
                this.tableData = res.data
                this.$store.state.type_caplist = 'vendor'
                this.$store.commit('getshortCaplist');
                this.issue = [...new Set(this.$store.state.shortCaplist.map(x => x.issue))]
            })
            .catch((err) => {

            })
        },
        createCapability(){
            this.input.type = 'vendor'
            this.$confirm('Do you want Create Capability List ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
                axios.post(this.url, this.input).then((res) => {
                    if(res.data.status == 1){
                        this.FormDialog = false
                        this.getData() ;
                        this.input.type_supplier = ''
                        this.$message({
                            type: 'info',
                            message: 'Create Capability List Success'
                        });
                    }else {
                        this.$message({
                            type: 'warning',
                            message: 'Data does not yet exist, Please Make Request First !'
                        });
                    }
                    loading.close()
                })
                .catch((error) => {
                  loading.close()
                  this.err = error.response.data.errors; loading.close()

                })
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Create Capability List Canceled'
                });
            });

            // if(this.input.type_supplier == null || this.input.type_supplier == undefined){
            //     this.$message({
            //         type: 'info',
            //         message: "Type Supplier can't be Null"
            //     });
            // }else{
            //     this.$confirm('Do you want Create Capability List ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
            //         const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
            //         axios.post(this.url, this.input).then((res) => {
            //             if(res.data.status == 1){
            //                 this.FormDialog = false
            //                 this.getData() ;
            //                 this.input.type_supplier = ''
            //                 this.$message({
            //                     type: 'info',
            //                     message: 'Create Capability List Success'
            //                 });
            //             }else {
            //                 this.$message({
            //                     type: 'warning',
            //                     message: 'Data does not yet exist, Please Make Request First !'
            //                 });
            //             }
            //             loading.close()
            //         })
            //         .catch((err) => {
            //             loading.close()
            //
            //         })
            //     }).catch(() => {
            //         this.$message({
            //             type: 'info',
            //             message: 'Create Capability List Canceled'
            //         });
            //     });
            // }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
