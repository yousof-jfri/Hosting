import axiosClient from './../../axios.js'

const state = {
    feedbacks : [],
    loading: false,
};
const getters = {};
const actions = {
    sendFeedBack({ commit }, data)
    {
        commit('setFeedBackLoading', true);
        return axiosClient.post('feedback/store-feedback', data)
            .then(({data}) => {
                commit('setFeedBackLoading', false);
                console.log(data)
            })
    },

    fetchAllFeedbacks({ commit })
    {
        commit('setFeedBackLoading', true);
        return axiosClient.get('admin/feedback/all-feedback')
            .then(({ data }) => {
                commit('setFeedBackLoading', false);
                commit('setFeedBack', data.data)
            })
    },

    changeFeedBackStatus({ commit }, feedback)
    {
        return axiosClient.patch(`admin/feedback/edit-status/${feedback.id}`, { type: feedback.type})
            .then(({ data }) => {
                commit('chageFeedbackStatus', feedback)
            })
    },

    deleteFeedback({ commit }, feedback)
    {
        commit('setFeedBackLoading', true);
        return axiosClient.delete(`admin/feedback/delete/${feedback.id}`)
            .then(({ data }) => {
                commit('setFeedBackLoading', false);
                commit('setFeedBack', data.data)
            })
    },
};
const mutations = {
    setFeedBackLoading(state, loading)
    {
        state.loading = loading
    },

    setFeedBack(state, data)
    {
        state.feedbacks = data
    },

    chageFeedbackStatus(state, data)
    {
        state.feedbacks = state.feedbacks.filter((feedback) => {
            if(feedback.id == data.id)
            {
                feedback.type = data.type;
            }
            return feedback;
        })
    },

};

export default {
    state,
    getters,
    actions,
    mutations,
};