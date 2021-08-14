import VueRouter from "vue-router";

import WebLayout from "./../components/layouts/WebLayout.vue";
import AdminLayout from "./../components/layouts/AdminLayout.vue";
import LoginPage from "./../pages/admin/auth/LoginPage.vue";
import NotFound from "./../components/user-interface/NotFound.vue";

import web from "./web";
import admin from "./admin";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            name: "web",
            path: "/",
            component: WebLayout,
            children: web,
            redirect: { name: "home" }
        },
        {
            name: "admin",
            path: "/admin",
            component: AdminLayout,
            children: admin,
            redirect: { name: "admin.dashboard" }
        },
        // admin auth
        {
            name: "admin.login",
            path: "/admin/login",
            component: LoginPage
        },
        //not founded pages
        {
            name: "notfound",
            path: "/:notfound(.*)",
            component:NotFound
        }
    ]
});

export default router;
