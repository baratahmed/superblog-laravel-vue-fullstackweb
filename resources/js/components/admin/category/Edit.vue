<template>
    <div>
     <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @submit.prevent="updateCategory">
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryId">Category Name</label>
                    <input type="text" name="cat_name" v-model="form.cat_name" class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }" id="categoryId" placeholder="Edit category name">
                    <has-error :form="form" field="cat_name" class="text-center" style="font-size:17px"></has-error>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
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

<script>
    export default {
        name: "Edit",
        data(){
            return{
                form: new Form({
                    cat_name: '',
                })
            }
        },
        mounted(){
            axios.get(`/category/edit/${this.$route.params.categoryId}`)
            .then((res)=>{
                this.form.fill(res.data.category)
            })
            .catch()
        },
        methods:{
            updateCategory(){
                this.form.post(`/category/update/${this.$route.params.categoryId}`)
                .then((res) => {
                    //console.log(res.data)
                    this.$router.push('/categories');
                     toast.fire({
                        icon: 'success',
                        title: 'Category updated successfully'
                    })
                })
                .catch((err) => {
                    console.log(err.data)
                })
            }
        }
    }
</script>


<style scoped>

</style>
