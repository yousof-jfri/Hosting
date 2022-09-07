<template>
    <div class="vazir-thin">
        <!-- page loading:start -->
        <div v-if="store.state.cinema.loading" class="w-screen h-screen flex items-center justify-center bg-white fixed top-0 left-0 z-50">
            <div class="flex items-center gap-5">
                <svg role="status" class="inline mr-3 w-16 h-16 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
            </div>
        </div>
        <!-- page loading:end -->

        <!-- content start -->
        <header class="w-full p-5 bg-light-green fixed top-0 left-0 z-10 vazir-bold">
            <div class="flex items-center justify-between">
                <button @click="showMobileNavbar = !showMobileNavbar" class="md:hidden flex items-center text-white">
                    <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
                </button>
                        

                <!-- navbar:start -->
                <nav>
                    <ul class="flex items-center text-white gap-5">
                        <li class="text-center">
                            <h1 class="vazir-bold"><strong>آریا سینما</strong></h1>
                            <p>لوگو</p>
                        </li>
                        <li class="md:flex items-center hidden">
                            <ion-icon name="home-outline"></ion-icon>
                            <router-link :to="{ name: 'Home' }" class="mx-2">خانه</router-link>
                        </li>
                        <li class="md:block hidden">
                            <router-link :to="{ name: 'About' }">درباره</router-link>
                        </li>
                    </ul>
                </nav>
                <!-- navbar:end -->

                <!-- search box:start -->
                <div class="p-1 rounded bg-white md:flex items-center  hidden">
                    <input type="text" class="bg-transparent outline-none px-3 text-sm" placeholder="جستجو در آریا سینما">
                    <button class="h-8 w-8 rounded bg-gray-200 flex items-center justify-center hover:text-white hover:bg-light-green duration-150">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                    <button @click="advancedSearchOpen = !advancedSearchOpen" class="h-8 px-2 rounded bg-gray-200 mr-2 hover:text-white hover:bg-light-green duration-150 vazir-fd">
                        <span>جستجو پیشرفته</span>
                    </button>
                </div>
                <!-- search box:end -->

                <!-- login and register button -->
                <button v-if="!store.state.auth.token" @click="isAuthWinOpen = !isAuthWinOpen" class="px-3 py-2 rounded bg-white text-light-green vazir-bold flex items-center " type="button">
                    <span>ورود و عضویت</span>
                    <ion-icon name="log-in-outline" class="mr-2"></ion-icon>
                </button>

                <div v-else @click="showUserMenu = !showUserMenu" class="relative">
                    <div class="flex items-center gap-3 text-white cursor-pointer">
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
            </div>
        </header>
        
        <div class="rotate-180 mt-5">
            <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="rgb(6,120,3)" />
                <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="rgb(6,120,3)"/>
            </svg>
        </div>

        <!-- mobile navber:start -->
        <div v-show="showMobileNavbar"  @click="showMobileNavbar = !showMobileNavbar" class="w-screen h-screen bg-black fixed top-0 left-0 opacity-50 md:hidden block" style="z-index: 99;"></div>
        <div  v-show="showMobileNavbar"  class="md:hidden block fixed top-0 right-0 w-2/3 h-screen bg-white border-l shadow" style="z-index: 100;">
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
        <!-- mobile navber:end -->

        <main class="md:mt-24">
            <!-- header images:start -->
            <div class="md:px-10 flex items-center justify-center h-60 py-5 gap-1 md:w-full w-">
                <div v-for="(actor, index) in actors" :key="index" class="h-full">
                    <img :src="actor.img" alt="" class="h-full rounded-xl">
                </div>
            </div>
            <!-- header images:end -->


            <!-- videos:start -->
            <div class="md:px-32">
                <div class="w-full flex items-center justify-center">
                    <div class="px-3 py-2 rounded-xl bg-light-green text-white font-bold">
                        <h4>فیلم های در حال اکران را آنلاین تماشا کنید</h4>
                    </div>
                </div>

                <!-- videos start -->
                <div class="grid md:grid-cols-3 grid-cols-2 px-2 gap-8 mt-10">
                    <div class="col-span-1" v-for="video in videos" :key="video.id">
                        <div class="w-full rounded-xl h-52 relative">
                            <div class="w-full h-full">
                                <img :src="video.poster" alt="" class="h-full w-full rounded-xl">
                            </div>
                            <div class="top-0 left-0 text-light-green text-8xl absolute h-full w-full flex items-center justify-center">
                                <ion-icon name="play-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center justify-between">
                                <h3 class="vazir-bold">{{ video.title }}</h3>
                                <span class="px-3 py-1 bg-yellow-200 text-xs rounded text-gray-600">کارگردان {{ video.director }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-3">
                                <router-link :to="{ name: 'VideoPage', params: { id: video.id } }" class="px-6 py-1 text-sm text-white bg-red-500 rounded">خرید / تماشا</router-link>
                                <a href="" class="text-sm text-light-green">جزییات</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- videos:end -->


            <!-- advanced search:start -->
            <div v-show="advancedSearchOpen">
                <div class="absolute top-0 left-0 h-screen w-screen flex justify-center">
                    <div class="md:w-1/3 h-100 bg-white shadow-xl rounded-xl p-8 z-40 relative top-10 ">
                        <AdvancedSearch @closeWin="advancedSearchOpen = !advancedSearchOpen"/>
                    </div>
                </div>
            </div>
            <!-- advanced search:end -->

            <!-- Login and Register:start -->
            <div v-show="isAuthWinOpen">
                <div @click="isAuthWinOpen = false" class="fixed top-0 left-0 h-screen w-screen bg-black opacity-20 z-40"></div>
                <div class="absolute top-0 left-0 h-screen w-screen flex items-center justify-center">
                    <div class="fixed md:w-1/3 sm:1/2 w-full bg-white rounded-xl py-5 md:px-10 px-5 z-50">

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



        </main>

        <footer class="mt-20">
            <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="rgb(187,7,7)" />
                <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="rgb(187,7,7)" />
            </svg>
        </footer>
        <div class="md:px-32 px-10 pb-5 bg-red-500">
            <div class="md:flex items-center justify-between">
                <div>
                    <h4 class="text-2xl vazir-bold text-white">صفحات مفید</h4>
                    <ul class="px-5">
                        <li class="my-5">
                            <router-link :to="{ name: 'Guide' }" class="text-white">رهنمایی سایت</router-link>
                        </li>
                        <li class="my-5">
                            <router-link :to="{ name: 'FeedBack' }" href="" class="text-white">ثبت شکایات</router-link>
                        </li>
                    </ul>
                </div>
                <div class="md:mt-0 mt-10">
                    <h4 class="text-2xl vazir-bold text-white">نماد اعتماد</h4>
                    <img src="http://127.0.0.1:8000/assets/images/sign/logo.png" alt="" class="w-24 h-24 mt-10">
                </div>
            </div>
        </div>
        <div class="w-full px-10 py-5 bg-red-500">
            <span class="text-gray-50">© تمام حقوق این سایت متعلق به آریا ویت می باشد.</span>
        </div>
    </div>
</template>

<script setup>
    import AdvancedSearch from '../../../components/frontend/AdvancedSearch.vue';
    import Login from './../../../components/frontend/Auth/Login.vue';
    import Register from './../../../components/frontend/Auth/Register.vue';
    import { ref, onMounted } from 'vue'
    import { useStore } from 'vuex';

    const store = useStore();

    // actors images for the top of the page 
    const actors = store.state.cinema.actors;

    // video list 
    const videos = ref([]);

    // Auth / login and register window
    const currentComponent = Register;
    const currentComponentStr = ref('Register');
    const isAuthWinOpen = ref(false);

    // advanced search
    const advancedSearchOpen = ref(false);

    // show the user menu
    const showUserMenu = ref(false);

    let showMobileNavbar = ref(false);

    onMounted(() => {
        store.dispatch('fetchAllVideos')
            .then(() => {
                videos.value = store.state.cinema.videos;
            })
    })

    // logout user
    function logout()
    {
        store.dispatch('logout');
    }
</script>