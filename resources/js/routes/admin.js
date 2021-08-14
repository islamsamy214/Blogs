//dashboard imports
import DashboardPage from "./../pages/admin/dashboard/DashboardPage.vue";
//user imports
import UserPage from "./../pages/admin/users/index/UserPage.vue";
import CreateUser from "./../pages/admin/users/create/CreateUser.vue";
import EditUser from "./../pages/admin/users/edit/EditUser.vue";
//client imports
import ClientPage from "./../pages/admin/clients/index/ClientPage.vue";
import CreateClient from "./../pages/admin/clients/create/CreateClient.vue";
import EditClient from "./../pages/admin/clients/edit/EditClient.vue";
//setting imports
import SettingPage from "./../pages/admin/settings/SettingPage.vue";
//category imports
import CategoryPage from "./../pages/admin/categories/index/CategoryPage.vue";
import CreateCategory from "./../pages/admin/categories/create/CreateCategory.vue";
import EditCategory from "./../pages/admin/categories/edit/EditCategory.vue";
//post imports
import PostPage from "./../pages/admin/posts/index/PostPage.vue";
import CreatePost from "./../pages/admin/posts/create/CreatePost.vue";
import EditPost from "./../pages/admin/posts/edit/EditPost.vue";
import PostDetails from "./../pages/admin/posts/post-details/PostDetails.vue";
//comment imports
import CommentPage from "./../pages/admin/comments/index/CommentPage.vue";
import EditComment from "./../pages/admin/comments/edit/EditComment.vue";

const admin = [
    ////////////////////////////////// admin routes ////////////////////////////
    //dashboard
    {
        name: "admin.dashboard",
        path: "dashboard",
        component: DashboardPage
    },
    // users
    {
        name: "admin.users",
        path: "users",
        component: UserPage,
        props: true
    },
    {
        name: "admin.users.create",
        path: "users/add",
        component: CreateUser,
        props: true
    },
    {
        name: "admin.users.edit",
        path: "users/edit",
        component: EditUser,
        props: true
    },
    // clients
    {
        name: "admin.clients",
        path: "clients",
        component: ClientPage
    },
    {
        name: "admin.clients.create",
        path: "clients/add",
        component: CreateClient,
        props: true
    },
    {
        name: "admin.clients.edit",
        path: "clients/edit",
        component: EditClient,
        props: true
    },
    //settings
    {
        name: "admin.settings",
        path: "settings",
        component: SettingPage
    },
    // categories
    {
        name: "admin.categories",
        path: "categories",
        component: CategoryPage
    },
    {
        name: "admin.categories.create",
        path: "categories/add",
        component: CreateCategory,
        props: true
    },
    {
        name: "admin.categories.edit",
        path: "categories/edit",
        component: EditCategory,
        props: true
    },
    //posts
    {
        name: "admin.posts",
        path: "posts",
        component: PostPage
    },
    {
        name: "admin.posts.create",
        path: "posts/add",
        component: CreatePost,
        props: true
    },
    {
        name: "admin.posts.edit",
        path: "posts/edit",
        component: EditPost,
        props: true
    },
    {
        name: "admin.posts.details",
        path: "posts/:id",
        component: PostDetails
    },
    //comments
    {
        name: "admin.comments",
        path: "comments",
        component: CommentPage
    },
    {
        name: "admin.comments.edit",
        path: "comments/edit",
        component: EditComment,
        props: true
    }
];

export default admin;
