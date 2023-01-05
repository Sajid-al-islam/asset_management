import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
    audit_assets: {}
}

// get state
const getters = {
    // get_asset_category_data: state => state.data,
    get_audits: state => state.data,
    get_audit_single: state => state.single_data,
    get_audit_assets: state => state.audit_assets,
}

// actions
const actions = {
    fetch_audit_paginate: async function(state, page=1) {
        await axios.get('/audit/index?page='+page)
        .then((res) => {
            this.commit('set_audit', res.data.audits);
        })
    },
    fetch_audited_assets: async function(state, {id, page=1}) {
        await axios.get(`/audit/audited?id=${id}&page=${page}`)
        .then((res) => {
            this.commit('set_audit_asset', res.data.audit_assets);
        })
    },
    fetch_not_audited_assets: async function(state, {id, page=1}) {
        await axios.get(`/audit/not_audited?id=${id}&page=${page}`)
        .then((res) => {
            this.commit('set_audit_asset', res.data.audit_assets);
        })
    },
    fetch_audit_all: async function(state) {
        await axios.get('/audit/index?all')
        .then((res) => {
            this.commit('set_audit', res.data.set_audits);
        })
    },
    
    fetch_audit_single: async function(state, id) {
        await axios.get('/audit/single?id='+id).then((response) => {
            
            this.commit('set_audit_single', response.data.audit);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    create_audit: async function(state, formData) {
        let res = await axios.post('/audit/create', formData);
        state.dispatch('fetch_audit_all');
        
        return res 
    },
    update_audit_asset_status: async function(state, formData) {
        
        let res = await axios.post('/audit/audit_submit', formData);
        state.dispatch('fetch_not_audited_assets', {id: res.data.audit_id, page: 1});
        
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
    set_audit: function (state, data) {
        state.data = data;
    },
    set_audit_single: function(state, data) {
        state.single_data = data;
    },
    set_audit_asset: function(state, data) {
        state.audit_assets = data;
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
