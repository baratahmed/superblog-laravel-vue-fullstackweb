import AdminHome from './components/admin/AdminHome'
import CategoryList from './components/admin/category/List'
import CreateCategory from './components/admin/category/New'
import EditCategory from './components/admin/category/Edit'
import PostList from './components/admin/post/List'
import CreatePost from './components/admin/post/New'
import EditPost from './components/admin/post/Edit'
import FrontHome from './components/front/FrontHome'
import BlogPost from './components/front/blog/BlogPost'
import SingleBlog from './components/front/blog/SingleBlog'


export const routes = [
    //Backend Routes
    { path: '/home', component: AdminHome },
    { path: '/categories', component: CategoryList },
    { path: '/create-category', component: CreateCategory },
    { path: '/edit-category/:categoryId', component: EditCategory },
    { path: '/posts', component: PostList },
    { path: '/create-post', component: CreatePost },
    { path: '/edit-post/:postId', component: EditPost },

    //Frontend Routes
    { path: '/', component: FrontHome },
    { path: '/blogs', component: BlogPost },
    { path: '/blog/:blogId', component: SingleBlog },
    { path: '/frontcategories/:catId', component: BlogPost },

]
