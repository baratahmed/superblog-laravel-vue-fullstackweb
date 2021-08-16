<template>
    <div>
     <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Post</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" @submit.prevent="addNewPost">
                <div class="card-body">
                  <div class="form-group">
                        <label for="title">Add Post Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Post Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                        <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="description">Add Post Description</label>
                        <!-- <textarea class="form-control" id="description" placeholder="Post Description" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea> -->
                        <markdown-editor v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }"></markdown-editor>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="form-group" >
                        <label>Select</label>
                        <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                            <option disabled value="">Select One</option>
                            <option :value="category.id" v-for="category in getAllCategory" :key="category.id">{{category.cat_name}}</option>

                        </select>
                        <has-error :form="form" field="category_id"></has-error>
                    </div>
                    <div class="form-group" >
                        <label>Image</label>
                        <input name="photo" @change="changePhoto($event)" type="file" :class="{ 'is-invalid': form.errors.has('photo') }">
                        <img v-if="form.photo" :src="form.photo" alt="" width="80" height="80">
                        <has-error :form="form" field="photo"></has-error>
                    </div>
                  <div class="form-group">
                    <button type="submit"  class="btn btn-primary btn-block">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
      </div>
    </section>
    </div>
</template>

<script scoped>
    export default {
        data(){
            return{
                form: new Form({
                    title:'',
                    description:'',
                    category_id:'',
                    photo:'',
                })
            }
        },
        mounted(){
            this.$store.dispatch("allCategories")
        },
        computed:{
            getAllCategory(){
                return this.$store.getters.getCategories
            }
        },
        methods:{
            changePhoto(event){
                let file = event.target.files[0];

                if(file.size > 1048576){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Image size must be less than 1MB!',
                        footer: '<a href="">Why do I have this issue?</a>'
                    })
                }else{
                    let reader = new FileReader();
                    reader.onload = e =>  {
                        this.form.photo = e.target.result
                    };
                    reader.readAsDataURL(file);
                }

        },
        addNewPost(){
            console.log(this.form)
            this.form.post('/post/store')
                .then(()=>{
                    this.$router.push('/posts')
                    toast.fire({
                        icon: 'success',
                        title: 'Post Added successfully'
                    })
                })
                .catch(()=>{
                })
        },
    }
}
</script>


