<template>
<div>
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Component Capability Request {{ component_type }}</h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li :class="mainform === true ? 'active' : ''"><a aria-expanded="true" @click="save('mainform')" >Main Form</a></li>
                    <li :class="equivalent === true ? 'active' : ''"><a aria-expanded="true"   @click="save('equivalent')" >Equivalent Tool/Equipment</a></li>
                    <li :class="shopability === true ? 'active' : ''"><a aria-expanded="true">Shop Ability</a></li>
                </ul>
                <br>
                <!-- shop ability form -->
                <div  class="form-horizontal"  v-show="shopability">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Shop Maintenance</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.shop_maintenance" placeholder="Shop Maintenance">
                                <span v-if="err.shop_maintenance" class="text-danger"> {{ err.shop_maintenance[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" form-group">
                            <label class="col-sm-4 control-label">Number Ability</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="input.shop_maintenance_no" placeholder="Number Ability">
                                <span v-if="err.shop_maintenance_no" class="text-danger"> {{ err.shop_maintenance_no[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nomenclature</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['NOMENCLATURE']" placeholder="Nomenclature">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Engine</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['ENGINE']" placeholder="Engine">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">APU</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['APU']" placeholder="APU">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type Model</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['TYPE MODEL']" placeholder="Type Model">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sytem</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['SYSTEM']" placeholder="System">
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document 1</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['Document 1']" placeholder="Document 1">
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text"  v-model="summary_of_maintenance['Rev Doc 1']" class="form-control" placeholder="Rev, #">
                                    </div>
                                    <div class="col-lg-6">
                                        <el-date-picker
                                            v-model="summary_of_maintenance['Rev Date Doc 1']"
                                            type="date"
                                            placeholder="Rev. Date" value-format="yyyy-MM-dd">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Document 2</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="summary_of_maintenance['Document 2']" placeholder="Document 2">
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text"  v-model="summary_of_maintenance['Rev Doc 2']" class="form-control" placeholder="Rev, #">
                                    </div>
                                    <div class="col-lg-6">
                                        <el-date-picker
                                        v-model="summary_of_maintenance['Rev Date Doc 2']"
                                        type="date"
                                        placeholder="Rev. Date" value-format="yyyy-MM-dd">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">TBO</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" v-model="summary_of_maintenance['TBO']" placeholder="TBO">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Check Period</label>
                        <div class="col-sm-8"><el-date-picker
                            v-model="summary_of_maintenance['CHECK PERIOD']"
                            type="date"
                            placeholder="Check Period" value-format="yyyy-MM-dd">
                            </el-date-picker>
                        </div>
                    </div>
                </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Test Equipment <el-button @click="addTestEquipment()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-10">
                        <table class="table table-striped" v-if="list_test_equipment.length != 0">
                            <tbody>
                                <tr v-for="(d, i) in list_test_equipment" :key="i">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder="Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.part_name" placeholder="Part Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.available" placeholder="Available"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remarks" placeholder="Remark"></el-input> </td>
                                    <td v-if="list_test_equipment.length != 0"> <el-button @click="delTestEquipment(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Special Tools <el-button @click="addSpecialTools()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-10">
                        <table class="table table-striped" v-if="list_special_tools.length != 0">
                            <tbody>
                                <tr v-for="(d, i) in list_special_tools" :key="i">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder="Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.part_name" placeholder="Part Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.available" placeholder="Available"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remarks" placeholder="Remark"></el-input> </td>
                                    <td v-if="list_special_tools.length != 0"> <el-button @click="delSpecialTools(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Available Qualified Personel <el-button @click="personelDialog = true" size="mini" circle icon="fa fa-plus" ></el-button> </label>
                    <div class="col-lg-10">
                        <table class="table table-striped">
                            <tbody>
                                <tr v-for="d, i in list_personel">
                                    <td>
                                        <el-select  v-model="d.qualified_type"  clearable placeholder="Select Request type" >
                                            <el-option label="Nominated Certifying Staff" value="Nominated Certifying Staff"> </el-option>
                                            <el-option label="Nominated Technician" value="Nominated Technician"> </el-option>
                                        </el-select>
                                    </td>
                                    <td> <el-input type="text" v-model="d.name" placeholder="Name of Nominate" ></el-input></td>
                                    <td> <el-input type="text" v-model="d.id_number"  placeholder="Name of Nominate"></el-input></td>
                                    <td> <el-button @click="delPersonel(i)" size="mini" circle icon="fa fa-trash" ></el-button></el-input></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-6 text-center">Material Planning <el-button @click="addMaterialPlanning()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <label class="col-lg-6 text-center">Manhours Planning <el-button @click="addManhoursPlanning()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-6">
                        <table class="table table-striped" v-if="list_material_planning.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_material_planning">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.desciption" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td v-if="list_material_planning.length != 0"> <el-button @click="delMaterialPlanning(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-striped" v-if="list_manhours_planning.length != 0">
                            <tbody>
                                <tr v-for="d, i in list_manhours_planning">
                                    <td> <el-input type="text" v-model="d.task_name" placeholder=" Task Name"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.man_hours" placeholder=" Man Hours"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.man_power" placeholder=" Man Power"></el-input> </td>
                                    <td v-if="list_manhours_planning.length != 0"> <el-button @click="delManhoursPlanning(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="line-dashed"></div>
                <div class="form-group">
                    <label class="col-lg-12 text-center">Consumbale Material  <el-button @click="addConsumableMaterial()" size="mini" circle icon="fa fa-plus" ></el-button></label>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Description </th>
                                    <th>QTY</th>
                                    <th>Remark</th>
                                    <th v-if="list_consumable_material.length != 0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d, i in list_consumable_material">
                                    <td> <el-input type="text" v-model="d.part_number" placeholder=" Part Number"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.desciption" placeholder=" Desciption"></el-input> </td>
                                    <td> <el-input type="number" v-model="d.qty" placeholder=" Qty"></el-input> </td>
                                    <td> <el-input type="text" v-model="d.remark" placeholder=" remak"></el-input> </td>
                                    <td v-if="list_consumable_material.length != 0"> <el-button @click="delConsumableMaterial(i)" size="mini" circle icon="fa fa-trash" ></el-button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>


        </div>
    </div>
</div>
</template>

<script>


export default {
    props: ['type','component_type'] ,
    data(){
        return {
            mainform : false, equivalent : false , shopability : true, url : BASE_URL + 'submit_component' ,
            input : {} , err : [], summary_of_maintenance : [] , list_test_equipment :  [] , list_test_equipment : [] , list_special_tools : [] ,
            list_personel : [], list_material_planning : [], list_manhours_planning : [], list_consumable_material : []
        }
    },
    mounted(){
        this.getData();
    },
    methods : {
        save(data){
            this.input.summary_of_maintenance = JSON.stringify(this.summary_of_maintenance)
            this.input.test_equipment = JSON.stringify(this.list_test_equipment)
            this.input.special_tool = JSON.stringify(this.list_special_tools)
            this.input.material_planning = JSON.stringify(this.list_material_planning)
            this.input.manhours_planning = JSON.stringify(this.list_manhours_planning)
            this.input.consumable_material = JSON.stringify(this.list_consumable_material)
            this.input.qualified_personel = JSON.stringify(this.list_personel)

            this.input.type = 'shopability'
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+this.type, this.input).then((res) => {
                if(res.data.status == 1){
                    if(data == 'draft'){
                        this.$message({  type: 'success', message: 'Submit Success'  });
                        this.$router.push('/component_request');
                    }else{
                        this.$emit('change', data) ;
                    }
                    loading.close()
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors; loading.close()
            })
        },
        getData() {
            axios.get(this.url+'/'+this.type).then((res) => {
                // shopability
                this.input.shop_maintenance = res.data.component_shop_ability.shop_maintenance
                this.input.shop_maintenance_no = res.data.component_shop_ability.shop_maintenance_no
                this.summary_of_maintenance = JSON.parse(res.data.component_shop_ability.summary_of_maintenance)
                this.list_test_equipment = JSON.parse(res.data.component_shop_ability.test_equipment)
                this.list_special_tools = JSON.parse(res.data.component_shop_ability.special_tool)
                this.list_material_planning = JSON.parse(res.data.component_shop_ability.material_planning)
                this.list_manhours_planning = JSON.parse(res.data.component_shop_ability.manhours_planning)
                this.list_consumable_material = JSON.parse(res.data.component_shop_ability.consumable_material)
                this.list_personel = JSON.parse(res.data.component_shop_ability.qualified_personel)

            })
            .catch((err) => {
                console.log(err);
            })
        },
        addTestEquipment(){
            this.list_test_equipment.push({
                part_number : '',
                part_name : '',
                available : '',
                remarks : '',
            })
        },
        delTestEquipment(i){
            this.list_test_equipment.splice(i, 1)
        },
        addSpecialTools(){
            this.list_special_tools.push({
                part_number : '',
                part_name : '',
                available : '',
                remarks : '',
            })
        },
        delSpecialTools(i){
            this.list_special_tools.splice(i, 1)
        },
        addMaterialPlanning(){
            this.list_material_planning.push({
                part_number : '',
                desciption : '',
                qty : '',
            })
        },
        delMaterialPlanning(i){
            this.list_material_planning.splice(i, 1)
        },
        addManhoursPlanning(){
            this.list_manhours_planning.push({
                task_name : '',
                man_hours : '',
                man_power : '',
            })
        },
        delManhoursPlanning(i){
            this.list_manhours_planning.splice(i, 1)
        },
        addConsumableMaterial(){
            this.list_consumable_material.push({
                part_number : '',
                desciption : '',
                qty : '',
                remark : '',
            })
        },
        delConsumableMaterial(i){
            this.list_consumable_material.splice(i, 1)
        },
        addPersonel(p){
            console.log(p);
            this.list_personel.push({
                qualified_type : '',
                name : p.full_name,
                id_number : p.personel_number,
            })
        },
        delPersonel(i){
            this.list_personel.splice(i, 1)
        },
    }
}
</script>

<style lang="css">
</style>
