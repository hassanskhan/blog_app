<template>

<div>



<div class="jumbotron">
  <h1 class="display-4">Welcome to {{details.title}} Blog</h1>
  <p class="lead">{{details.description}}</p>
  <hr class="my-4">
</div>

<h1>Comment Here</h1>
<form id="form">
 <div class="form-group">
    <textarea class="form-control" id="" rows="3" v-model="comment.comments"></textarea>
  </div>
 <div class="form-group">

   <input type="hidden" v-model="comment.post_id">
   <input type="hidden" v-model="comment.user_id">

<button type="button" class="btn btn-success btn-lg" @click="save">comment</button>

  </div>


</form>
<h1>Comments</h1>
<hr>
<div v-for="comment in details.comments" :key="comment.id">
  <hr>
  <h3>{{comment.comments}}</h3>

</div>



</div>

</template>

<script>


export default {

    name : "detailspost",
    props : ['details'],

    data(){
            return{

            comment :{
                    comments : null,
        post_id : this.details.id,
        user_id : this.details.user_id
            },


            }

    },methods:
    {

             save()
       {
           if (this.comment.comments !=null)
           {
               axios.post(`/user/post/${this.comment.post_id}/comment`,{

                   data:this.comment

               }).then(function(response){

                   console.log('comment',response.data);
                   alert('Your comment send successfully Please Check Your Email');
                   location.reload()
               });
           }else {
               alert('Please Fill The Comment');
           }
       }
    }
}
</script>
