<template>
    <div>
      <section class="content">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Post List</h3>
              <div class="card-tools">
                  <router-link to="/create-post" class="btn btn-primary">Add Post</router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SL.</th>
                  <th>User</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Photo</th>
                  <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="(post, index) in getAllPosts" :key="post.id">
                  <td>{{index+1}}</td>
                  <td v-if="post.user">{{post.user.name}}</td>
                  <td v-if="post.category">{{post.category.cat_name}}</td>
                  <td>{{ post.title | setlength(20,"....")}}</td>
                  <td>{{ post.description | setlength(40,"....") }}</td>
                  <td class="text-center"><img :src="ourImage(post.photo)" width="60" height="50" alt="post.title"/></td>
                  <td class="text-center">
                      <router-link :to="`/edit-post/${post.id}`" class="btn btn-info btn-sm mt-1">Edit</router-link>
                      <a @click.prevent="deletePost(post.id)" class="btn btn-danger btn-sm mt-1">Delete</a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </div>
</template>

<script>
    export default {

        mounted(){
            return this.$store.dispatch('allPosts')
        },
        computed:{
            getAllPosts(){
               return this.$store.getters.getPosts
            }
        },
        methods:{
            ourImage(img){
                return "uploadimage/"+img;
            },
            deletePost(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('/post/delete/'+id)
                        .then((res)=>{
                            this.$store.dispatch('allPosts')
                            Swal.fire(
                                'Deleted!',
                                'Your Post has been deleted.',
                                'success'
                                )
                        })
                        .catch()

                    }
                    })
            }
        }
    }
</script>


<style scoped>

</style>
