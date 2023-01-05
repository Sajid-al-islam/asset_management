import Vue from 'vue';
import Vuex from 'vuex';
// import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import auth_modules from './modules/auth_modules';
import asset_category_module from './modules/asset_modules/asset_category_module';
import asset_sub_category_module from './modules/asset_modules/asset_sub_category_module';
import asset_module from './modules/asset_modules/asset_module';
import asset_location_module from './modules/asset_modules/asset_location_module';
import asset_recycle_module from './modules/recycle/asset_recycle_module';
import user_modules from './modules/user_modules/user_modules';
import audit_module from './modules/audit/audit_module';
import quotation_module from './modules/quotation/quotation_module';

const store = new Vuex.Store({
    modules: {
        auth_modules,
        asset_category_module,
        asset_sub_category_module,
        asset_module,
        asset_location_module,
        asset_recycle_module,
        user_modules,
        audit_module,
        quotation_module
    },
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    // plugins: [createPersistedState()],
});

export default store;
