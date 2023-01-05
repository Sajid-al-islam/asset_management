import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
    asset: []
}

// get state
const getters = {
    get_user_data: state => state.data,
    // get_asset: state => state.asset,
    get_user_single_data: state => state.single_data,
}

// actions
const actions = {
    fetch_user_all: async function(state) {
        await axios.get('/user/index?all')
        .then((res) => {
            this.commit('set_user', res.data.users);
        })
    },
    fetch_users_admin: async function(state) {
        await axios.get('/user/admins')
        .then((res) => {
            this.commit('set_user', res.data.admins);
        })
    },
    fetch_user_paginate: async function(state, page=1) {
        await axios.get('/user/index?page='+page)
        .then((res) => {
            this.commit('set_user', res.data.users);
        })
    },
    // fetch_user_products: async function(state, data) {
    //     await axios.get('/user/single?id='+data.id+'&is_product='+data.is_product)
    //     .then((res) => {
    //         this.commit('set_user_single', res.data.user);
    //         this.commit('set', res.data.user.assets);
    //     })
    // },
    fetch_user_single: async function(state, id) {
        await axios.get('/user/single?id='+id).then((response) => {
            
            this.commit('set_user_single', response.data.user);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    // filter_asset_product: async function(state, data) {
    //     await axios.post('/category/filter', data).then((response) => {
            
    //         this.commit('set_asset', response.data.assets);
    //     })
    //     .catch((e) => {
    //         console.log(e);
    //     });
    // },
    create_user: async function(state, formData) {
        let res = await axios.post('/user/create', formData);
        
        
        return res 
    },
    change_password: async function(state, formData) {
        let res = await axios.post('/user/update-profile', formData);
        
        
        return res 
    }
    // fetch_asset_category_all: function (state, id) {
    //     axios.post('/assets/' + id)
    //         .then((res) => {
    //             this.commit('set_asset_category_single_data', res.data);
    //         })
    // },
    // fetch_asset_category_all: function (state, id) {
    //     axios.post('/assets/update/' + id)
    //         .then((res) => {
    //             this.commit('set_asset_category_update_single_data', {
    //                 data: res.data,
    //                 id
    //             });
    //         })
    // },
}

// mutators
const mutations = {
    set_user: function (state, data) {
        state.data = data;
    },
    set_user_single: function(state, data) {
        state.single_data = data;
    },
    // set_asset: function(state, data) {
    //     state.asset = data;
    // }
    // set_asset_category_single_data: function (state, single_data) {
    //     state.single_data = single_data;
    // },
    // set_asset_category_update_single_data: function (state, params) {
    //     let index = state.data.findIndex(i=>i.id == params.id);
    //     state.data[index] = params.data;
    // },
}

export default {
    state,
    getters,
    actions,
    mutations
}
