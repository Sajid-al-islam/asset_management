import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
}

// get state
const getters = {
    get_asset_sub_category_data: state => state.data,
    get_asset_sub_category_single_data: state => state.single_data,
}

// actions
const actions = {
    fetch_asset_sub_category_paginate: async function(state, page=1) {
        await axios.get('/sub_category/index?page='+page)
        .then((res) => {
            this.commit('set_asset_sub_category', res.data.sub_categories);
        })
    },
    fetch_subcategory_by_category: async function(state, id) {
        await axios.get('/asset/getSubCategory?category_id='+id)
        .then((res) => {
            this.commit('set_asset_sub_category', res.data);
        })
    },
    fetch_asset_sub_category_all: async function(state) {
        await axios.get('/sub_category/index?all')
        .then((res) => {
            this.commit('set_asset_sub_category', res.data.sub_categories);
        })
    },
    fetch_asset_sub_category_single: async function(state, id) {
        axios.get('/sub_category/single?id='+id).then((response) => {
                
            this.commit('set_asset_sub_category_single', response.data.category);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    create_asset_sub_category: async function(state, formData) {
        let res = await axios.post('/sub_category/create', formData);
        state.dispatch('fetch_asset_sub_category_all');
        return res 
    },
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
    set_asset_sub_category: function (state, data) {
        state.data = data;
    },
    set_asset_sub_category_single: function (state, data) {
        state.single_data = data;
    },
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
