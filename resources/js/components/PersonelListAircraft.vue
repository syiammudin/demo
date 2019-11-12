<template>
    <div class="form-horizontal" v-loading="loading">
        <div class="form-group" >
            <label class="col-md-3">License Type</label>
            <div class="col-md-6">
              <select class="form-control" v-model="input.license_type" placeholder="License Type">
                <option value="amel" >AMEL Holder </option>
                <option value="cs" >CS Holder</option>
              </select>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div class="form-group" >
          <label class="col-md-3">Unit</label>
          <div class="col-md-6">
            <el-input placeholder="Unit" v-model="unit" class="input-with-select">
              <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-md-3">Stamp No</label>
          <div class="col-md-6">
            <el-input placeholder="Stamp No" v-model="stamp" class="input-with-select">
              <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
          </div>
        </div>
        <div class="form-group" >
              <label class="col-md-3">Search</label>
              <div class="col-md-6">
              <el-input placeholder="Search" v-model="search" class="input-with-select">
                <el-button slot="append" icon="el-icon-search"></el-button>
              </el-input>
            </div>
        </div>

        <br>
        <br>
        <div class="text-center" v-if="errorMessage != null">
          <p> {{ this.errorMessage }} </p>
          <br>
          <el-button type='primary' icon='el-icon-refresh' @click="getData()"> Reload </el-button>
        </div>
        <div v-else>
          <table class="table table-condensed table-striped" >
            <thead>
              <tr>
                <td style="width:10px;">
                  <input type="checkbox" v-model="selectAll" @click="select()">
                </td>
                <td> Name</td>
                <td> Nopeg </td>
                <td> Unit </td>
                <td> Stamp No </td>
                <td > Amel Scope </td>
                <td  v-if="input.license_type == 'cs'"> GMF Auth Scope </td>
                <td> Position </td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(p, i) in filteredPersonels.slice((page-1)*20, 20*page)" :key="i">
                <td> <input type="checkbox" :value="p" v-model="selected"> </td>
                <td>{{ p.nama }}</td>
                <td>{{ p.nopeg }}</td>
                <td>{{ p.unit }}</td>
                <td>{{ p.stamp_no }}</td>
                <td style="font-size : 8pt">
                  <ul>
                    <li v-for="(amel, i) in p.amel.amel_scope" :key="i">{{ amel.scp_descrip }}</li>
                  </ul>
                </td>
                <td style="font-size : 8pt" v-if="input.license_type == 'cs'">
                  <ul>
                    <li v-for="(gmf, i) in p.gmf_auth.filter(d => d.lic_type == 'CS')" :key="i">{{ gmf.scopegmfauth.scp_descrip }}</li>
                  </ul>
                </td>
                <td>{{ p.jabatan }}</td>
                <!-- <td> <el-button type="success" size="mini"  @click="addPersonel(p)" icon="fa fa-plus" circle></el-button> </td> -->
              </tr>
            </tbody>
          </table>
          <div class="row">
            <el-pagination class="col-md-10"
                background
                layout="prev, pager, next"
                :page-size="20"
                @current-change="nextPage"
                :total="filteredPersonels.length">
            </el-pagination>
            <div class="col-md-2">
                <button type="button" name="button" class="btn btn-sm btn-primary" @click="addAll()"> Add </button>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    props :['type_personel','list_auth_personel'],
    computed: {

        filteredPersonels() {
          return this.personels
              .filter(m => m.unit.toLowerCase().includes(this.unit.toLowerCase()))
              .map(d => {
                if (d.amel.amel_scope) {
                    d.amel_scope = d.amel.amel_scope.map(a => a.scp_descrip)
                    d.amel_no = d.amel.lic_no
                    d.ex_date_ame = d.amel.valid_until
                } else {
                    d.amel_scope = [];
                    d.amel_no = ''
                    d.ex_date_ame = ''
                }
                if(d.stamp.stamp_no){
                  d.stamp_no = d.stamp.stamp_no
                }else{
                  d.stamp_no = ''
                }
                if (d.gmf_auth.length > 0) {
                  d.gmf_scope = d.gmf_auth.map(a => a.scopegmfauth.scp_descrip)
                  d.gmf_auth_number = d.gmf_auth[0].lic_no
                  d.ex_date_company = d.gmf_auth[0].valid_until

                } else {
                  d.gmf_scope = [];
                  d.gmf_auth_number = ''
                  d.ex_date_company = ''
                }
                return d;
            })
            .filter(m => m.stamp_no.toLowerCase().includes(this.stamp.toLowerCase()) )
            .filter(m =>
                  m.amel_scope.find(s => s.toLowerCase().includes(this.search.toLowerCase()))
                  || m.gmf_scope.find(s => s.toLowerCase().includes(this.search.toLowerCase()))
                  || m.nama.toLowerCase().includes(this.search.toLowerCase())
                  || m.nopeg.toLowerCase().includes(this.search.toLowerCase())
                  || m.jabatan.toLowerCase().includes(this.search.toLowerCase())
                  || m.unit.toLowerCase().includes(this.search.toLowerCase())
            )
            .filter(data => this.list_auth_personel.findIndex(a => a.personal_number == data.nopeg) == -1)
            .filter(data => this.input.license_type == 'amel' ? data.amel.length != 0 :  this.input.license_type == 'cs' ? (data.amel.length != 0 && data.gmf_auth.length != 0) : '')
            .filter(data => data.status = 'Active')
        }
    },
    watch: {
        'input.license_type' : function (v, o) {
            this.selected = []
        }
      },
    mounted() {
      this.getData()
    },
    data() {
        return {
            input : {},
            search: '',
            personels: [],
            loading: true,
            page: 1,
            url : BASE_URL,
            selected : [],
            data : [],
            selectAll : false,
            unit : '',
            errorMessage : null,
            stamp : ''
        }
    },
    methods: {
        select() {
          this.selected = [];
          if (!this.selectAll) {
            for (let i in this.filteredPersonels) {
              this.selected.push(this.filteredPersonels[i]);
            }
          }
        },
        addAll(){
            if(this.selected.length == 0){
                this.$alert('Please select personel first', 'Warning', {
                    confirmButtonText: 'OK',
                });
            }else{
                this.selected['license_type'] = this.input.license_type
                this.$emit('add', this.selected)
                this.search = ''
                this.unit = ''
                this.stamp = ''
                this.selected = []
                this.selectAll = false
                this.input = {}
            }
        },
        nextPage(page) {
            this.page = page
        },
        addPersonel(p) {
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });
            var data = [] ;
            data['full_name'] = p.nama ;
            data['personel_number'] = p.nopeg ;
            data['unit_code'] = p.unit ;
            data['position_name'] = p.jabatan ;
            data['email'] = p.email ;
            data['unit'] = p.unit ;

            if(res.data['genlic'][0][0]){
                data['empl_id'] = res.data['genlic'][0][0]['empl_id'] ;
                data['genlic'] = res.data['genlic'][0][0]['genlic']  ;
            }else{
                data['empl_id'] = null ;
                data['genlic'] = null  ;
            }

            if(p.gmf_auth){
                data['gmf_auth_number'] = p.gmf_auth.lic_no ;
                data['gmf_ex_date'] = p.gmf_auth.valid_until ;
            }else{
                data['gmf_auth_number'] = null ;
                data['gmf_ex_date'] = null ;
            }

            if(p.amel){
                data['amel_license'] = p.amel.lic_no ;
                data['amel_ex_date'] = p.amel.valid_until ;
            }else{
                data['amel_license'] = null ;
                data['amel_ex_date'] = null ;
            }

            if(res.data['scopegmfauth'][0][0]){
                data['scp_descrip'] = res.data['scopegmfauth'][0][0]['scp_descrip'] ;
            }else{
                data['scp_descrip'] = null ;
            }
            if(this.type_personel == 'qualified_personel'){
                this.$emit('addQualifiedPersonel', data)
            }else{
                this.$emit('add', data)
            }

            loading.close()
        },
        getData(){
            this.loading = true
            axios.get(BASE_URL + 'store/user_soe/1').then((res) => {
                this.personels = res.data
            })
            .catch((err) => {
              if(err.response.data.message.includes('cURL error 28')){
                 this.errorMessage = 'Request Time out, Please Reload'
              }
              if(err.response.data.message.includes('cURL error 7')){
                 this.errorMessage = 'No Connection to Data Api, Please Contact Team TO for check this problem'
              }
            }).finally(() => {
              this.loading = false
            })
        }
    }
}
</script>

<style lang="css">
</style>
