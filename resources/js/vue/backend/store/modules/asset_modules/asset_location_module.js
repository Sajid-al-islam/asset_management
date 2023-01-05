import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
    asset: {}
}

// get state
const getters = {
    get_asset_location_data: state => state.data,
    // get_asset: state => state.asset,
    get_asset_location_single_data: state => state.single_data,
}

// actions
const actions = {
    fetch_asset_location_all: async function(state) {
        await axios.get('/location/index?all')
        .then((res) => {
            this.commit('set_asset_location', res.data.locations);
        })
    },
    fetch_asset_location_paginate: async function(state, page=1) {
        await axios.get('/location/index?page='+page)
        .then((res) => {
            this.commit('set_asset_location', res.data.locations);
            
        })
    },
    // fetch_location_products: async function(state, data) {
    //     await axios.get('/location/single?id='+data.id+'&is_product='+data.is_product)
    //     .then((res) => {
    //         this.commit('set_asset_location_single', res.data.location);
    //         this.commit('set_asset', res.data.location.assets);
    //     })
    // },
    fetch_asset_location_single: async function(state, id) {
        await axios.get('/location/single?id='+id).then((response) => {
            
            this.commit('set_asset_location_single', response.data.location);
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
    create_asset_location: async function(state, formData) {
        let res = await axios.post('/location/create', formData);
        state.dispatch('fetch_asset_location_all');
        
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
    set_asset_location: function (state, data) {
        state.data = data;
    },
    set_asset_location_single: function(state, data) {
        state.single_data = data;
    },
    set_asset: function(state, data) {
        state.asset = data;
    }
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
