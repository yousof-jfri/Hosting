<template>
    <div>
        <form @submit.prevent="editPhone">
            <span class="text-xl vazir-bold">ویرایش رمز ورود</span>
            <div class="my-3" v-if="phoneData.currentPhone">
                <div class="flex-1">
                    <label for="">شماره تماس فعلی</label>
                    <input v-model="phoneData.currentPhone" disabled type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                </div>
            </div>
            <div class="my-3">
                <div class="flex-1">
                    <label for="">شماره تماس جدید</label>
                    <input v-model="phoneData.newPhone" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                    <span v-if="errors.newPhone" class="text-red-500">{{ errors.newPhone[0] }}</span>
                </div>
            </div>
            <div class="my-3 flex justify-end">
                <button type="submit" class="px-3 py-2 rounded-xl bg-light-green text-white border border-light-green hover:bg-white hover:text-light-green duration-150">
                    <svg v-if="store.state.profile.loading" role="status" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">    
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    <span v-else>ذخیره تغییرات</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import toastr from 'toastr';

    const store = useStore();

    let errors = ref({});

    let phoneData = ref({
        userId: store.state.dashboard.data.id,
        currentPhone: store.state.dashboard.data.phone,
        newPhone: '',
    });

    let editPhone = () => {
        store.dispatch('editPhoneNumber', phoneData.value)
            .then(() => {
                toastr.success("شماره تماس با موفقیت ویرایش شد");
            })
            .catch(err => {
                console.log(err)
                store.commit('setProfileLoading', false);
                toastr.error('مشلکی در ویرایش پیش آمد، لطفا فیلد ها را برسی کنید')
                errors.value = err.response.data.errors;
            })
    };
</script>

<style>
    @import 'toastr';
</style>