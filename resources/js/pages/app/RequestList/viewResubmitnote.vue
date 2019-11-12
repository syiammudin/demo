<template>
<div class="">
  <h5>
    Note : {{ dataHistory[dataHistory.length - 1].note }}
  </h5>
    <table class="table">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(d,i) in data" :key="i">
                <td> <a :href="base_url+'uploads/'+ type +'/attachment/'+d.attachment" target="_blank">{{ d.attachment }}</a> </td>
                <td> {{ d.note }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    props : ['id','type'],
    mounted(){
        this.getData();
        this.getHistory();
    },
    data(){
        return{
            url : BASE_URL+"attachmentResubmit" ,data : [], base_url : BASE_URL, dataHistory : ''
        }
    },
    methods :{
        getHistory(){
            axios.get(this.base_url+'/submit_aircraft/'+this.id).then((res) => {
                this.dataHistory = res.data[0].request_history.filter(fil => fil.status == 1)
            })
            .then((err) => {

            })
        },
        getData(){
            axios.get(this.url+'/'+this.id+'?type='+this.type).then(res => {
                this.data = res.data
            })
            .catch(err => {

            })
        }
    }
}
</script>

<style lang="css" scoped>
</style>
