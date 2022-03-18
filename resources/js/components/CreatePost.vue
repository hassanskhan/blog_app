<template>

    <div>

        <h1>Create Post</h1>
        <hr>





<div class="form-group">
<label for="title">Title</label>

    <input type="text" class="form-control" id="title" placeholder="Enter Title Here" v-model="createpost.title">
    <span class="text-danger font-weight-bolder" id="titleerr"></span>
    </div>

    <div class="form-group">

    <label for="description">Description</label>

    <textarea class="form-control"  id="description" rows="3"  placeholder="Enter Description" v-model="createpost.description"></textarea>
        <span class="text-danger font-weight-bolder" id="descerr"></span>

    </div>
    <button class="btn btn-success"  @click="save">create post</button>
    </div>

</template>

<script>

export default {
    name : "create-post",
    data(){
        return{

            createpost :
            {
                title : "",
                description : "",
            },


        }
    },
    methods:{
       save()
       {


            if (this.createpost.title !="" && this.createpost.description !="" && this.createpost.title.match(/^[A-Za-z]+$/) && this.createpost.title.length < 10)
            {
                axios.post('/user/createform',{
                    data:this.createpost
                }).then(function(response){

                    console.log('Stored-Data',response.data);


                    alert('Post Created Successfully');
                    location.reload();

                }).catch((errors)=> {

                    console.log(errors);

                });
            }else
            {
                if (this.createpost.title !="" && !this.createpost.title.match(/^[A-Za-z]+$/)){

                    document.getElementById('titleerr').innerText="Title Must be an alphabet*";

                  //  alert("Title Must be An Alphabet");

                }
                if (this.createpost.title !="" && this.createpost.title.length > 10){

                    document.getElementById('titleerr').innerText="Title Must be Less Than 10 chracter *";

                }
                if (this.createpost.title == ""){

                    document.getElementById('titleerr').innerText="Title is Required";
                }

                if (this.createpost.description == ""){

                    document.getElementById('descerr').innerText="description is Required";

                }
            }

       },


    },
}
</script>

<style scoped>

.error
{

border: 3px;
border-radius: 5px;
background-color: red;
color: white;
font-weight: bold;



}

</style>
