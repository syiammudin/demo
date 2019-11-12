<template id="">
  <div class="col-lg-12 col-md-6 z-index-50 ">
    <div class="panel minimal panel-default" >
        <div class="panel-heading clearfix" >
            <div class="panel-title"><b>All Request Detail</b></div>

        </div>
        <!-- panel body -->
        <div class="panel-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Aircraft</th>
                    <th class="text-center">Component</th>
                    <th class="text-center">Engine</th>
                    <th class="text-center">Special</th>
                    <th class="text-center">Vendor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Submit User</td>
                    <td class="text-center"> {{ aircraft.filter(ar => ar.status == 1).length }} </td>
                    <td class="text-center"> {{ component.filter(ar => ar.status == 1).length }} </td>
                    <td class="text-center"> {{ engine.filter(ar => ar.status == 1).length }} </td>
                    <td class="text-center"> {{ special.filter(ar => ar.status == 1).length }} </td>
                    <td class="text-center"> {{ vendor.filter(ar => ar.status == 1).length }} </td>
                  </tr>
                  <tr>
                    <td>Accept Manager</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 2).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 2).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 2).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 2).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 2).length }}</td>
                  </tr>
                  <tr>
                    <td>Accept General Manager</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 3).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 3).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 3).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 3).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 3).length }}</td>
                  </tr>
                  <tr>
                    <td>Approve QSA</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 4).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 4).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 4).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 4).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 4).length }}</td>
                  </tr>
                  <tr>
                    <td>Approve GM QSA (Final)</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 5).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 5).length }}</td>
                  </tr>
                  <tr>
                    <td>Reject</td>
                    <td class="text-center">{{ aircraft.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                    <td class="text-center">{{ component.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                    <td class="text-center">{{ engine.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                    <td class="text-center">{{ special.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                    <td class="text-center">{{ vendor.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold"> Total Request </td>
                    <td class="text-center" style="font-weight:bold">{{ aircraft.length }}</td>
                    <td class="text-center" style="font-weight:bold">{{ component.length }}</td>
                    <td class="text-center" style="font-weight:bold">{{ engine.length }}</td>
                    <td class="text-center" style="font-weight:bold">{{ special.length }}</td>
                    <td class="text-center" style="font-weight:bold">{{ vendor.length }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

  </div>
</template>

<script type="text/javascript">
  import barcart from '../dashboard/charts'
  export default {
    components : {
        barcart
    },
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
