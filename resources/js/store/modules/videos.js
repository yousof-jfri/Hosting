import axiosClient from './../../axios';

const state = {
    videos: [],
    links: {},
    meta: {},
    loading: false,
    loadingPercentage: 0,
    currentVideo: {},
};
const getters = {};
const actions = {
    // get all te videos
    fetchVideos({commit}, {url = null} = {})
    {
        url = url || 'admin/video'
        commit('setVideoLoading', true);
        return axiosClient.get(url)
            .then(({data}) => {
                commit('setVideoData', data)
                commit('setVideoLoading', false);
            })
    },

    // store video in database
    uploadVideo({ commit }, data)
    {
        commit('setVideoLoading', true);
        return axiosClient.post('admin/video', data, {
                onUploadProgress : (progressEvent ) => {
                    const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                    if (totalLength !== null) {
                        commit('setLoadingPercentage', Math.round( (progressEvent.loaded * 100) / totalLength ))
                    }
                }
            })
            .then(res => {
                commit('setVideoLoading', false);
            })      
    },

    // get current video
    getCurrentVideo({ commit }, id)
    {
        commit('setVideoLoading', true);
        return axiosClient.get(`admin/video/${id.id}`)
            .then(({data}) => {
                commit('setCurrentData', data.data)
                commit('setVideoLoading', false);
            })
    },

    editVideo({ commit }, data)
    {
        return axiosClient.patch(`admin/video/${data.id}`, data.data, {
            onUploadProgress : (progressEvent ) => {
                const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                if (totalLength !== null) {
                    commit('setLoadingPercentage', Math.round( (progressEvent.loaded * 100) / totalLength ))
                }
            }
        })
            .then(({data}) => {
                commit('setCurrentData', data.data)
            })
    },

    deleteVideo({ commit }, id)
    {
        return axiosClient.delete(`admin/video/${id}`)
            .then(({data}) => {
                console.log(data)
            })
    }
};
const mutations = {
    setVideoLoading(state, loading)
    {
        state.loading = loading;
    },

    setVideoData(state, data)
    {
        state.videos = data.data
        state.links = data.links
        state.meta = data.meta
    },

    setLoadingPercentage(state, loading)
    {
        state.loadingPercentage = loading;
    },

    setCurrentData(state, data)
    {
        state.currentVideo = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
};