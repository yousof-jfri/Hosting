<template>
    <div class="p-10">
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

        <div class="w-full grid md:grid-cols-5 gap-5">
            <div class="md:col-span-2">
                <div class="bg-white p-5 shadow-xl rounded-b-xl relative mt-10 ">
                    <ul class="absolute flex items-center justify-start top-[-30px] right-0">
                        <li class="ml-5">
                            <button @click="infoOpen = true" :class="'px-2 py-1 rounded-t-xl vazir-bold bg-white z-50 ' + ( infoOpen ? 'text-red-500' : '' ) ">
                                <span>اطلاعات فیلم</span>
                            </button>
                        </li>
                        <li>
                            <button @click="infoOpen = false" :class="'px-2 py-1 rounded-t-xl vazir-bold bg-white z-50 ' + ( infoOpen ? '' : 'text-red-500' )">
                                <span>توضیحات</span>
                            </button>
                        </li>
                    </ul>

                    <!-- info -->
                    <div v-show="infoOpen">
                        <div class="flex vazir-fd">
                            <ul>
                                <li class="flex items-center my-2">
                                    <ion-icon name="film-outline"></ion-icon>
                                    <span class="mx-2">نام فیلم</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="person-outline"></ion-icon>
                                    <span class="mx-2">کارگردان</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <img src="http://127.0.0.1:8000/assets/images/icons/genr.png" alt="" class="w-5 h-5">
                                    <span class="mx-2">ژانر</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="calendar-outline"></ion-icon>
                                    <span class="mx-2">تاریخ تولید فیلم</span>
                                </li>
                                <li class="flex items-center my-2 gap-1">
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="people-outline"></ion-icon>
                                    <span class="mx-2">بازیگران</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="people-outline"></ion-icon>
                                    <span class="mx-2">نویسنده گان</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="location-outline"></ion-icon>
                                    <span class="mx-2">کشور سازنده</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="create-outline"></ion-icon>
                                    <span class="mx-2">نویسنده</span>
                                </li>
                            </ul>
                            <ul>
                                <li class="flex items-center my-2">
                                    <span>{{ video.title }}</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <span>{{ video.director }}</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <span>{{ video.genre }}</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <span>{{ video.release }}</span>
                                </li>
                                <li class="flex items-center my-2">
                                    <ion-icon name="star-outline"></ion-icon>
                                </li>
                                <li class="flex items-center my-2">
                                    <span class="p-1 rounded bg-blue-400 text-white mr-1 text-xs" v-for="(actor, index) in video.actors" :key="index">
                                        {{ actor.name }}
                                    </span> 
                                </li>
                                <li class="flex items-center my-2">
                                    <span class="p-1 rounded bg-blue-400 text-white mr-1 text-xs" v-for="(writer, index) in video.writers" :key="index">
                                        {{ writer.name }}
                                    </span> 
                                </li>
                                <li class="flex items-center my-2">
                                    <span>{{ video.contry }}</span>
                                </li>
                                 <li class="flex items-center my-2">
                                    <span>{{ video.director }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- description -->
                    <div v-show="!infoOpen"> 
                        <p class="vazir-fd leading-10">{{ video.description }}</p>
                    </div>
                </div>
                <button class="w-full mt-5 px-3 py-2 rounded-xl bg-red-500 text-white vazir-bold text-xl">
                    <span>خرید</span>
                </button>
            </div>
             <div class="md:col-span-3">
                <div class="bg-white p-5 shadow-xl rounded-xl vazir-bold">
                    <div class="w-full h-96 rounded-xl overflow-hidden">
                        <video v-if="video.teaser" width="400" controls class="w-full">
                            <source :src="video.teaser" type="video/mp4">
                            <source :src="video.teaser" type="video/mvc">
                            <source :src="video.teaser" type="video/ogg">
                            مرور گر شما نمیتواند این ویدیو رو ساپورت کند
                        </video>
                    </div>
                    <div class="mt-5 flex items-center gap-5 flex-wrap text-sm">

                        <div class="rounded-xl bg-blue-400 flex items-center pr-3 pl-1 py-1 gap-5">
                            <span class="text-white">قیمت فیلم</span>
                            <div class="px-3 py-1 rounded-xl bg-white flex text-blue-400 gap-2">
                                <span>{{ video.price }}</span>
                                <span>ریال</span>
                            </div>
                        </div>

                        <div class="rounded-xl bg-blue-400 flex items-center pr-3 pl-1 py-1 gap-5">
                            <span class="text-white">تخفیف از طرف آپلود کننده</span>
                            <div class="px-3 py-1 rounded-xl bg-white flex text-blue-400 gap-2">
                                <span>{{ video.discountFromUser }}</span>
                                <span>%</span>
                            </div>
                        </div>

                        <div class="rounded-xl bg-blue-400 flex items-center pr-3 pl-1 py-1 gap-5">
                            <span class="text-white">تخفیف از طرف برنامه</span>
                            <div class="px-3 py-1 rounded-xl bg-white flex text-blue-400 gap-2">
                                <span>{{ video.discountFromProgram }}</span>
                                <span>%</span>
                            </div>
                        </div>
                         <div class="rounded-xl bg-blue-400 flex items-center pr-3 pl-1 py-1 gap-5">
                            <span class="text-white">قیمت نهایی</span>
                            <div class="px-3 py-1 rounded-xl bg-white flex text-blue-400 gap-2">
                                <span>{{ afterDiscount }}</span>
                                <span>ریال</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="bg-white p-5 shadow-xl rounded-xl vazir-fd mt-5">
                    <div class="flex items-center w-full gap-5">
                        <div class="flex-1">
                            <label for="" class="mb-2">استان</label>
                            <select name="" id="" class="px-3 py-1 rounded bg-gray-100 w-full">
                                <option value="">یک استان انتخاب کنید</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="" class="mb-2">شهرستان</label>
                            <select name="" id="" class="px-3 py-1 rounded bg-gray-100 w-full">
                                <option value="">یک استان انتخاب کنید</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="" class="mb-2">کاربر ویژه</label>
                            <select name="" id="" class="px-3 py-1 rounded bg-gray-100 w-full">
                                <option value="">یک استان انتخاب کنید</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, computed } from 'vue';
    import { useStore } from 'vuex';
    import { useRoute } from 'vue-router';


    const store = useStore();
    const route = useRoute();
    let video = ref({});

    // which part is currenty open description or film info 
    let infoOpen = ref(true);
    
    let afterDiscount = computed(() => (video.value.price / 100) * (100 - (Number(video.value.discountFromProgram) + Number(video.value.discountFromUser))) );

    onMounted(() => {
        if(route.params.id)
        {
            store.dispatch('getVideo', { videoId: route.params.id, userId: store.state.auth.data ? store.state.auth.data.id : 0 })
            .then(() => {
                video.value = store.state.cinema.currentVideo;
            })
        }
    })
</script>

<style>

</style>