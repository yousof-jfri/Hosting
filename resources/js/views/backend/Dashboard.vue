<template>
    <div class="vazir-fd">
        <div class="w-full rounded-xl bg-white px-5 py-10 flex md:flex-row flex-col items-center justify-center">
            <div class="md:flex-1 md:w-auto w-full flex items-center flex-col justify-center">
                <div class="h-20 w-20">
                    <img src="http://127.0.0.1:8000/assets/images/icons/play.png" alt="">
                </div>
                <div class="flex items-center justify-center gap-3">
                    <span class="my-3">ویدیو های شما</span>
                    <button @click="showVideosDetail" class="text-green-500">
                        <ion-icon name="information-circle-outline"></ion-icon>
                    </button>
                </div>
                <span class="text-xl">{{ userVideos.length }}</span>
            </div>
            <div class="md:flex-1 md:w-auto w-full flex items-center flex-col justify-center border-r">
                <div class="h-20 w-20">
                    <img src="http://127.0.0.1:8000/assets/images/icons/reward.png" alt="">
                </div>
                <div class="flex items-center justify-center gap-3">
                    <span class="my-3">نوع کاربری شما</span>
                    <button @click="showUserDetail" class="text-green-500">
                        <ion-icon name="information-circle-outline"></ion-icon>
                    </button>
                </div>
                <span class="text-xl">{{ userType }}</span>
            </div>
            <div class="md:flex-1 md:w-auto w-full flex items-center flex-col justify-center border-r">
                <div class="h-20 w-20">
                    <img src="http://127.0.0.1:8000/assets/images/icons/money.png" alt="">
                </div>
                <div class="flex items-center justify-center gap-3">
                    <span class="my-3">امتیاز شما</span>
                    <button @click="showScoreDetail" class="text-green-500">
                        <ion-icon name="information-circle-outline"></ion-icon>
                    </button>
                </div>
                <span class="text-xl">0</span>
            </div>
        </div>
        <div class="mt-5 grid lg:grid-cols-2 grid-cols-1 gap-5">
            <div v-if="store.state.dashboard.data.is_vip" class="col-span-1">
                <div class="w-full p-5 rounded-xl bg-white">
                    <div class="w-full flex items-center justify-between">
                        <span>ویدیو های شما</span>
                    </div>
                    <div class="mt-5">
                        <div class="text-center "  v-if="!userVideos.length > 0">
                            <span>شما تا کنون هیچ ویدیو ای آپلود نکردید</span>
                        </div>
                        <div v-else v-for="video in userVideos" :key="video.id" class="w-full p-1 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-start gap-5 my-1">
                            <div class="h-28 w-1/3 rounded-xl overflow-hidden">
                                <img :src="video.poster" alt="" class="w-full object-cover rounded-xl">
                            </div>
                            <div class="h-28 text-right py-5">
                                <span>{{ video.title }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <router-link :to="{ name: 'Videos' }" class="text-red-500">مشاهده همه</router-link>
                    </div>
                </div>

                <!-- your videos view component:start -->
                <div class="w-full p-5 rounded-xl bg-white mt-5">
                    <div class="w-full flex items-center justify-between">
                        <span>امار بازدید ویدیو های شما</span>
                    </div>
                    <div class="mt-5">
                        <LineChart :views="store.state.dashboard.videoViews"/>
                    </div>
                </div>
                <!-- your videos view component:end -->

            </div>
            <div class="col-span-1">
                <div class="w-full p-5 rounded-xl bg-white">
                    <div class="w-full flex items-center justify-between">
                        <span>ویدیو های پیشنهادی</span>
                    </div>
                    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 mt-5">
                        <router-link :to="{ name: 'VideoPage', params: { id: video.id } }" class="col-span-1" v-for="video in store.state.dashboard.randomVideo" :key="video.id">
                            <div class="h-32 rounded-xl overflow-hidden">
                                <img :src="video.poster" alt="" class="w-full object-cover rounded-xl">
                            </div>
                            <span class="mt-2">{{ video.title }}</span>
                        </router-link>
                    </div>
                </div>

                <!-- your videos wallet component:end -->
                <div class="w-full p-5 rounded-xl bg-white mt-10" v-if="store.state.dashboard.data.is_vip">
                    <div class="w-full flex items-center justify-between">
                        <span>آمار درامد شما از سایت</span>
                        <div class="flex items-center gap-3">
                            <span>کیف پول شما</span>
                            <span class="text-green-400">0 تومان</span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <BarChart/>
                    </div>
                </div>

                <!--  -->
                <div class="w-full p-5 rounded-xl bg-white mt-10" v-if="store.state.dashboard.data.is_vip">
                    <div class="w-full flex items-center justify-between">
                        <span>مشخصات کسانی که ویدیو شما را دیده اند</span>
                    </div>
                    <div class="mt-5">
                        <DoughnutChart :users="store.state.dashboard.watcherType"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { computed } from 'vue'
    import { useStore } from 'vuex'
    import Swal from 'sweetalert2'
    import LineChart from '../../components/backend/Chart/LineChart.vue';
    import BarChart from '../../components/backend/Chart/BarChart.vue';
    import DoughnutChart from '../../components/backend/Chart/DoughnutChart.vue';
    
    const store = useStore();

    let userVideos = store.state.dashboard.userVideos;

    let showVideosDetail = () => {
        Swal.fire({
            title: 'ویدیو های شما در آریا ویت',
            html: `<p class='vazir-fd'>شما در حال حاضر ${ userVideos.length } ویدیو در آریا سینما دارید کاربران با خرید ویدیو های شما میتوانند از محتوای شما استفاده کنند</p>` 
                + `<br> <p class='vazir-fd'>فقط کاربران ویژه توانایی آپلود ویدیو رو دارند و می توانند از آریا سینما درامد کسب کنند</p>`
                + `<br> <p class='vazir-fd'>کاربران عادی سایت نیز به ویدیو های کاربران ویژه دسترسی دارند و می توانند با خرید ویدیو ها از تماشای آنها لذت ببرید</p>`
        })
    }

    let showUserDetail = () => {
        Swal.fire({
            title: 'نوع کاربری شما در آریا سینما',
            html: `<p class='vazir-fd'>شما در حال حاضر یک  ${ userType.value } هستید</p>` 
                + `<br> <p class='vazir-fd'>فقط کاربران ویژه توانایی آپلود ویدیو رو دارند و می توانند از آریا سینما درامد کسب کنند</p>`
                + `<br> <p class='vazir-fd'>کاربران عادی سایت نیز به ویدیو های کاربران ویژه دسترسی دارند و می توانند با خرید ویدیو ها از تماشای آنها لذت ببرید</p>`
        })
    }

    let showScoreDetail = () => {
        Swal.fire({
            title: 'امتیاز گرفتن در آریا سینما',
            html: `<p class='vazir-fd'>شما میتواندی با فعالیت هایی مثل share کردن یک ویدیو امتیاز به دست بیارید و از امتیاز ها توی گرفتن تخفیف از ویدیو استفاده کنید</p>` 
                + `<br> <p class='vazir-fd'>حداقل تخفیف توسط امتیاز ها 50 درصد میباشد و اگه شما بیشتر از 50 امتیاز دارید بین هر ویدیو تقسیم میشود</p>`
                + `<br><br><h3 class="text-xl vazir-fd">جدول امتیازات شما</h3>`
                + `
                    <table class="w-full vazir-fd mt-3">
                        <thead>
                            <tr>
                                <th class="border px-2 text-sm">#</th>
                                <th class="border px-2 text-sm">فعالیت شما</th>
                                <th class="border px-2 text-sm">مقدار امتیاز دریافت شده</th>
                            </tr>    
                        </thead>    
                        <tbody>
                            <tr>
                                <th class="border px-2 text-sm">0</th>
                                <th class="border px-2 text-sm">شما هیچ فعالیتی نداشته اید</th>
                                <th class="border px-2 text-sm">0</th>
                            </tr>
                        </tbody>
                    </table>
                `
        })
    };  

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
</script>

<style>

</style>