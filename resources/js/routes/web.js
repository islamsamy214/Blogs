import HomePage from "./../pages/home/HomePage.vue";
//about
import AboutPage from "./../pages/about/AboutPage.vue";
//posts
import PostPage from "./../pages/posts/PostPage.vue";
import PostDetails from "./../pages/posts/post-details/PostDetails.vue";
//comments
import EditComment from "./../pages/posts/post-details/comments-edit/EditComment.vue";
//auth
import RegisterPage from "./../pages/auth/RegisterPage.vue";
import LoginPage from "./../pages/auth/LoginPage.vue";

const web = [
    ////////////////////////////////// web routes ////////////////////////////

    // auth routes
    {
        name: "register",
        path: "register",
        component: RegisterPage
    },
    {
        name: "login",
        path: "login",
        component: LoginPage
    },
    {
        name: "home",
        path: "home",
        component: HomePage,
        children: web
    },
    {
        name: "about",
        path: "about",
        component: AboutPage
    },
    //posts
    {
        name: "posts",
        path: "blogs",
        component: PostPage
    },
    {
        name: "posts.details",
        path: "blogs/:id",
        component: PostDetails
    },
    //comments
    {
        name: "comments.edit",
        path: "comments/edit",
        component: EditComment
    }
];

export default web;
