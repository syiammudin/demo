<template >
<div>
    <formMain :type='type' :component_type='component_type' v-show="mainform" @change="changeForm" />
    <EquivalentForm :type='type' :component_type="component_type" v-show="equivalent"  @change="changeForm"  />
    <ShopAbilityTCE :type='type' :component_type="component_type" v-show="ShopAbilityTCE"  @change="changeForm" />
</div>
</template>

<script>
import formMain from './formMain'
import EquivalentForm from './EquivalentForm'
import ShopAbilityTCE from './ShopAbilityTCE'
export default {
    components: { formMain, EquivalentForm, ShopAbilityTCE },
    props: ['type','component_type'] ,
    data () {
        return {
            mainform : true, equivalent : false, ShopAbilityTCE : false
        }
    },
    methods : {
        changeForm(d){
            if(d == 'equivalent'){
                this.mainform = false
                this.equivalent = true
                this.ShopAbilityTCE = false
            }
            if(d == 'mainform'){
                this.mainform = true
                this.equivalent = false
                this.ShopAbilityTCE = false
            }
            if(d == 'shopability'){
                this.mainform = false
                this.equivalent = false
                if(this.component_type == 'TCE'){
                    this.ShopAbilityTCE = true
                }
            }


        }
    }
}
</script>

<style lang="css">
</style>
