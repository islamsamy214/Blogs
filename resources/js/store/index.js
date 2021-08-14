import Vuex from "vuex";
import Vue from "vue";

import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";
import adminAuth from "./auth/admin/index";
import webAuth from "./auth/web/index";

Vue.use(Vuex);

const store = new Vuex.Store({
    namespaced: true,
    state() {
        return {};
    },
    modules: {
        adminAuth,
        webAuth
    },
    mutations: mutations,
    actions: actions,
    getters: getters
});

export default store;
