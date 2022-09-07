<template>
    <div class="md:w-2/3 mx-auto p-5 shadow rounded-xl my-5 vazir-fd">
        <form @submit.prevent="updateProfile">
            <div class="my-3">
                <div class="w-full flex items-center justify-center">
                    <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center text-3xl relative">
                        <img :src="userData.image_address" alt="" class="w-full rounded-full h-full">
                        <div class="absolute h-7 w-7 rounded-xl bg-red-500 shadow-xl bottom-0 right-0 text-white flex items-center justify-center text-sm overflow-hidden">
                            <ion-icon name="camera-outline"></ion-icon>
                            <input @change="setImage" type="file" class="w-full h-full absolute top-0 left-0 opacity-0 cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">نام</label>
                        <input v-model="userData.name" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.name" class="text-red-500 text-sm mt-2">{{ errors.name[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">نام خانوادگی</label>
                        <input v-model="userData.last_name" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.last_name" class="text-red-500 text-sm mt-2">{{ errors.last_name[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3" >
                <label for="">تاریخ تولد</label>
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">سال</label>
                        <input v-model="userData.birthday.year" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                    </div>
                    <div class="flex-1">
                        <label for="">ماه</label>
                        <input v-model="userData.birthday.mount" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                    </div>
                    <div class="flex-1">
                        <label for="">روز</label>
                        <input v-model="userData.birthday.day" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                    </div>
                </div>
            </div>
            <div class="my-3" >
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">گذرواژه</label>
                        <input v-model="userData.password" type="password" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.password" class="text-red-500 text-sm mt-2">{{ errors.password[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">ایمیل</label>
                        <input v-model="userData.email" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.email" class="text-red-500 text-sm mt-2">{{ errors.email[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1" >
                        <label for="">کد ملی</label>
                        <input v-model="userData.national_code" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.national_code" class="text-red-500 text-sm mt-2">{{ errors.national_code[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">شماره تماس</label>
                        <input v-model="userData.phone" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.phone" class="text-red-500 text-sm mt-2">{{ errors.phone[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3" >
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">نام شرکت</label>
                        <input v-model="userData.company" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.company" class="text-red-500 text-sm mt-2">{{ errors.company[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">شماره ثبت شرکت</label>
                        <input v-model="userData.company_registration_number" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.company_registration_number" class="text-red-500 text-sm mt-2">{{ errors.company_registration_number[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3" >
                <label for="">نوع شرکت</label>
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <button @click="userData.company_type.generative = !userData.company_type.generative" type="button" :class="'w-full rounded-xl bg-gray-100 outline-none px-3 py-2 text-center ' + (userData.company_type.generative ? 'border border-light-green' : '') ">
                            <span>تولیدی</span>
                        </button>
                    </div>
                    <div class="flex-1">
                        <button @click="userData.company_type.services = !userData.company_type.services" type="button" :class="'w-full rounded-xl bg-gray-100 outline-none px-3 py-2 text-center ' + (userData.company_type.services ? 'border border-light-green' : '') ">
                            <span>خدماتی</span>
                        </button>
                    </div>
                    <div class="flex-1">
                        <button @click="userData.company_type.commercial = !userData.company_type.commercial" type="button" :class="'w-full rounded-xl bg-gray-100 outline-none px-3 py-2 text-center ' + (userData.company_type.commercial ? 'border border-light-green' : '') ">
                            <span>بازرگانی</span>
                        </button>
                    </div>
                </div>
                <span v-if="errors.company_type" class="text-red-500 text-sm mt-2">{{ errors.company_type[0] }}</span>
            </div>
            <div class="my-3" >
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">استان</label>
                        <input v-model="userData.state" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.state" class="text-red-500 text-sm mt-2">{{ errors.state[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">شهر</label>
                        <input v-model="userData.city" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.city" class="text-red-500 text-sm mt-2">{{ errors.city[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">آدرس دقیق شرکت</label>
                        <input v-model="userData.company_exact_address" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.company_exact_address" class="text-red-500 text-sm mt-2">{{ errors.company_exact_address[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">شماره کارت</label>
                        <input v-model="userData.card_number" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.card_number" class="text-red-500 text-sm mt-2">{{ errors.card_number[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3" >
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">کد پستی</label>
                        <input v-model="userData.postal_code" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.postal_code" class="text-red-500 text-sm mt-2">{{ errors.postal_code[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="">نام کاربری مورد علاقه</label>
                        <input v-model="userData.username" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.username" class="text-red-500 text-sm mt-2">{{ errors.username[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3 flex justify-end">
                <button type="submit" class="px-3 py-2 rounded-xl bg-light-green text-white border border-light-green hover:bg-white hover:text-light-green duration-150">
                    <svg v-if="store.state.auth.loading" role="status" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">    
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    <span v-else>ثبت نام</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import toastr from 'toastr';
    import { useRouter } from 'vue-router';

    const store = useStore(); 
    const router = useRouter();

    let errors = ref({
        name: '',
        last_name: '',
        birthday: '',
        national_code: '',
        email: '',
        company: '',
        image:'',
        image_address: '',
        company_registration_number: '',
        company_type:  '',
        state: '',
        city: '',
        company_exact_address: '',
        postal_code: '',
        activity: '',
        card_number: '',
        username: '',
        password: '',
    });

    // the normal user data is different from vip
    let userData = ref({
        id: '',
        name: '',
        last_name: '',
        birthday: {year: '', mount: '', day: ''},
        national_code: '',
        email:'',
        company: '',
        image: '',
        image_address: '',
        company_registration_number: '',
        company_type: { generative: false, services: false, commercial: false },
        state: '',
        city: '',
        company_exact_address: '',
        postal_code: '',
        activity: '',
        card_number: '',
        password: '',
        username: '',
    });


    let setImage = e => {
        let file = e.target.files[0]

        let reader = new FileReader();

        reader.onload = function() {
            userData.value.image = this.result
            userData.value.image_address = this.result
        }

        if(file){
            reader.readAsDataURL(file)
        }
    }

    // update the user profile
    let updateProfile = () => {
        // check if the user is vip send another request
        store.dispatch('registerVIP', userData.value)
            .then(() => {
                router.push({ name: 'Home' });
            })
            .catch(err => {
                console.log(err.response)
                store.commit('setUserLoading', false)
                errors.value = err.response.data.errors
            })
    };
</script>

<style>
    @import 'toastr';
</style>