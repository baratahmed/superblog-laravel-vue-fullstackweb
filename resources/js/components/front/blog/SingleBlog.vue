<template>
    <span id="single_blog">
        <section id="content">
            <div class="container">
            <div class="row">
                <div class="span8">
                    <article>
                        <div class="row">
                        <div class="span8">
                            <div class="post-image">
                            <div class="post-heading">
                                <h3><a href="#">{{ blog.title }}</a></h3>
                            </div>
                            <img :src="`/uploadimage/${blog.photo}`" alt="" />
                            </div>
                            <p>
                                {{blog.description}}
                            </p>
                            <div class="bottom-article">
                            <ul class="meta-post">
                                <li v-if="blog.user"><i class="icon-user"></i><a href="#"> {{ blog.user.name }}</a></li>
                                <li v-if="blog.category"><i class="icon-folder-open"></i><a href="#"> {{ blog.category.cat_name }}</a></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </article>
                </div>
                <div class="span4">
                    <BlogSidebar/>
                </div>
            </div>
            </div>
        </section>
    </span>
</template>

<script>
import BlogSidebar from './BlogSidebar.vue'
    export default {
        components:{
            BlogSidebar,
        },
        mounted() {
            this.singlePost()
        },
        computed:{
            blog(){
                return this.$store.getters.getBlog
            }
        },
        methods:{
            singlePost(){
                return this.$store.dispatch('getSingleBlog',this.$route.params.blogId)
            }
        },
        watch:{
            $route(to,from){
                this.singlePost()
            }
        }
    }
</script>

<style scoped>

</style>
