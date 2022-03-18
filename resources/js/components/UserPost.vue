<template>


    <div>
        <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id="form">
 <div class="form-group">

    <label for="">Title</label>

    <input type="text" class="form-control" id="" placeholder="Enter Title Here" v-model="item.title">

    </div>

    <div class="form-group">

    <label for="">Description</label>

    <textarea class="form-control"  id="" rows="3" placeholder="Enter Description" v-model="item.description"></textarea>
    </div>
   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="update">Update</button>
      </div>
    </form>
      </div>

    </div>
  </div>
</div>
        <h1>My Posts</h1>
        <table class="table text-center table-striped table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">status</th>
      <th scope="col">Time</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <tr v-for="userPost in userpost" :key="userPost.id">
      <td>{{userPost.title}}</td>
      <td>{{userPost.description}}</td>
      <td><strong>{{userPost.status}}</strong> </td>
      <td><strong>{{userPost.new_time}}</strong> </td>
      <td class="d-flex">

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="edituser(userPost)">
            Edit
          </button>

          <button type="button" class="btn btn-danger ml-2" @click="deletepost(userPost.id)">
            delete
          </button>
          <button type="button" class="btn btn-warning ml-2" @click="status(userPost.id)">
            public
          </button>
          <button type="button" class="btn btn-secondary ml-2" @click="statusprivate(userPost.id)">
           private
          </button>
      </td>
    </tr>


  </tbody>
</table>
    </div>
</template>

<script>
export default {

    name : "user-post",
    props : ['userpost'],
    data()
    {
        return{

            userposts : [],
             item :
             {

                    title : "" ,
                    description : "" ,

            },
            temp_id : null

        }

    },methods:
    {
        userspost()
        {
            axios.get('/user/posts').then(response => this.userposts = response.data);
            console.log(this.userposts);
        },
           edituser(post){
            //    $this.$emit('edit-user', user);
             this.item = {
                 title :post.title,
                 description : post.description,

             }
             this.temp_id = post.id;
           //  this.isEditing = true

         },
         update()
         {

             try {

                 if (this.item.title !=null && this.item.description !=null){


                     var url = `/user/posts/${this.temp_id}`;
                     axios.put(url,{

                         data : this.item

                     }).then(response => {
                         alert('Update Data Successfully');
                         location.reload();

                     });

                 }else {

                     alert("Please Fill The Empty Feild");

                 }


             } catch (error) {
              //   console.log(error);
             }


            //  location.reload();

         },
          deletepost(id){
        try{
            axios.delete(`/user/post/${id}`).then(res => {
                alert('delete post Successfully');
                location.reload();
            });
        }
        catch(error){
            console.log(error);
        }
        },
          status(id){
            axios.get(`/user/status/${id}`).then(res => {

              alert('status change successfully');
              location.reload();

            });
          },
          statusprivate(id){
            axios.get(`/user/statusprivate/${id}`).then(res => {

              alert('status change successfully');
              location.reload();

            });
          },
    },
    mounted(){

        this.userspost();
    }


}
</script>
