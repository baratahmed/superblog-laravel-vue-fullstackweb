<template>
    <div>
      <section class="content">
      <div class="row justify-content-center">
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
              <div class="card-tools">
                  <router-link to="/create-category" class="btn btn-primary">Add Category</router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>
                      <select @change="deleteSelected" v-model="select" name="" id="" class="form-control mb-2">
                          <option value="">Select</option>
                          <option value="">Delete All</option>
                      </select>
                      <input type="checkbox" @click="selectAll" v-model="all_select" id="check_all"> &nbsp;&nbsp; <label v-if="all_select" for="check_all">Uncheck all</label><label v-else for="check_all">Check all</label>

                  </th>
                  <th>SL.</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="(category,index) in getAllCategories" :key="category.id">
                  <td><input type="checkbox" v-model="categoryIds" :value="category.id"></td>
                  <td>{{index+1}}</td>
                  <td>{{ category.cat_name }}</td>
                  <td>{{ category.created_at | timeformat }}</td>
                  <td class="text-center">
                      <router-link :to="`/edit-categor/${category.id}`" class="btn btn-info">Edit</router-link>
                      <a href="" @click.prevent="deleteCategory(category.id)" class="btn btn-danger">Delete</a>
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
        data(){
            return{
                all_select: false,
                categoryIds:[],
                select:'',
            }
        },
        mounted(){
            return this.$store.dispatch('allCategories')
        },
        computed:{
            getAllCategories(){
               return this.$store.getters.getCategories
            }
        },
        methods:{
          selectAll(){
              if (!this.all_select) {
                this.all_select = true
                for (let category in this.getAllCategories) {
                    this.categoryIds.push(this.getAllCategories[category].id)

                }
                }else {
                this.all_select = false
                this.categoryIds = []
              }
            },
            deleteCategory(id){
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
                        axios.get('/category/delete/'+id)
                        .then((res)=>{
                            this.$store.dispatch('allCategories')
                            Swal.fire(
                                'Deleted!',
                                'Category deleted successfully!',
                                'success'
                                )
                        })
                        .catch()

                    }
                    })

            },
            deleteSelected(){
                axios.get('/delete/selected/categories/'+this.categoryIds)
                .then((res)=>{
                        this.categoryIds = []
                        this.$store.dispatch('allCategories')
                        Swal.fire(
                            'Deleted!',
                            'Selected categories deleted successfully!',
                            'success'
                            )
                    })
                    .catch()
            },

        }
    }
</script>


<style scoped>

</style>
