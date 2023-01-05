import axios from 'axios';

// state list
const state = {
    auth_information: null,
}

// get state
const getters = {
    get_auth_information: state => state.auth_information,
}

// actions
const actions = {
    fetch_auth_information: function (state) {
        axios.post('/user/user_info')
            .then((res) => {
                // console.log(res.data);
                this.commit('set_auth_information', res.data);
            })
            .catch((err)=>{
                window.s_alert('error','something went wrong, reload window to fix it. '+(err.response?.data?.err_message || err.response?.data?.message));
            })
    },
}

// mutators
const mutations = {
    set_auth_information: function (state, auth_information) {
        state.auth_information = auth_information;
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
