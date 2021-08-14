import Vue from "vue";
import VueRouter from "vue-router";
import router from "./routes/router.js";
import store from "./store/index";

import BlogApp from "./BlogApp.vue";
import PageHeader from './components/user-interface/admin-ui/PageHeader.vue'
import LoadingUi from './components/user-interface/LoadingUi.vue';

require("./bootstrap");

window.Vue = require("vue");
Vue.use(VueRouter);

Vue.component("blog-app", BlogApp);
Vue.component("page-header", PageHeader);
Vue.component("loading-ui",LoadingUi);

const app = new Vue({
    el: "#app",
    store: store,
    router: router,
});

//to solve pushing problem for vue router 3
const originalPush = VueRouter.prototype.push;
// Rewrite the push method on the prototype and handle the error message uniformly
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch(err => err);
};