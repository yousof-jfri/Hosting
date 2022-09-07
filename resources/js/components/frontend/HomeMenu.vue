<template>
    <div class="vazir-fd">
        <!-- menu:start -->
        <header class="w-full px-7 md:py-5 py-3 bg-white shadow-xl fixed block top-0 z-30">
            <!-- desktop header:start -->
            <nav class="md:flex items-center justify-between hidden">
                <!-- menu lists:start -->
                <ul class="flex gap-5">
                    <li>
                        <router-link :to="{ name: 'About' }">درباره ما</router-link>
                    </li>
                    <li>
                        <a href="">تماس با ما</a>
                    </li>
                    <li>
                        <router-link :to="{ name: 'FeedBack' }">ارسال پیشنهادات</router-link>
                    </li>
                    <li>
                        <a href="">معرفی</a>
                    </li>
                    <li>
                        <a href="">بازخورد های مردمی</a>
                    </li>
                </ul>
                <!-- menu lists:start -->

                <!-- login and register:start -->
                <button v-if="!store.state.auth.token" type="button" @click="isAuthWinOpen = !isAuthWinOpen" class="px-4 py-2 bg-green-500 rounded-xl text-white flex items-center">
                    <span class="ml-2">ورود و عضویت</span>
                    <ion-icon name="log-in-outline" class="text-xl"></ion-icon>
                </button>
                <!-- login and register:end -->

                <div v-else @click="showUserMenu = !showUserMenu" class="relative">
                    <div class="flex items-center gap-3 cursor-pointer">
                        <div class="rounded-full h-8 w-8 overflow-hidden">
                            <img :src="'http://127.0.0.1:8000/'+store.state.auth.data.image" alt="">
                        </div>
                        <span>{{ store.state.auth.data.name }}</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                    <div v-if="showUserMenu" class="absolute top-10 left-0 bg-white rounded-xl border overflow-hidden">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'Admin' }" class="flex items-center gap-5 w-40 px-3 py-2 duration-150 hover:bg-gray-100">
                                    <ion-icon class="text-xl" name="person-circle-outline"></ion-icon>
                                    <span>حساب کاربری</span>
                                </router-link>
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

            </nav>
            <!-- desktop header:end -->

            <!-- mobile menu:start -->
            <nav class="md:hidden flex items-center justify-between">
                <button @click="showMobileNavbar = !showMobileNavbar" class="flex items-center">
                    <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
                </button>

                <!-- login and register:start -->
                <button v-if="!store.state.auth.token" type="button" @click="isAuthWinOpen = !isAuthWinOpen" class="px-4 py-2 bg-green-500 rounded-xl text-white flex items-center md:text-base text-sm">
                    <span class="ml-2">ورود و عضویت</span>
                    <ion-icon name="log-in-outline" class="text-xl"></ion-icon>
                </button>
                <!-- login and register:end -->

                <div v-else @click="showUserMenu = !showUserMenu" class="relative md:text-base text-sm">
                    <div class="flex items-center gap-3 cursor-pointer">
                        <div class="rounded-full h-8 w-8 overflow-hidden">
                            <img :src="'http://127.0.0.1:8000/'+store.state.auth.data.image" alt="">
                        </div>
                        <span>{{ store.state.auth.data.name }}</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                    <div v-if="showUserMenu" class="absolute top-10 left-0 bg-white rounded-xl border overflow-hidden">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'Admin' }" class="flex items-center gap-5 w-40 px-3 py-2 duration-150 hover:bg-gray-100">
                                    <ion-icon class="text-xl" name="person-circle-outline"></ion-icon>
                                    <span>حساب کاربری</span>
                                </router-link>
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
            </nav>
            <!-- mobile menu:end -->
        </header>
        <!-- menu:end -->

        <!-- mobile navbar start -->
        <div v-show="showMobileNavbar"  @click="showMobileNavbar = !showMobileNavbar" class="w-screen h-screen bg-black fixed top-0 left-0 opacity-50 md:hidden block" style="z-index: 99;"></div>
        <div v-show="showMobileNavbar" class="w-2/3 fixed h-screen bg-white shadow top-0 md:hidden block border" style="z-index: 100;">
            <div class="w-full bg-red-500 p-5">
                <h1 class="text-white text-xl">آریا سینما</h1>
            </div>
            <div class="p-5">
                <span class="text-xl vazir-bold">صفحات سایت</span>
                <ul class="flex flex-col gap-5 mt-5">
                    <li>
                        <router-link :to="{ name: 'About' }">درباره ما</router-link>
                    </li>
                    <li>
                        <a href="">تماس با ما</a>
                    </li>
                    <li>
                        <router-link :to="{ name: 'FeedBack' }">ارسال پیشنهادات</router-link>
                    </li>
                    <li>
                        <a href="">معرفی</a>
                    </li>
                    <li>
                        <a href="">بازخورد های مردمی</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mobile navbar end -->

        <!-- main content:start -->
        <div class="h-screen w-screen md:flex items-center justify-center border-box">
            <router-view></router-view>

            <!-- Login and Register:start -->
            <div v-show="isAuthWinOpen">
                <div @click="isAuthWinOpen = false" class="absolute top-0 left-0 h-screen w-screen bg-black opacity-20 z-40"></div>
                <div class="absolute top-0 left-0 h-screen w-screen flex items-center justify-center">
                    <div class="md:w-1/3 sm:1/2 w-full bg-white rounded-xl py-5 md:px-10 px-5 z-50">

                        <div class="flex items-center justify-center">
                            <div :class="'p-1 rounded flex items-center duration-150 ' + ( currentComponentStr == 'Login' ? 'bg-green-500' : 'bg-red-500' )">
                                <button @click="currentComponent = Login; currentComponentStr = 'Login'" :class="'px-7 py-1 rounded duration-150 ' + (currentComponentStr == 'Login' ? 'bg-white text-green-500' : 'text-white')">ورود</button>
                                <button @click="currentComponent = Register; currentComponentStr = 'Register'" :class="'px-7 py-1 rounded duration-150 ' + (currentComponentStr == 'Register' ? 'bg-white text-red-500' : 'text-white')">ثبت نام</button>
                            </div>
                        </div>
                        <keep-alive>
                            <component @closeAuth="isAuthWinOpen = false" :is="currentComponent"/>
                        </keep-alive>
                    </div>
                </div>
            </div>
            <!-- Login and Register:end -->

            <div class="md:hidden bg-white block fixed bottom-0 left-0 px-10 py-3 w-full">
                <ul class="flex items-center justify-between w-full">
                    <li>
                        <a href="" class="flex flex-col items-center justify-center gap-1">
                            <ion-icon name="home-outline"></ion-icon>
                            <p class="text-xs">خانه</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex flex-col items-center justify-center gap-1">
                            <ion-icon name="search-outline"></ion-icon>
                            <p class="text-xs">جستجو</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex flex-col items-center justify-center gap-1">
                            <ion-icon name="heart-half-outline"></ion-icon>
                            <p class="text-xs">ژانر ها</p>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script setup>
    import Login from './../../components/frontend/Auth/Login.vue';
    import Register from './../../components/frontend/Auth/Register.vue';
    import { ref } from 'vue';
    import { useStore } from 'vuex';

    const store = useStore();

    let currentComponent = Register;
    let currentComponentStr = ref('Register');

    let isAuthWinOpen = store.state.auth.token ? false : ref(false);

    let showUserMenu = ref(false);

    let showMobileNavbar = ref(false);

    function logout()
    {
        store.dispatch('logout');
    }
</script>