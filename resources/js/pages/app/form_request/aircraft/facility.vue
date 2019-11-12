<template >
<div >
    <el-button @click="addSub()"  size="mini" icon="fa fa-add " round > Add Sub </el-button>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <td style="padding:5px">
                    <template>
                      <el-select
                        v-model="input.description_main"
                        filterable
                        allow-create
                        default-first-option
                        placeholder="Choose tags for your article">
                        <el-option
                          v-for="item in data"
                          :key="item.description"
                          :label="item.description"
                          :value="item.description">
                        </el-option>
                      </el-select>
                    </template>
                </td>
                <td style="padding:5px"> <input style="width:80px ;" type="number" placeholder="QTY" class="form-control" v-if="list_sub.length == 0" v-model="input.quantity"> </td>
                <td style="padding:5px"> <input style="width:120px;" type="text" placeholder="Unit" class="form-control" v-if="list_sub.length == 0" v-model="input.unit"> </td>
                <td style="padding:5px"> <input style="width:120px;" type="text" placeholder="Status" class="form-control" v-if="list_sub.length == 0" v-model="input.status"> </td>
                <td style="padding:5px"> <input style="width:350px;" type="text" placeholder="Remark" class="form-control" v-if="list_sub.length == 0" v-model="input.remark"> </td>
            </tr>
            <tr v-for="(sub, i) in list_sub" :key="i">
                <div class="hidden"> {{ sub.description_main = input.description_main}} </div>
                <td style="padding:5px"> <input style="width:250px;" type="text" placeholder="Sub Desciption" class="form-control" v-model="sub.description"> </td>
                <td style="padding:5px"> <input style="width:80px ;" type="number" placeholder="Qty" class="form-control" v-model="sub.quantity"> </td>
                <td style="padding:5px"> <input style="width:120px;" type="text" placeholder="Unit" class="form-control" v-model="sub.unit"> </td>
                <td style="padding:5px"> <input style="width:120px;" type="text" placeholder="Status" class="form-control" v-model="sub.status"> </td>
                <td style="padding:5px"> <input style="width:350px;" type="text" placeholder="Remark" class="form-control" v-model="sub.remark"> </td>
                <td> <a @click="del(i)"><i class="fa fa-minus"></i> </a> </td>
            </tr>
        </table>
    </div>
    <el-button @click="addFacilities()" type='primary' size="mini" icon="fa fa-add " round > Add facility </el-button>
</div>
</template>

<script>
export default {
    props : ['list_facilities'],
    data() {
        return{
            list_sub : [] , input : {}, data : [], url : BASE_URL
        }
    },
    mounted(){
        this.getData() ;
    },
    methods : {
        addSub(){
            if(this.input.description_main == null || this.input.description_main == undefined ){
                this.$alert('Please Fill Main Desciption First ?', 'Warning', {
                    confirmButtonText: 'OK',
                });
            }else{
                this.list_sub.push({
                    description : '',
                    quantity : '',
                    unit : '',
                    status : '',
                    remark : '',
                })
            }
        },
        addFacilities(){
            if(this.input.description_main == null || this.input.description_main == undefined ){
                this.$alert('Please Fill Main Desciption First ?', 'Warning', {
                    confirmButtonText: 'OK',
                });
            }else{
                axios.post(this.url+'submit_aircraft/facilities', this.input).then((res) => {
                    if(this.list_sub.length == 0){
                        this.input.description = null
                        this.input.type = 'no_sub'
                        this.$emit('add', this.input)
                        this.input = {}
                    }else{
                        this.$emit('add', this.list_sub )
                        this.input = {}
                        this.list_sub = []
                    }
                })
                .catch((err) => {

                })
            }
        },
        del(i){
             this.list_sub.splice(i, 1)
        },
        getData(){
            axios.get(this.url+'store/facilities/data').then((res) => {
                this.data = res.data.filter(data => this.list_facilities.findIndex(a => a.description_main == data.description && a.description == null) == -1)
            })
            .catch((err) => {

            })
        }
    }
}
</script>

<style lang="css" scoped>
.hidden {
    display: none ;
}
</style>
