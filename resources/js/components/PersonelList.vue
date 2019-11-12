<template>
    <div class="">
        <!-- <div class="col-md-12 radio radio-replace radio-success">
            <div class="col-md-6">
                <input type="radio" v-model="input.request_type" selected name="request_type" value="Add" >
                <label for="radio6">Amel License</label>
            </div>
            <div class="col-md-6">
                <input type="radio" v-model="input.request_type" name="request_type" value="Change" >
                <label for="radio6">CS License</label>
            </div>
        </div> -->

        <el-input v-model="search" placeholder="Type to search"/>
        <br>
        <br>
        <table class="table table-condensed table-striped" v-loading="loading">
        <tbody>
            <tr v-for="(p, i) in filteredPersonels.slice((page-1)*10, 10*page)" :key="i">
                <td>{{ p.nama }}</td>
                <td>{{ p.nopeg }}</td>
                <td>{{ p.jabatan }}</td>
                <td> <el-button type="success" size="mini"  @click="addPersonel(p)" icon="fa fa-plus" circle></el-button> </td>
            </tr>
        </tbody>
        </table>
        <el-pagination
            background
            layout="prev, pager, next"
            :page-size="10"
            @current-change="nextPage"
            :total="filteredPersonels.length">
        </el-pagination>
    </div>
</template>

<script>
export default {
    props :['id','type_personel','list_personel'],
    computed: {
        filteredPersonels() {
            return this.personels.filter(data => !this.search || data.nama.toLowerCase().includes(this.search.toLowerCase()) || data.nopeg.toLowerCase().includes(this.search.toLowerCase()) || data.jabatan.toLowerCase().includes(this.search.toLowerCase()))
                    .filter(data => data.status = 'Active')
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
            url : BASE_URL
        }
    },
    methods: {
        nextPage(page) {
            this.page = page
            console.log(page);
        },
        addPersonel(p) {
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });
            axios.get(this.url+'store/full_user_soe/'+p.nopeg).then((res) => {
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

                if(res.data['gmfauth'][0][0]){
                    data['gmf_auth_number'] = res.data['gmfauth'][0][0]['lic_no'] ;
                    data['gmf_ex_date'] = res.data['gmfauth'][0][0]['valid_until'] ;
                }else{
                    data['gmf_auth_number'] = null ;
                    data['gmf_ex_date'] = null ;
                }

                if(res.data['amel'][0][0]){
                    data['amel_license'] = res.data['amel'][0][0]['lic_no'] ;
                    data['amel_ex_date'] = res.data['amel'][0][0]['valid_until'] ;
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

            })
            .catch((err) => {
                console.log(err);
            })
        },
        getData(){

            this.loading = true
            axios.get(BASE_URL + 'store/user_soe/1').then((res) => {
                this.personels = res.data
                this.loading = false
            }).catch(e => {
                console.log(e);
                this.loading = false
            })
        }
    }
}
</script>

<style lang="css">
</style>
