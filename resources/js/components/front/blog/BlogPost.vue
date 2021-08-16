<template>
    <span id="blog_post">
        <section id="inner-headline">
        <div class="container">
            <div class="row">
            <div class="span4">
                <div class="inner-heading">
                <h2>Blogs</h2>
                </div>
            </div>
            <div class="span8">
                <ul class="breadcrumb">
                <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                <li class="active">Blog with left sidebar</li>
                </ul>
            </div>
            </div>
        </div>
        </section>
        <section id="content">
        <div class="container">
            <div class="row">
                <div class="span8">
                    <article v-for="(blog) in getAllBlogs" :key="blog.id">
                    <div class="row">
                        <div class="span8">
                        <div class="post-image">
                            <div class="post-heading">
                            <h3><a href="#">{{ blog.title }}</a></h3>
                            </div>
                            <img :src="`/uploadimage/${blog.photo}`" alt=""/>
                        </div>
                        <p>{{blog.description | setlength(500, "....")}}</p>
                        <div class="bottom-article">
                            <ul class="meta-post">
                            <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                            <li v-if="blog.user"><i class="icon-user"></i><a href="#"> {{ blog.user.name }}</a></li>
                            <li v-if="blog.user"><i class="icon-folder-open"></i><a href="#"> {{ blog.category.cat_name }}</a></li>
                            <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                            <router-link :to="`/blog/${blog.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                        </div>
                        </div>
                    </div>
                    </article>
                    <div id="pagination">
                    <span class="all">Page 1 of 3</span>
                    <span class="current">1</span>
                    <a href="#" class="inactive">2</a>
                    <a href="#" class="inactive">3</a>
                    </div>
                </div>
                <BlogSidebar />
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
        mounted(){
            console.log('Inside Mounted');
            if(this.$route.params.catId != null){
                    return this.$store.dispatch('allBlogsByCategory',this.$route.params.catId)
            }else{
                return this.$store.dispatch('allBlogs')
            }
        },
        computed:{
            getAllBlogs(){
                console.log('Inside Computed');
               return this.$store.getters.getBlogs
            }
        },
        methods:{
            getAllCategoryPosts(){
                console.log('Inside Methods');
                if(this.$route.params.catId != null){
                    return this.$store.dispatch('allBlogsByCategory',this.$route.params.catId)
                }else{
                    return this.$store.dispatch('allBlogs')
                }
            }
        },
        watch:{
            $route(to,from){
                this.getAllCategoryPosts();
            }
        }
    }
</script>

<style scoped>

</style>
