<template>
    <div class="row">
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : powderblue ;">
                <div class="panel-heading clearfix" style="background-color : #00008B ;" >
                  <div class="panel-title" style="color : white ; font-weight: : bold ;">Aircraf Request</div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="stack-order col-md-3">
                        <h1 class="no-margins">{{ aircraft.length }}</h1>
                        <small>Request</small>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped" style="font-size:7pt">
                            <tr>
                                <td>Submit User</td><td>:</td><td> {{ aircraft.filter(ar => ar.status == 1).length }} </td>
                            </tr>
                            <tr>
                                <td>Accept Manager</td><td>:</td><td>{{ aircraft.filter(ar => ar.status == 2).length }}</td>
                            </tr>
                            <tr>
                                <td>Accept GM</td><td>:</td><td>{{ aircraft.filter(ar => ar.status == 3).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve QSA</td><td>:</td><td>{{ aircraft.filter(ar => ar.status == 4).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve GM QSA</td><td>:</td><td>{{ aircraft.filter(ar => ar.status == 5).length }}</td>
                            </tr>
                            <tr>
                                <td>Reject</td><td>:</td><td>{{ aircraft.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="icons"> <i class="fa fa-plane"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : pink ;">
                <div class="panel-heading clearfix" style="background-color : #DC143C ;" >
                    <div class="panel-title" style="color : white ; font-weight: : bold ;">Component Request</div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="col-md-3 stack-order">
                        <h1 class="no-margins">{{ component.length }}</h1>
                        <small>Request</small>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped" style="font-size:7pt">
                            <tr>
                                <td>Submit User</td><td>:</td><td> {{ component.filter(ar => ar.status == 1).length }} </td>
                            </tr>
                            <tr>
                                <td>Accept Manager</td><td>:</td><td>{{ component.filter(ar => ar.status == 2).length }}</td>
                            </tr>
                            <tr>
                                <td>Accept GM</td><td>:</td><td>{{ component.filter(ar => ar.status == 3).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve QSA</td><td>:</td><td>{{ component.filter(ar => ar.status == 4).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve GM QSA</td><td>:</td><td>{{ component.filter(ar => ar.status == 5).length }}</td>
                            </tr>
                            <tr>
                                <td>Reject</td><td>:</td><td>{{ component.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="icons"> <i class="fa fa-plane"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : limegreen ;">
                <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                    <div class="panel-title" style="color : white ; font-weight: : bold ;">Engine Request</div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="col-md-3 stack-order">
                        <h1 class="no-margins">{{ engine.length }}</h1>
                        <small>Request</small>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped" style="font-size:7pt">
                            <tr>
                                <td>Submit User</td><td>:</td><td> {{ engine.filter(ar => ar.status == 1).length }} </td>
                            </tr>
                            <tr>
                                <td>Accept Manager</td><td>:</td><td>{{ engine.filter(ar => ar.status == 2).length }}</td>
                            </tr>
                            <tr>
                                <td>Accept GM</td><td>:</td><td>{{ engine.filter(ar => ar.status == 3).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve QSA</td><td>:</td><td>{{ engine.filter(ar => ar.status == 4).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve GM QSA</td><td>:</td><td>{{ engine.filter(ar => ar.status == 5).length }}</td>
                            </tr>
                            <tr>
                                <td>Reject</td><td>:</td><td>{{ engine.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="icons"> <i class="fa fa-plane"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : orange ;">
                <div class="panel-heading clearfix" style="background-color : #FF6347 ;" >
                    <div class="panel-title" style="color : white ; font-weight: : bold ;">Special Request</div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="col-md-3 stack-order">
                        <h1 class="no-margins">{{ special.length }}</h1>
                        <small>Request</small>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped" style="font-size:7pt">
                            <tr>
                                <td>Submit User</td><td>:</td><td> {{ special.filter(ar => ar.status == 1).length }} </td>
                            </tr>
                            <tr>
                                <td>Accept Manager</td><td>:</td><td>{{ special.filter(ar => ar.status == 2).length }}</td>
                            </tr>
                            <tr>
                                <td>Accept GM</td><td>:</td><td>{{ special.filter(ar => ar.status == 3).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve QSA</td><td>:</td><td>{{ special.filter(ar => ar.status == 4).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve GM QSA</td><td>:</td><td>{{ special.filter(ar => ar.status == 5).length }}</td>
                            </tr>
                            <tr>
                                <td>Reject</td><td>:</td><td>{{ special.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="icons"> <i class="fa fa-plane"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : paleturquoise ;">
                <div class="panel-heading clearfix" style="background-color : teal ;" >
                    <div class="panel-title" style="color : white ; font-weight: : bold ;">Vendor Management</div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="col-md-3 stack-order">
                        <h1 class="no-margins">{{ vendor.length }}</h1>
                        <small>Request</small>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped" style="font-size:7pt">
                            <tr>
                                <td>Submit User</td><td>:</td><td> {{ vendor.filter(ar => ar.status == 1).length }} </td>
                            </tr>
                            <tr>
                                <td>Accept Manager</td><td>:</td><td>{{ vendor.filter(ar => ar.status == 2).length }}</td>
                            </tr>
                            <tr>
                                <td>Accept GM</td><td>:</td><td>{{ vendor.filter(ar => ar.status == 3).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve QSA</td><td>:</td><td>{{ vendor.filter(ar => ar.status == 4).length }}</td>
                            </tr>
                            <tr>
                                <td>Approve GM QSA</td><td>:</td><td>{{ vendor.filter(ar => ar.status == 5).length }}</td>
                            </tr>
                            <tr>
                                <td>Reject</td><td>:</td><td>{{ vendor.filter(ar => ar.status == 6 || ar.status == 8).length }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="icons"> <i class="fa fa-plane"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" style="background-color : #E5E4E2 ;" >
                <div class="panel-heading clearfix text-center" style="background-color : #B6B6B4 ;" >
                    <div class="panel-title text-center" > <b> All Total Request</b></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div class="col-md-8 stack-order text-center" style="color : green">
                        <h1 class="no-margins" style="font-size:40pt;">
                          {{ total }}
                        </h1>
                        <small style="font-size: 18pt">Request</small>
                    </div>
                    <div class="icons"> <i class="fa fa-fighter-jet "></i> </div>
                </div>
            </div>
        </div>
        <charts/>
        <div class="col-lg-6 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" >
                <div class="panel-heading clearfix" >
                    <div class="panel-title"><b>Grapich All Request</b></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <v-chart :options="option" @click="link('all_request')"></v-chart >
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" >
                <div class="panel-heading clearfix" >
                    <div class="panel-title"><b>Approve & Reject (Capability And Vendor Management) </b></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <v-chart :options="option2" @click="link('approve_and_reject')"></v-chart >
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" >
                <div class="panel-heading clearfix" >
                    <div class="panel-title"><b>Add, Change and Delete Capability (Aircraft, Component, Engine, Special)</b></div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <v-chart :options="option3" @click="link('add_change_delete')"></v-chart >
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 z-index-50 ">
            <div class="panel minimal panel-default" >
                <div class="panel-heading clearfix" >
                    <div class="panel-title"><b>Vendor New Request by Type Supplier</b></div>

                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <v-chart :options="option4"  @click="link('vendor_type_supplier')" ></v-chart >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import charts from './charts'
export default {
    components : {
        charts
    },
    data(){
        return {
            data : [], url : BASE_URL,
            aircraft : [],
            component : [],
            engine : [],
            special : [],
            vendor : [],
            total : 0,
            option : {},
            option2 : {},
            option3 : {},
            option4 : {},
        }
    },
    mounted(){
        this.getData()
        this.PresentageApproveStatus()
        this.addChangeDelete()
        this.VendorByTypeSupplier()
    },
    methods : {
      link(d){
          this.$router.push({ name: 'report', params: { type: d } })
          this.scrollToTop()
      },
        getData(){
            axios.get(this.url+'/dashboard/admin/1').then((res) => {
                this.data = res.data
                this.data = res.data
                this.aircraft = res.data.aircraft
                this.component = res.data.component
                this.engine = res.data.engine
                this.special = res.data.special
                this.vendor = res.data.vendor
                this.total = res.data.aircraft.length + res.data.component.length + res.data.engine.length + res.data.special.length + res.data.vendor.length
                this.option = {
                    title : {
                        subtext: 'Data Request',
                        x:'center'
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                        data: ['Aircraft','Component','Engine','Special','Vendor']
                    },
                    color : ['#00008B','#DC143C','#006400','#FF6347','cyan'],
                    series : [
                        {
                            name: 'Data Presentage All Request',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[
                                {value:res.data.aircraft.length, name:'Aircraft'},
                                {value:res.data.component.length, name:'Component'},
                                {value:res.data.engine.length, name:'Engine'},
                                {value:res.data.special.length, name:'Special'},
                                {value:res.data.vendor.length, name:'Vendor'}
                            ],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                }
            })
            .catch((error) => {
                console.log(err);
            })
        },
        PresentageApproveStatus(){
          axios.get(this.url+'/dashboard/approveReject/1').then((res) => {
            var countApproveVendor = res.data.vendor.filter(f => f.status == 5).length
            var countRejectVendor = res.data.vendor.filter(f => f.status == 6 || f.status == 8).length
            var countApproveCap = res.data.capability.filter(f => f.status == 5).length
            var countRejectCap = res.data.capability.filter(f => f.status == 6 || f.status == 8).length

            this.option2   = {
              title : {
                subtext: 'Data Request',
                x:'center'
              },
              tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
              },
              legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Reject','Approve']
              },
              color: ['red', '#84BD00'],
              series : [
                {
                  name: 'Data Request Approve & Reject',
                  type: 'pie',
                  radius : '55%',
                  center: ['50%', '60%'],
                  data:[
                    {value: countRejectVendor+countRejectCap, name:'Reject'},
                    {value: countApproveVendor+countApproveCap, name:'Approve'},
                  ],
                  itemStyle: {
                    emphasis: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                  }
                }
              ]
            }
          })
        },

        addChangeDelete(){
          axios.get(this.url+'/dashboard/capability/1').then((res) => {
            var add = res.data.filter(f => f.request_type == 'Add').length
            var add_change = res.data.filter(f => f.request_type == 'Add Change').length
            var change = res.data.filter(f => f.request_type == 'Change').length
            var deleted = res.data.filter(f => f.request_type == 'Delete').length

            this.option3   = {
              title : {
                subtext: 'Data Request',
                x:'center'
              },
              tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
              },
              legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Add','Change', 'Delete']
              },
              color: ['Blue', '#84BD00', 'Red'],
              series : [
                {
                  name: 'Data Request Add Change & Delete',
                  type: 'pie',
                  radius : '55%',
                  center: ['50%', '60%'],
                  data:[
                    {value: add+add_change, name:'Add'},
                    {value: change, name:'Change'},
                    {value: deleted, name:'Delete'},
                  ],
                  itemStyle: {
                    emphasis: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                  }
                }
              ]
            }
          })
        },

        VendorByTypeSupplier(){
          axios.get(this.url+'/dashboard/vendor/1').then((res) => {
            var type_supplier = [...new Set(res.data.map(x => x.type_supplier))]
            var data = []
            for (var i = 0; i < type_supplier.length; i++) {
                data.push({
                  name : type_supplier[i],
                  value : res.data.filter(f => f.type_supplier == type_supplier[i] ).length
                })
            }

            this.option4  = {
              title : {
                subtext: 'Data Request',
                x:'center'
              },
              tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
              },
              legend: {
                orient: 'vertical',
                left: 'left',
                data: type_supplier
              },
              // color: ['Blue', '#84BD00', 'Red'],
              series : [
                {
                  name: 'Data Request Vendor Type Supplier Mode',
                  type: 'pie',
                  radius : '55%',
                  center: ['50%', '60%'],
                  data: data ,
                  itemStyle: {
                    emphasis: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                  }
                }
              ]
            }
          })
        },
        scrollToTop() {
          window.scrollTo(0,0);
        },
    }
}
</script>
<style>
.echarts {
  width: 100%;
}
</style>
