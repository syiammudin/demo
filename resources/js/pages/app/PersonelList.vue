<template>
    <div class="">

        <el-input v-model="search" placeholder="Type to search"/>
        <br>
        <br>
        <table class="table table-condensed table-striped" v-loading="loading">
        <tbody>
            <tr v-for="(p, i) in filteredPersonels.slice((page-1)*10, 10*page)" :key="i">
                <td>{{ p.full_name }}</td>
                <td>{{ p.personel_number }}</td>
                <td>{{ p.position_name }}</td>
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
    computed: {
        filteredPersonels() {
            return this.personels.filter(data => !this.search || data.full_name.toLowerCase().includes(this.search.toLowerCase()) || data.personel_number.toLowerCase().includes(this.search.toLowerCase()))
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
            axios.get(this.url+'store/full_user_soe/'+p.personel_number).then((res) => {
                const employee = JSON.parse(res.data.employee)
                const scope = JSON.parse(res.data.scope)

                var data = [] ;
                data['full_name'] = p.full_name ;
                data['personel_number'] = p.personel_number ;
                data['unit_code'] = p.unit_code ;
                data['position_name'] = p.position_name ;
                if(scope['genlic'][0][0]){
                    data['empl_id'] = scope['genlic'][0][0]['empl_id'] ;
                    data['genlic'] = scope['genlic'][0][0]['genlic']  ;
                }else{
                    data['empl_id'] = null ;
                    data['genlic'] = null  ;
                }
                if(scope['amel'][0][0]){
                    data['amel_license'] = scope['amel'][0][0]['lic_no'] ;
                    data['amel_ex_date'] = scope['amel'][0][0]['valid_until'] ;
                }else{
                    data['amel_license'] = null ;
                    data['amel_ex_date'] = null ;
                }

                this.$emit('add', data)

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
