// frontend components
    // Home Page
import Home from './../views/frontend/Home.vue';
import HomeMenu from './../components/frontend/HomeMenu.vue';

    // Cinema Page
import CinemaMenu from './../views/frontend/Cinema/Cinema.vue'
import VideoPage from './../views/frontend/Cinema/VideoPage.vue'

    // Other pages
import About from './../views/frontend/About.vue';
import Guide from './../views/frontend/Guide.vue';
import FeedBack from './../views/frontend/FeedBack.vue';
import RegisterVIPUser from './../views/frontend/RegisterVIPUser.vue'

// backend components
    // dashboard
import MasterLayout from './../components/backend/MasterLayout.vue';
import Dashboard from './../views/backend/Dashboard.vue';

    // Profile
import Profile from './../views/backend/profile/Profile.vue';

    // Videos
import AppVideos from './../views/backend/video/AllVideos.vue';
import NewVideo from './../views/backend/video/NewVideo.vue';
import EditVideo from './../views/backend/video/EditVideo.vue';

    // watct history
import WatchHistory from './../views/backend/watch_history/WatchHistory.vue'

    // mangage
import Feedback from './../views/backend/manage/Feedback.vue';
import Users from './../views/backend/manage/Users.vue';


const routes = [
    // frontend routes
    {
        path: '/',
        component: HomeMenu,
        redirect: { name: 'Home' },
        meta: { requireAuth: false },
        children: [
            {
                path: '/home',
                name: 'Home',
                component: Home,
            }
        ],
    },
    {
        path: '/register-vip',
        component: RegisterVIPUser,
        meta: {requireAuth: false},
        name: 'RegisterVIPUser'
    },
    {
        path: '/cinema',
        component: CinemaMenu,
        meta: { requireAuth: false },
        name: 'Cinema',
    },
    {
        path: '/video/:id',
        name: 'VideoPage',
        meta: { requireAuth: false },
        component: VideoPage,
    },
    {
        path: '/about',
        name: 'About',
        meta: { requireAuth: false },
        component: About,
    },
    {
        path: '/guide',
        name: 'Guide',
        meta: { requireAuth: false },
        component: Guide,
    },
    {
        path: '/feed-back',
        name: 'FeedBack',
        meta: { requireAuth: false },
        component: FeedBack,
    },

    // backend routes
    {
        path: '/admin',
        component: MasterLayout,
        name: 'Admin',
        redirect: { name: 'Dashboard' },
        meta: { requireAuth: true },
        children: [
            {
                meta: { requireAdminUser: false },
                path: 'dashboard',
                name: 'Dashboard',
                component: Dashboard,
            },
            {
                meta: { requireAdminUser: false },
                path: 'profile',
                name: 'Profile',
                component: Profile,
            },
            {
                meta: { requireAdminUser: true },
                path: 'videos',
                name: 'Videos',
                component: AppVideos,
            },
            {
                meta: { requireAdminUser: true },
                path: 'videos/create',
                name: 'NewVideo',
                component: NewVideo,
            },
            {
                meta: { requireAdminUser: true },
                path: 'videos/edit/:id',
                name: 'EditVideo',
                component: EditVideo,
            },
            {
                meta: { requireAdminUser: true },
                path: 'manage/feedbacks/',
                name: 'ManageFeedBacks',
                component: Feedback,
            },
            {
                meta: { requireAdminUser: true },
                path: 'manage/users/',
                name: 'ManageUsers',
                component: Users,
            },
            {
                meta: { requireAuth: true },
                name: 'WatchHistory',
                path: 'watch-history',
                component: WatchHistory,
            }
        ],
    }
];

export default routes;