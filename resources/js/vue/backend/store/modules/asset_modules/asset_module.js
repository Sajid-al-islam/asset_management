import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
    dashboard_stats: {}
}

// get state
const getters = {
    get_asset_data: state => state.data,
    get_asset_single_data: state => state.single_data,
    get_asset_stats: state => state.dashboard_stats,
}

// actions
const actions = {
    fetch_asset_all: async function(state, page=1) {
        await axios.get('/asset/index?page='+page)
        .then((res) => {
            this.commit('set_asset', res.data.assets);
        })
    },
    search_asset: async function (state, data) {
        
        await axios.get('/asset/index?key='+data.key+'&page='+data.page)
        .then((res) => {
            this.commit('set_asset', res.data.assets);
        })
    },
    fetch_dashboard_stats: async function(state) {
        await axios.get('/asset/dashboard_stats')
        .then((res) => {
            this.commit('set_dashboard_stats', res.data.stats);
        })
    },
    fetch_asset_single: async function(state, id) {
        await axios.get('/asset/single?id='+id).then((response) => {
            
            this.commit('set_asset_single', response.data.asset);
        })
        .catch((e) => {
            console.log(e);
        });
    },
    create_asset: async function(state, data) {
        // console.log(formData);
        let res = await axios.post('/asset/create', data.formData, data.config);
        state.dispatch('fetch_asset_all');
        
        return res 
    },
    edit_asset: async function(state, data) {
        // console.log(formData);
        let res = await axios.post('/asset/update', data.formData);
        state.dispatch('fetch_asset_all');
        
        return res 
    },

    // create_asset_category: async function(state, category_name) {
    //     await axios.post('/category/create?name='+category_name)
    //     .then((res) => {
    //         if(res.status == 200) {
    //             return 'category_added';
    //         }
    //         this.fetch_asset_category_all
    //     })
    // },
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
    set_asset: function (state, data) {
        state.data = data;
    },
    set_dashboard_stats: function (state, data) {
        state.dashboard_stats = data;
    },
    set_asset_single: function(state, data) {
        state.single_data = data;
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
