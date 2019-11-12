<template id="">
  <div class="col-lg-12 col-md-6 z-index-50 ">
    <div class="panel minimal panel-default" >
        <div class="panel-heading clearfix" >
            <div class="panel-title"><b>Vendor by Type Supplier</b></div>

        </div>
        <!-- panel body -->
        <div class="panel-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Data</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(d,i) in dataVendor" :key="i">
                      <td>{{ d.name }}</td>
                      <td>{{ d.value }}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">Total</td>
                    <td style="font-weight:bold;">{{ dataVendor.length }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  export default {
    data(){
      return {
        url : BASE_URL,
        dataVendor : [],
        type_supplier : []
      }
    },
    mounted(){
        this.getData()
    },
    methods : {
      getData(){
        axios.get(this.url+'/dashboard/vendor/1').then((res) => {
          var type_supplier = [...new Set(res.data.map(x => x.type_supplier))]
          var data = []
          for (var i = 0; i < type_supplier.length; i++) {
            data.push({
              name : type_supplier[i],
              value : res.data.filter(f => f.type_supplier == type_supplier[i] ).length
            })
          }

          this.dataVendor = data
          this.type_supplier = type_supplier

        })

      }
    }
  }
</script>
