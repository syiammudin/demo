<template>
<div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>Question</th>
                <th v-if="type == 'vendor'">Max Score</th>
                <th v-if="type == 'vendor'">Score</th>
                <th v-else>Answer</th>
                <th v-if="type != 'vendor'">#</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(d,i) in data" :key="i">
                <td>{{ d.question }}</td>
                <td v-if="type == 'vendor'">{{ d.max_score }}</td>
                <td v-if="type == 'vendor'">{{ d.score }}</td>
                <td v-else>{{ d.answer }}</td>
                <td v-if="type != 'vendor'">{{ d.remark }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"> <h1>Score : {{ score }}</h1> </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    props : ['id','type'],
    data(){
        return {
            url : BASE_URL + 'submit_decision', data : [], score : ''
        }
    },
    mounted(){
        this.getData() ;
    },
    methods : {
        getData(){
            if(this.type == 'vendor'){
                axios.get(this.url+'/'+this.id+'?type=vendor').then((res) => {
                    this.data = JSON.parse(res.data.decision)
                    this.score = parseFloat(res.data.score).toFixed(2)
                })
                .catch((err) => {

                })

            }else{
                axios.get(this.url+'/'+this.id).then((res) => {
                    this.data = JSON.parse(res.data.decision)
                    this.score = parseFloat(res.data.score).toFixed(2)
                })
                .catch((err) => {

                })

            }
        }
    }
}
</script>

<style lang="css">
</style>
