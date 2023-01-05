import axios from 'axios';

// state list
const state = {
    data: {},
    single_data: {},
}

// get state
const getters = {
    get_recycle_data: state => state.data,
    get_recycle_single_data: state => state.single_data,
}

// actions
const actions = {
    fetch_recyle_all: async function(state, page=1) {
        await axios.get('/recycle/assets?page='+page)
        .then((res) => {
            this.commit('set_recycle_assets', res.data.assets);
        })
    },
    
    update_recyle_asset: async function(state, formData) {
        // console.log(formData);
        let res = await axios.post('/asset/update', formData);
        this.fetch_recyle_all
        
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
    set_recycle_assets: function (state, data) {
        state.data = data;
    },
    // set_asset_single: function(state, data) {
    //     state.single_data = data;
    // }
}

export default {
    state,
    getters,
    actions,
    mutations
}
