<template id="">
<div class="" v-loading="loading">
  <div class="form-group">
    <el-select v-model="unit" filterable clearable placeholder="Select Unit" >
      <el-option v-for="item in data" :key="item"
      :label="item"
      :value="item">
    </el-option>
  </el-select>
  </div>
  <div class="form-group text-center">
      <button type="button" class="btn btn-primary btn-sm" @click="add">Add</button>
  </div>
</div>
</template>

<script type="text/javascript">
  export default {
      props : ['unit_selected'],
      data() {
        return {
            data : [], base_url : BASE_URL, unit : '', loading : true
        }
      },
      mounted(){
        this.getSoe();
      },
      methods : {
        add(){
            this.$emit('unit', this.unit)
        },
        getSoe(){
            axios.get(this.base_url+'store/user_soe/1').then(res => {
                let data = [...new Set(res.data.map(x => x.unit))]
                if(this.unit_selected != undefined){
                    this.unit = this.unit_selected
                }
                this.data =  data.filter(f => f != '')
                this.loading = false
            })
            .catch(error => {

            })
        },
      }
  }
</script>
