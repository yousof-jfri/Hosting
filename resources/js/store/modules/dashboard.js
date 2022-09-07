import axiosClient from './../../axios.js'

const state = {
    data: {},
    userVideos: [],
    randomVideo: [],
    videoViews: [],
    watcherType: [],
    watchHistory: [],
    loading: false,
    historyLoading: false,
};
const getters = {

};
const actions = {
    // get logined user full data 
    getUserPermissions({ commit }, id)
    {
        commit('setDashboardLoading', true)
        return axiosClient.post(`admin/user-permissions`, { id })
            .then(({data}) => {
                commit('setUserFullData', data);
                commit('setDashboardLoading', false)
            })
    },

    // get logined user watch history
    getUserWatchHistory({ commit }, id)
    {
        commit('setHistoryLoading', true);
        return axiosClient.post(`admin/user-history`, { id })
            .then(({data}) => {
                commit('setWatchHistory', data.data);
                commit('setHistoryLoading', false);
            })
    }
};
const mutations = {
    setUserFullData(state, data)
    {
        state.data = data.user;
        state.userVideos = data.userVideos;
        state.randomVideo = data.randomVideos;
        state.videoViews = data.videoView;
        state.watcherType = data.watcher_type;

        localStorage.setItem('ariaUser', JSON.stringify({ id: data.user.id, name: data.user.name, last_name: data.user.last_name, image: data.user.image, email: data.user.email }))
    },

    setDashboardLoading(state, loading)
    {
        state.loading = loading;
    },

    setHistoryLoading(state, loading){
        state.historyLoading = loading;
    },

    setWatchHistory(state, data)
    {
        state.watchHistory = data
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};