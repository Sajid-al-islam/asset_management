import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
    quotation_assets: []
}

// get state
const getters = {
    // get_asset_category_data: state => state.data,
    get_quotations: state => state.data,
    get_quotation_single: state => state.single_data,
    get_quotation_assets: state => state.quotation_assets,
}

// actions
const actions = {
    fetch_quotation_paginate: async function(state, page=1) {
        await axios.get('/quotation/index?page='+page)
        .then((res) => {
            this.commit('set_quotation', res.data.quotations);
        })
    },
    
    fetch_quotation_all: async function(state) {
        await axios.get('/quotation/index?all')
        .then((res) => {
            this.commit('set_quotation', res.data.quotations);
        })
    },
    
    fetch_quotation_single: async function(state, id) {
        await axios.get('/quotation/single?id='+id).then((response) => {
            
            this.commit('set_quotation_single', response.data.quotation);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    create_quotation: async function(state, data) {
        let res = await axios.post('/quotation/create', data.formData, data.config);
        state.dispatch('fetch_quotation_all');
        
        return res 
    },
    update_quotation: async function(state, formData) {
        let res = await axios.post('/quotation/update', formData);
        state.dispatch('fetch_quotation_all');
        
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
    set_quotation: function (state, data) {
        state.data = data;
    },
    set_quotation_single: function(state, data) {
        state.single_data = data;
    },
    set_quotation_asset: function(state, data) {
        state.quotation_assets = data;
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
