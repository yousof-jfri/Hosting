<template>
    <div>
        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-5">
            <div class="col-span-1">
                <div class="flex flex-col gap-5">
                    <button @click="currentProfile = 'EditProfile'; currentComponent = EditProfile" :class="'w-full rounded-xl bg-white p-5 flex items-center group duration-150 border hover:border-light-green ' + (currentProfile == 'EditProfile' ? 'border-light-green' : 'border-white') ">
                        <div :class="'h-10 w-10 rounded-xl flex items-center justify-center ' + (currentProfile == 'EditProfile' ? 'bg-light-green' : 'bg-gray-500')  ">
                            <ion-icon name="document-text-outline" class="text-white text-2xl"></ion-icon>
                        </div>
                        <span :class="'mr-3 ' +  (currentProfile == 'EditProfile' ? 'text-light-green' : '') ">اطلاعات حساب</span>
                    </button>
                    <button @click="currentProfile = 'EditPassword'; currentComponent = EditPassword" :class="'w-full rounded-xl bg-white p-5 flex items-center group duration-150 border hover:border-light-green ' + (currentProfile == 'EditPassword' ? 'border-light-green' : 'border-white') ">
                        <div :class="'h-10 w-10 rounded-xl flex items-center justify-center ' + (currentProfile == 'EditPassword' ? 'bg-light-green' : 'bg-gray-500')  ">
                            <ion-icon name="key-outline" class="text-white text-2xl"></ion-icon>
                        </div>
                        <span :class="'mr-3 ' +  (currentProfile == 'EditPassword' ? 'text-light-green' : '') ">اطلاعات رمز ورود</span>
                    </button>
                    <button @click="currentProfile = 'EditPhone'; currentComponent = EditPhone" :class="'w-full rounded-xl bg-white p-5 flex items-center group duration-150 border hover:border-light-green ' + (currentProfile == 'EditPhone' ? 'border-light-green' : 'border-white') ">
                        <div :class="'h-10 w-10 rounded-xl flex items-center justify-center ' + (currentProfile == 'EditPhone' ? 'bg-light-green' : 'bg-gray-500')  ">
                            <ion-icon name="call-outline" class="text-white text-2xl"></ion-icon>
                        </div>
                        <span :class="'mr-3 ' +  (currentProfile == 'EditPhone' ? 'text-light-green' : '') ">اطلاعات شماره موبایل   </span>
                    </button>
                </div>
            </div>


            <div class="lg:col-span-3 md:col-span-2 col-span-1">
                <div class="w-full bg-white rounded-xl p-5">
                    <keep-alive>
                        <component :is="currentComponent"></component>
                    </keep-alive>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, shallowRef } from 'vue';
import EditProfile from './EditProfile.vue';
import EditPassword from './EditPassword.vue';
import EditPhone from './EditPhone.vue';

let currentProfile = ref('EditProfile');
let currentComponent = shallowRef(EditProfile);

</script>

<style>

</style>