<template>
<div class="">
    <iframe :src="url+link" style="width:100%;" height="500px"></iframe>
</div>
</template>

<script>
export default {
    props : ['link'],
    data(){
        return{
            url : BASE_URL
        }
    }
}
</script>

<style lang="css">
</style>
