<template>
<div class="form-horizontal">
    <div class="form-group">
        <label class="label-control col-lg-3">Part Number</label>
        <div class="col-lg-9">
            <el-select onloadedmetadata="" v-model="input.part_number"   filterable clearable placeholder="Select Part Number" >
                <el-option v-for="(pn, i) in PartNumber " :key="i" :label="pn.part_number+' | ' +pn.part_description" :value="pn.part_number"> </el-option>
            </el-select>
            <!-- <input type="text" class="form-control" v-model="input.part_number" placeholder="Part Number" > -->
            <span v-if="err.part_number" > {{ err.part_number[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">Part Desciption</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" readonly v-model="input.part_description" placeholder="Part Desciption">
            <span v-if="err.part_description" > {{ err.part_description[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">QTY</label>
        <div class="col-lg-9">
            <input type="number" class="form-control" v-model="input.qty" placeholder="Qty">
            <span v-if="err.qty" > {{ err.qty[0] }}</span>
        </div>
    </div>

    <div class="line-dashed"> </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <el-button @click="id_material == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ id_material == null ? 'Add' : 'Update' }} </el-button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['id','id_material','index_material'],
    watch : {
        'input.part_number' : function(v, o){
          if(!v){
            return
          }
          this.input.part_description = this.$store.state.PartNumber.find(pn => pn.part_number === v).part_description
        }
    },
    computed: {
        PartNumber() { return this.$store.state.PartNumber } ,
    },
    created() {
        this.$store.commit('getPartNumber');
    },
    data() {
        return {
            url : BASE_URL + 'submit_componentMaterialPlanning' ,  attach : {} ,fileList : [] , err : [] ,
            input : {},

        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        getData(){
            if(this.id_material != null){
                axios.get(this.url+'/'+this.id_material).then(res =>{
                    this.input = res.data
                    this.input.part_number = res.data.part_number
                    console.log(res.data);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        save(){
            this.input.request_submittion_id = this.id
            axios.post(this.url, this.input).then((res) => {
                console.log(res.data);
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                    this.fileList = []
                    res.data.data.index = null
                    this.input = {}
                    this.$emit('addMaterialPlanning', res.data.data )
                }else{
                    this.$alert(res.data.message, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors
            })
        },
        update(){
            this.input.request_submittion_id = this.id
            axios.put(this.url+'/'+this.id_material, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Update '+this.input.name+' Success'  });
                    this.fileList = []
                    res.data.data.index = this.index_material
                    this.$emit('addMaterialPlanning', res.data.data )
                    this.input = {}
                }else{
                    this.$alert(res.data.message, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors
            })
        }
    }
}
</script>

<style lang="css">
</style>
