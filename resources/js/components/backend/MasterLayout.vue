<template>
    <div class="bg-gray-50">
        <!-- page loading:start -->
        <div v-if="store.state.dashboard.loading" class="w-screen h-screen flex items-center justify-center bg-white absolute top-0 left-0 z-50">
            <div class="flex items-center gap-5">
                <svg role="status" class="inline mr-3 w-16 h-16 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
            </div>
        </div>
        <!-- page loading:end -->

        <div v-else class="w-full grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 vazir-fd">
            <div class="col-span-1 relative md:h-screen">
                <div :class="'fixed p-5 bg-white shadow-xl top-0 right-0 lg:w-1/5 md:w-1/4 sm:w-1/3 w-2/3 h-screen overflow-y-auto custom-scrollbar md:block ' + (showMobileMenu ? 'block' : 'hidden')" style="z-index: 100;">
                    <div class="w-full flex flex-col items-center justify-center mt-5">
                        <h3 class="text-xl text-red-500 vazir-bold">آریا سینما لوگو</h3>

                        <div class="mt-5">
                            <div class="h-16 w-16 rounded-full bg-gray-100 overflow-hidden ring-1 ring-offset-4 ring-gray-300">
                                <img :src="'http://127.0.0.1:8000/' + store.state.dashboard.data.image" alt="" class="w-full h-full">
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <span>{{ store.state.dashboard.data.name }}</span>
                            <br>
                            <span class="vazir-thin mt-3">{{ userType }}</span>
                            <br>
                            <router-link :to="{ name: 'Profile' }" class="text-sm mt-3">
                                <ion-icon name="settings-outline"></ion-icon>
                            </router-link>
                        </div>
                    </div>

                    <div class="w-full mt-5">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'Dashboard' }" class="flex items-center justify-between px-5 py-2">
                                    <div class="flex items-center gap-5">
                                        <ion-icon name="home-outline"></ion-icon>
                                        <span>صفحه اصلی پنل</span>
                                    </div>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'Profile' }" class="flex items-center justify-between px-5 py-2">
                                    <div class="flex items-center gap-5">
                                        <ion-icon name="person-outline"></ion-icon>
                                        <span>پروفایل</span>
                                    </div>
                                </router-link>
                            </li>
                            <li v-if="store.state.dashboard.data.is_admin || store.state.dashboard.data.is_vip">
                                <button @click="showVideos = !showVideos" class="w-full flex items-center justify-between px-5 py-2">
                                    <div class="flex items-center gap-5">
                                        <ion-icon name="videocam-outline"></ion-icon>
                                        <span>ویدیو ها</span>
                                    </div>
                                    <ion-icon name="chevron-down-outline"></ion-icon>
                                </button>
                                <div v-if="showVideos" class="pr-10 text-gray-500">
                                    <ul>
                                        <li class="mt-3">
                                            <router-link :to="{ name: 'NewVideo' }">
                                                <div class="flex items-center gap-2">
                                                    <ion-icon name="ellipse-outline"></ion-icon>
                                                    <span>افزودن ویدیو جدید</span>
                                                </div>
                                            </router-link>
                                        </li>
                                        <li class="my-3">
                                            <router-link :to="{ name: 'Videos' }">
                                                <div class="flex items-center gap-2">
                                                    <ion-icon name="ellipse-outline"></ion-icon>
                                                    <span>ویدیو های شما</span>
                                                </div>
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li v-else>
                                <router-link :to="{ name: 'WatchHistory' }" class="flex items-center justify-between px-5 py-2">
                                    <div class="flex items-center gap-5">
                                        <ion-icon name="archive-outline"></ion-icon>
                                        <span>سابقه تماشا</span>
                                    </div>
                                </router-link>
                            </li>
                            <li v-if="store.state.dashboard.data.is_admin">
                                <button @click="showManagement = !showManagement" class="w-full flex items-center justify-between px-5 py-2">
                                    <div class="flex items-center gap-5">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                        <span>مدیریت سایت</span>
                                    </div>
                                    <ion-icon name="chevron-down-outline"></ion-icon>
                                </button>
                                <div v-if="showManagement" class="pr-10 text-gray-500">
                                    <ul>
                                        <li class="mt-3">
                                            <router-link :to="{ name: 'ManageUsers' }" class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <ion-icon name="ellipse-outline"></ion-icon>
                                                    <span>مدیریت کاربران</span>
                                                </div>
                                                <span class="h-5 w-5 rounded bg-red-500 flex items-center justify-center text-xs text-white">1</span>
                                            </router-link>
                                        </li>
                                        <li class="mt-3">
                                            <a href="" class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <ion-icon name="ellipse-outline"></ion-icon>
                                                    <span>مدیریت ویدیو ها</span>
                                                </div>
                                                <span class="h-5 w-5 rounded bg-red-500 flex items-center justify-center text-xs text-white">1</span>
                                            </a>
                                        </li>
                                        <li class="mt-3">
                                            <router-link :to="{ name: 'ManageFeedBacks' }" class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <ion-icon name="ellipse-outline"></ion-icon>
                                                    <span>پیشنهادات | شکایات</span>
                                                </div>
                                                <span class="h-5 w-5 rounded bg-red-500 flex items-center justify-center text-xs text-white">1</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-3 col-span-2">
                <div class="p-5 w-full flex items-center justify-between gap-5">
                    <!-- notifications:start -->
                    <div class="relative p-2">
                        <div class="flex items-center">
                            <ion-icon name="notifications-outline" class="text-xl"></ion-icon>
                            <div class="text-xs absolute top-0 right-0 bg-red-500 text-white rounded-full h-4 w-4 flex items-center justify-center">
                                <span class="">1</span>
                            </div>
                        </div>
                    </div>
                    <!-- notifications:end -->

                    <!-- user menu:start -->
                    <div @click="showUserMenu = !showUserMenu"  class="relative">
                        <div class="flex items-center gap-3 cursor-pointer">
                            <div class="rounded-full h-8 w-8 overflow-hidden">
                                <img :src="'http://127.0.0.1:8000/'+store.state.dashboard.data.image" alt="">
                            </div>
                            <span>{{ store.state.dashboard.data.name }}</span>
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </div>
                        <div v-if="showUserMenu" class="absolute top-10 left-0 bg-white rounded-xl border overflow-hidden">
                            <ul>
                                <li>
                                    <a href="" class="flex items-center gap-5 w-40 px-3 py-2 duration-150 hover:bg-gray-100">
                                        <ion-icon class="text-xl" name="person-circle-outline"></ion-icon>
                                        <span>حساب کاربری</span>
                                    </a>
                                </li>
                                <li>
                                    <button @click="logout" class="flex items-center gap-5 w-40 px-3 py-2 duration-150 hover:bg-gray-100">
                                        <ion-icon class="text-xl" name="log-out-outline"></ion-icon>
                                        <span>خروج</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- user menu:end -->

                    <!-- toggle menu:start -->
                    <div class="relative p-2 md:hidden block" @click="showMobileMenu = !showMobileMenu">
                        <div class="flex items-center">
                            <ion-icon name="menu-outline" class="text-xl"></ion-icon>
                        </div>
                    </div>
                    <!-- toggle menu:end -->
                </div>

                <!-- main content:start -->
                <div class="p-5">
                    <router-view></router-view>
                </div>
                <!-- main content:end -->
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useStore } from 'vuex';
    import { useRouter } from 'vue-router';
    import { ref, computed } from 'vue';

    const router = useRouter();
    const store = useStore();

    let showUserMenu = ref(false);

    const userType = computed(() => {
        if(store.state.dashboard.data.is_admin)
        {
            return 'مدیر سایت';
        }else if(store.state.dashboard.data.is_vip){
            return 'کاربر ویژه';
        }else {
            return 'کاربر عادی';
        }
    });

    let showVideos = ref(false);
    let showManagement = ref(false);
    let showMobileMenu = ref(false);

    let logout = () => {
        store.dispatch('logout');
        router.push({ name: 'Home' });
    };


    // check the user permissions
    if(store.state.auth.data.id)
    {
        store.dispatch('getUserPermissions', store.state.auth.data.id)
            .then(() => {})
            .catch(() => {
                logout();
            })
    }else {
        router.push({ name: 'Home' })
    }
</script>