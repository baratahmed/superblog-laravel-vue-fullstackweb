import axios from "axios"

export default {
    state:{
        sidebar_categories: [],
        categories: [],
        posts: [],
        blogs: [],
        blog: [],
        latestblogs:[],
    },
    getters:{
        getSidebarCategories(state){
            return state.sidebar_categories
        },
        getCategories(state){
            return state.categories
        },
        getPosts(state){
            return state.posts
        },
        getBlogs(state){
            return state.blogs
        },
        getBlog(state){
            return state.blog
        },
        getLatestBlogs(state){
            return state.latestblogs;
        }
    },
    actions:{
        allSidebarCategories(context){
            axios.get('/sidebar/categories')
            .then((res)=>{
                context.commit('sidebar_categories',res.data.categories)
            })
            .catch()
        },
        allBlogsByCategory(context,catId){
            axios.get('/frontcategories/' + catId)
            .then((res)=>{
                console.log('QWERTY' + res.data.posts);
                context.commit('getPostsByCatid',res.data.posts)
            })
            .catch()
        },
        allCategories(context){
            axios.get('/categories')
            .then((res)=>{
                context.commit('categories',res.data.categories)
            })
            .catch()
        },
        allPosts(context){
            axios.get('/posts')
            .then((res)=>{
                ///console.log(res.data.posts)
                context.commit('posts',res.data.posts)
            })
            .catch()
        },
        allBlogs(context){
            axios.get('/blogs')
            .then((res)=>{
                //console.log(res.data.blogs)
                context.commit('blogs',res.data.blogs)
            })
            .catch()
        },
        getSingleBlog(context,blogId){
            axios.get('/blog/'+blogId)
            .then((res)=>{
                //console.log(res.data.blogs)
                context.commit('blog',res.data.blog)
            })
            .catch()
        },
        searchBlog(context, searchTxt){
            axios.get('/search?q='+searchTxt)
            .then((res)=>{
                context.commit('getSearchPost',res.data.blogs)
            })
            .catch()
        },
        getLatestBlogs(context){
            axios.get('/latestblogs')
            .then((res)=>{
                //console.log(res.data.blogs)
                context.commit('latestBlogs',res.data.posts)
            })
            .catch()
        }
    },
    mutations:{
        sidebar_categories(state,data){
            return state.sidebar_categories = data
        },
        categories(state,data){
            return state.categories = data
        },
        posts(state,data){
            return state.posts = data
        },
        blogs(state,data){
            return state.blogs = data
        },
        blog(state,data){
            return state.blog = data
        },
        getPostsByCatid(state,data){
            return state.blogs = data
        },
        getSearchPost(state,data){
            return state.blogs = data
        },
        latestBlogs(state,data){
            return state.latestblogs = data
        }

    }
}
