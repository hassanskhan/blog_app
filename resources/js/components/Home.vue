<template>
<div>
<h1>Post</h1>

<hr>

<div v-for="usersposts in posts" :key="usersposts.id">
<h1><a :href="`/user/post/${usersposts.id}`">{{usersposts.title}}</a></h1>
<div class="postdate">
    <span>{{usersposts.new_time}}</span>
</div>

<br>
<br>
<p>{{usersposts.description}}</p>


</div>

</div>
</template>

<script>
export default {
    name : "Home",
    props : ['posts'],

    data(){

        return{

            usersposts : [],
    }
    },
    methods:
    {
        allpost()
        {
            axios.get('/home').then(res => this.usersposts = res.data);
            console.log(this.usersposts);
        }
    },
    mounted(){

        this.allpost();
    }
}
</script>

<style scoped>

.postdate{

 position: relative;
 bottom: 39px;
 left:200px
}

</style>
