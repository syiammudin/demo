<template>
<div class="row" v-if="role == 1">
    <div class="col-lg-12 z-index-50 ">
        <div class="panel minimal panel-default">
            <div class="panel-heading clearfix" >
                <div class="panel-title" style=" font-weight: : bold ;">BAR CHART</div>
                <div class="text-right">
                    Year : <button type="button" class="btn btn-sm" @click="prev()"> << </button> {{ year }} <button type="button" @click="next()" class="btn btn-sm"> >> </button>
                </div>
            </div>
            <!-- panel body -->
            <div class="panel-body">
                <v-chart :options="option"></v-chart >
            </div>
        </div>
    </div>
</div>
</template>

<style>
.echarts {
  width: 100%;
}
</style>

<script>
export default {
  data: function () {
    return {
      url : BASE_URL, role : ROLE,
      option: {}, year : new Date().getFullYear()
    }
  },
  mounted(){
    this.getData()
  },
  methods : {
      prev(){
          this.year = parseInt(this.year)-1 ;
          this.getData()
      },
      next(){
          this.year = this.year + 1 ;
          this.getData()
      },
      getData(){
         axios.get(this.url+'dashboard/1?years='+this.year).then((res) => {
             this.option = {
                 legend: {},
                 color: ['#003366', '#006699', '#4cabce', '#e5323e', '#b5a23e'],
                 tooltip: {
                     trigger: 'axis',
                     axisPointer: {
                         type: 'shadow'
                     },
                 },
                 dataset: {
                     source: res.data
                 },

                 xAxis: {
                        type: 'category',
                        axisTick: {show: false},
                 },
                 yAxis: { type: 'value' },
                 series: [{ type: 'bar' }, { type: 'bar' }, { type: 'bar' }, { type: 'bar' }, { type: 'bar' }]
             }
         })
         .catch((err) => {

         })


      }
  }

}
</script>
