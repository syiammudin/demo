<template >
  <div class="">
      <div class="form-group">
          <label class="col-sm-3 control-label">FOR RATING</label>
          <div class="col-sm-9 checkbox checkbox-replace checkbox-success">
              <div class="col-md-3" v-for='(f, i) in ForRating' :key="i" >
                  <input type="checkbox"  class="form-control"  v-model="rating[f.name_of_rating]">
                  <label for="checkbox6">{{ f.name_of_rating }} </label>
                  <el-select v-if="rating[f.name_of_rating] == true"  v-model="rating[i]" filterable clearable placeholder="Select Aircraft Type" >
                      <el-option v-for="item in $store.state.ForRating.find(t => t.id == f.id).desciption.split(',')" :key="item"
                          :label="item"
                          :value="item">
                      </el-option>
                      <!-- <input v-if="rating[f.name_of_rating] == true" type="hidden" class="form-control"  v-model="rating[i+'_name'] =  f.name_of_rating"> -->
                  </el-select>
              </div>
              <div class="col-lg-12">
              </div>
          </div>
      </div>

      <button type="button"  name="button" @click='test()'>test </button>
  </div>
</template>

<script>
export default {
    data() {
        return {
            rating : {}
        }
    },
    computed: {
        ForRating() { return this.$store.state.ForRating } ,
    },
    created() {;
        this.$store.commit('getForRating');
    },
    methods : {
        test(){
            console.log(this.rating);
        }
    }
}
</script>

<style lang="css" scoped>
</style>
