<template>
    <div class="text-gray-400">
        <h3 class="text-2xl vazir-bold mt-10">ورود به آریا ویت</h3>
        <form @submit.prevent="login" class="mt-5">
            <div class="my-2">
                <label for="" class="text-sm">ایمیل شما</label>
                <input type="email" v-model="user.email" :class="( errors.email ? 'border border-red-500' : '' ) + ' text-gray-600 w-full rounded-xl bg-gray-100 px-3 py-2 outline-none mt-2'">
                <span class="text-red-500" v-if="errors.email">{{ errors.email[0] }}</span>
            </div>
            <div class="my-2">
                <label for="" class="text-sm">گذرواژه پروفایل شخصی</label>
                <div :class="( errors.password ? 'border border-red-500' : '' ) + 'w-full rounded-xl bg-gray-100 p-1 outline-none mt-2 flex items-center justify-between'">
                    <input :type=" !passwordVisible ? 'password' : 'text'" v-model="user.password" class="text-gray-600 outline-none bg-transparent px-3 py-1" required>
                    
                    <div class="flex items-center">
                        <button @click="copyPass" type="button" class="h-10 w-10 rounded-xl bg-white mx-1 flex items-center justify-center hover:bg-green-500 hover:text-white duration-150">
                            <ion-icon name="copy-outline"></ion-icon>
                        </button>

                        <button type="button" @click="passwordVisible = !passwordVisible" class="h-10 w-10 rounded-xl bg-white mx-1 flex items-center justify-center hover:bg-green-500 hover:text-white duration-150">
                            <ion-icon name="eye-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <span class="text-red-500" v-if="errors.password">{{ errors.password[0] }}</span>
            </div>
            <div class="my-2 flex items-center gap-3">
                <input type="checkbox" v-model="user.remember">
                <span class="text-sm">مرا به خواطر بسپار</span>
            </div>
            <div class="mb-2 mt-5">
                <button type="submit" class="px-3 py-2 rounded-xl bg-red-500 text-white">
                    <span>ورود</span>
                    <svg v-if="store.state.auth.loading" role="status" class="inline mr-3 w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import toastr from 'toastr';

    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    const store = useStore();

    const emit = defineEmits(['closeAuth']);

    let errors = ref({});

    let user = ref({
        email: '',
        password: '',
        remember: false,
    });

    let passwordVisible = ref(false);

    function login()
    {
        store.dispatch('loginUser', user.value)
        .then(() => {
            toastr.success('به آریا سینما خوش آمدید')
            emit('closeAuth')
        })
        .catch(err => {
            store.commit('setUserLoading', false);
            console.log(err.response.data)
            toastr.error(err.response.data.message)
            if(err.response.data.errors)
            {
                errors.value = err.response.data.errors;
            }
        })
    }

    // copy password
    function copyPass()
    {
        toastr.success('متن با موفقیت کپی شد');
        navigator.clipboard.writeText(user.value.password);
    }
</script>

<style>
    @import 'toastr';
</style>