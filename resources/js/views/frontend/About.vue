<template>
    <div>
        <div class="rotate-180">
            <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="rgb(6,120,3)" />
                <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="rgb(6,120,3)" />
            </svg>
        </div>
        <div class="md:px-32 px-5 py-10">
            <h3 class="vazir-bold text-3xl super-bg">درباره آریا ویت</h3>
            <p class="mt-5 leading-10 vazir-fd px-10">سلام 😍 آریاویت سینما جاییه که می‌تونی فیلم‌های روی پرده‌های سینماهای سراسر کشور را آنلاین تماشا کنی.
                آریاویت سینما با سالن‌های سینما همکاری می‌کنه؛ این همکاری شامل قرار دادن پروفایل شخصی برای هر یک از سالن‌های سینما است که در وبسایت
                آریاویت ثبت‌نام کرده باشند.
                همچنین نیازهای سینمای کشور بویژه در بخش سالن‌های نمایش مورد توجه قرار گرفته و تیم سینمایی آریاویت آماده همکاری دو جانبه و سازنده با 
                سالن‌های سینما، فیلمسازان، تهیه کنندگان، کارگردانان و سایر اهالی محترم سینما است.
                این عزیزان می‌توانند اینجا ثبت‌نام کنند.
                ثبتنام بصورت رایگان درنظر گرفته شده است و هزینه ای برای این عزیزان ندارد.
                در صورت نیاز به مشاوره تخصصی وارد قسمت ارسال پیشنهادات بشوید و برای ما پیام بگذارید.</p>
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
                    <li class="text-white">
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
    import { ref } from 'vue'

    // Auth / login and register window
    const currentComponent = Register;
    const currentComponentStr = ref('Register');
    const isAuthWinOpen = ref(false);
</script>

<style>

</style>