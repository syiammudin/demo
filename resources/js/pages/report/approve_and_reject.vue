<template id="">
  <div class="col-lg-12 col-md-6 z-index-50 ">
    <div class="panel minimal panel-default" >
        <div class="panel-heading clearfix" >
            <div class="panel-title"><b>Approve And Reject Request</b></div>

        </div>
        <!-- panel body -->
        <div class="panel-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Approve</th>
                    <th class="text-center">Reject</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">Aircraf</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                  </tr>
                  <tr>
                    <td class="text-center">Component</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                  </tr>
                  <tr>
                    <td class="text-center">Engine</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>

                  </tr>
                  <tr>
                    <td class="text-center">Special</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                  </tr>
                  <tr>
                    <td class="text-center">Vendor</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
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
        aircraft : [],
        component : [],
        engine : [],
        special : [],
        vendor : [],
      }
    },
    mounted(){
        this.getData()
    },
    methods : {
        getData(){
          axios.get(this.url+'/dashboard/admin/1').then((res) => {
              this.data = res.data
              this.data = res.data
              this.aircraft = res.data.aircraft
              this.component = res.data.component
              this.engine = res.data.engine
              this.special = res.data.special
              this.vendor = res.data.vendor
          })
          .catch((error) => {
              console.log(err);
          })
        }
    }
  }
</script>
