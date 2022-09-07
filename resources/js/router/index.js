import { createRouter, createWebHashHistory } from 'vue-router';
import store from './../store';

import routes from './routes';

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if(to.meta.requireAuth && !store.state.auth.token){
        next({ name: 'Home' });
    }else if(to.meta.requireAdminUser && !store.state.dashboard.data.is_vip) {
        next({ name: 'Home' });
    }
    else {
        next()
    }
});


export default router;