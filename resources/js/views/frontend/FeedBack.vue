<template>
    <div>
        <div class="rotate-180">
            <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="rgb(6,120,3)" />
                <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="rgb(6,120,3)" />
            </svg>
        </div>
        <div class="md:px-32 px-5 py-10">
            <h3 class="vazir-bold text-3xl super-bg">انتقادات | پیشنهادات</h3>
            <div class="w-full flex items-center justify-center">
                <div class="md:w-2/3 vazir-fd">
                    <form @submit.prevent="sendFeedBack">
                        <div class="grid md:grid-cols-2 col-span-1 gap-5">
                            <div class="col-span-1">
                                <div class="my-3" v-if="!store.state.auth.data">
                                    <label for="">نام</label>
                                    <input v-model="feedbackData.name" type="text" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2">
                                    <span v-if="errors.name" class="text-red-500">{{ errors.name[0] }}</span>
                                </div>
                                <div class="my-3" v-if="!store.state.auth.data">
                                    <label for="">نام خانوادگی</label>
                                    <input v-model="feedbackData.last_name" type="text" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2">
                                    <span v-if="errors.last_name" class="text-red-500">{{ errors.last_name[0] }}</span>
                                </div>
                                <div class="my-3" v-if="!store.state.auth.data">
                                    <label for="">ایمیل</label>
                                    <input v-model="feedbackData.email" type="text" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2">
                                    <span v-if="errors.email" class="text-red-500">{{ errors.email[0] }}</span>
                                </div>
                                <div class="my-3 flex md:flex-row flex-col gap-2 items-center">
                                    <div class="flex-1">
                                        <div class="my-3">
                                            <label for="">شماره تماس</label>
                                            <input v-model="feedbackData.phone" type="text" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2">
                                            <span v-if="errors.phone" class="text-red-500">{{ errors.phone[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label for="">موضوع بازخورد</label>
                                            <select v-model="feedbackData.issue" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2">
                                                <option value="upload">آپلود فیلم</option>
                                                <option value="watch">تماشای فیلم</option>
                                                <option value="normalUser">کاربران ویژه</option>
                                                <option value="VIPUser">کاربران عادی</option>
                                                <option value="discount_price">تخفیف ها و قیمت ها</option>
                                                <option value="license">مجوز ها</option>
                                                <option value="site_problems">مشکلات سایت</option>
                                                <option value="report">گزازش تخلفات</option>
                                                <option value="more">سایر</option>
                                            </select>
                                        <span v-if="errors.issue" class="text-red-500">{{ errors.issue[0] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="my-3">
                                    <label for="">متن پیشنهاد</label>
                                    <textarea v-model="feedbackData.feedback" rows="8" class="w-full px-3 py-2 bg-gray-100 rounded-xl outline-none mt-2"></textarea>
                                    <span v-if="errors.feedback" class="text-red-500">{{ errors.feedback[0] }}</span>
                                </div>
                                <div class="my-3 flex items-center gap-5">
                                    <button type="button" class="relative bg-light-green flex-1 px-3 py-2 rounded-xl text-white border border-light-green hover:bg-white duration-150 hover:text-light-green overflow-hidden">
                                        <span>انتخواب فایل پیشنهاد</span>
                                        <input type="file" class="absolute top-0 left-0 h-full w-full opacity-0">
                                    </button>
                                    <button type="submit" class="bg-red-500 flex-1 px-3 py-2 rounded-xl text-white border border-red-500 hover:bg-white duration-150 hover:text-red-500">ارسال پیشنهاد</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                            <component :is="currentComponent"/>
                        </keep-alive>
                    </div>
                </div>
            </div>
            <!-- Login and Register:end -->


        <!-- <div class=""> -->
            <div class="md:absolute bottom-0 left-0 w-full">
                <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                    <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="rgb(187,7,7)" />
                    <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="rgb(187,7,7)" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 w-full md:px-10 px-5 py-5 vazir-fd text-center">
                <ul class="flex items-center gap-5">
                    <li class="text-white">
                        <router-link :to="{ name: 'Cinema' }">بازگشت</router-link>
                    </li>
                    <li class="text-white">
                        <router-link :to="{ name: 'Home' }">صفحه اصلی</router-link >
                    </li>
                    <li class="text-white" v-if="!store.state.auth.token">
                        <button @click="isAuthWinOpen = true">ورود و عضویت</button>
                    </li>
                </ul>
            </div>
        <!-- </div> -->
    </div>
</template>

<script setup>
    import Login from './../../components/frontend/Auth/Login.vue';
    import Register from './../../components/frontend/Auth/Register.vue';
    import { useStore } from 'vuex'
    import { ref } from 'vue'
    import Swal from 'sweetalert2'

    const store = useStore();

    let errors = ref({
        name: null,
        last_name: null,
        email: null,
        feedback: null,
        issue: null,
        phone: null,
    });

    let feedbackData = ref({
        name: store.state.auth.data ? store.state.auth.data.name : '',
        last_name: store.state.auth.data ? store.state.auth.data.last_name : '',
        email: store.state.auth.data ? store.state.auth.data.email : '',
        feedback: '',
        issue: 'upload',
        phone: '',
    });

    let sendFeedBack = () => {
        store.dispatch('sendFeedBack', feedbackData.value)
            .then(() => {
                Swal.fire({
                    title: 'پیشنهاد و انتقاد شما ارسال شد',
                    text: 'پیشنهاد شما توسط مدیریت برسی خواهد شد',
                })
                feedbackData.value = {
                    name: '',
                    last_name: '',
                    email: '',
                    feedback: '',
                    issue: 'upload',
                    phone: '',
                };
            })
            .catch(err => {
                errors.value = err.response.data.errors
                Swal.fire({
                    icon: 'error',
                    title: 'مشکلی در فرستادن بازخورد پیش آمد',
                    text: 'لطفا تمام فیلد ها را برسی و دوباره امتحان کنید',
                })
            }) 
    }

    // Auth / login and register window
    const currentComponent = Register;
    const currentComponentStr = ref('Register');
    const isAuthWinOpen = ref(false);
</script>

<style>

</style>