import axiosClient from "../../axios";

const state = {
    loading: false,
    errors: [],
};
const getters = {};
const actions = {
    // update normal user data
    updateUser({ commit }, userData)
    {
        commit('setUserProfileLoading', true)
        return axiosClient.patch(`admin/profile/edit/${userData.id}`, userData)
            .then(({data}) => {
                commit('setUserProfileLoading', false)
                commit('setUserFullData', data);
            })
    },

    // update vip user data
    updateVIPUser({ commit }, data)
    {
        commit('setUserProfileLoading', true);
        return axiosClient.patch(`admin/profile/edit-vip/${data.id}`, data)
            .then(({data}) => {
                commit('setUserProfileLoading', false);
                commit('setUserFullData', data);
                console.log(data)
            })
    },

    // edit user phone number
    editPhoneNumber({ commit }, data)
    {
        commit('setUserProfileLoading', true);
        return axiosClient.patch(`admin/profile/edit-phone/${data.userId}`, data)
            .then(({data}) => {
                commit('setUserProfileLoading', false);
                commit('setUserFullData', data);
            })
    },

    // edit the user password
    editPassword({ commit }, data)
    {
        commit('setUserProfileLoading', true);
        return axiosClient.patch(`admin/profile/edit-password/${data.userId}`, data)
            .then(({data}) => {
                console.log(data)
                commit('setUserProfileLoading', false);;
            })
    }
};
const mutations = {
    setUserProfileLoading(state, loading)
    {
        state.loading = loading;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};