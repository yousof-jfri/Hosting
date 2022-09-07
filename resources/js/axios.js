import axios from 'axios';
import store from './store';

const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_MAIN_ADDRESS}api/v1/`,
});

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${store.state.auth.token}`
    return config
})

export default axiosClient