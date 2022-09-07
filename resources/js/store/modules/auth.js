import axiosClient from './../../axios.js'

const state = {
    data: JSON.parse(localStorage.getItem('ariaUser')),
    token: localStorage.getItem('ariaToken'),
    loading: false,
};
const getters = {};
const actions = {
    // register user
    regsiterUser({ commit }, user)
    {
        commit('setUserLoading', true)
        let userData = JSON.parse(JSON.stringify(user))
        return axiosClient.post('register', user)
            .then(({ data }) => {
                commit('setUserData', data)
                commit('setUserLoading', false)
            })
    },

    loginUser({commit}, user)
    {
        commit('setUserLoading', true)
        let userData = JSON.parse(JSON.stringify(user))
        return axiosClient.post('login', user)
            .then(({ data }) => {
                commit('setUserData', data)
                commit('setUserLoading', false)
            })
    },

    registerVIP({ commit }, user)
    {
        commit('setUserLoading', true)
        let userData = JSON.parse(JSON.stringify(user))
        return axiosClient.post('register-vip', user)
            .then(({ data }) => {
                console.log(data)
                commit('setUserData', data)
                commit('setUserLoading', false)
            })
    },

    // logout user
    logout({ commit })
    {
        commit('logoutUser');
    }
};
const mutations = {
    setUserData(state, data)
    {
        // save token in local storage
        localStorage.setItem('ariaToken', data.token);
        state.token = data.token;

        localStorage.setItem('ariaUser', JSON.stringify(data.user));
        state.data = data.user;
    },

    logoutUser(state)
    {
        state.token = '';
        state.data = {};

        localStorage.removeItem('ariaUser');
        localStorage.removeItem('ariaToken');
    },

    setUserLoading(state, loading){
        state.loading = loading;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};