import axiosClient from './../../axios';

const state = {
    videos: [],

    meta: {},

    actors: [
        {
            img: 'http://127.0.0.1:8000/assets/images/actors/1.jpg',
        },
        {
            img: 'http://127.0.0.1:8000/assets/images/actors/2.jpg',
        },
        {
            img: 'http://127.0.0.1:8000/assets/images/actors/3.jpg',
        },
        {
            img: 'http://127.0.0.1:8000/assets/images/actors/4.jpg',
        },
    ],
    
    loading: false,

    currentVideo: {},
};
const getters = {};
const actions = {
    fetchAllVideos({ commit }, searchedData = {}){
        commit('setCinemaLoading', true);
        return axiosClient.get('cinema/videos', searchedData)
            .then(({ data }) => {
                console.log(data)
                commit('setCinemaLoading', false);
                commit('setCinemaVideoData', {videos: data.data, meta: data.meta})
            })
    },
    getVideo({ commit }, data)
    {
        commit('setCinemaLoading', true);
        return axiosClient.get(`cinema/video/${data.videoId}/${data.userId}`)
            .then(({data}) => {
                commit('setCinemaLoading', false);
                commit('setCurrentVideo', data.data)
            })
    }
};
const mutations = {
    setCurrentVideo(state, data)
    {
        state.currentVideo = data;
    },

    setCinemaVideoData(state, data)
    {
        state.videos = data.videos;
        state.meta = data.meta;
    },

    setCinemaLoading(state, loading)
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