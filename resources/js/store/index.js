import { createStore } from 'vuex'

// modules
import auth from './modules/auth.js'
import sections from './modules/sections.js'
import cinema from './modules/cinema.js'
import dashboard from './modules/dashboard.js'
import videos from './modules/videos.js'
import profile from './modules/profile.js'
import feedback from './modules/feedback.js'
import manage from './modules/manage.js'

const store = createStore({
    store: {},
    modules: {
        auth,
        sections,
        cinema,
        dashboard,
        profile,
        feedback,
        videos,
        manage,
    }
});

export default store;