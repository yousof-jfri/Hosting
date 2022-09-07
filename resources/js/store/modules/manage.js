import axiosClient from './../../axios.js'

const state = {
    users: [],
    links: [],
};
const getters = {};
const actions = {
    fetchAllUsers({ commit }, {url = null} = {})
    {
        url = url || 'admin/manage/all-users'
        return axiosClient.get(url)
            .then(({ data }) => {
                commit('setUsersData', data)
                console.log(data)
            })
    }
};
const mutations = {
    setUsersData(state, data)
    {
        state.users = data.data;
        state.links = data.links;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};