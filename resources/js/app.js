import './bootstrap';


// vue
import {createApp} from 'vue'

// vuex
import store from './store';

// vue router
import router from './router';

import App from './App.vue'

createApp(App)
    .use(store)
    .use(router)
    .mount("#app")