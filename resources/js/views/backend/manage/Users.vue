<template>
    <div class="w-full overflow-hidden rounded-xl bg-white p-5">
        <!-- card header:start -->
        <div class="w-full  bg-white">
            <div class="w-full flex items-center justify-between">
                <span class="text-xl">کاربران</span>
            </div>
        </div>
        <!-- card header:end -->

        <!-- card body:start -->
        <div class="p-5 text-center bg-gray-100 rounded-xl mt-5">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">نام</th>
                        <th class="px-3 py-2">نام خانواده گی</th>
                        <th class="px-3 py-2">ایمیل</th>
                        <th class="px-3 py-2">نوع کاربر</th>
                        <th class="px-3 py-2">وضعیت</th>
                        <th class="px-3 py-2">تغییرات</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(user, index) in users" :key="index" :class="isOdd(index) ? 'bg-gray-100' : 'bg-white'">
                        <td class="px-3 py-2">{{ user.id }}</td>
                        <td class="px-3 py-2">{{ user.name }}</td>
                        <td class="px-3 py-2">{{ user.last_name }}</td>
                        <td class="px-3 py-2">{{ user.email }}</td>
                        <td class="px-3 py-2">
                            <span v-if="user.is_admin == 1" class="px-2 py-1 rounded bg-gold-yellow text-white text-xs">مدیر سایت</span>
                            <span v-else-if="user.is_vip == 1" class="px-2 py-1 rounded bg-green-500 text-white text-xs">کاربر ویژه</span>
                            <span v-else class="px-2 py-1 rounded bg-gray-500 text-white text-xs">کاربر عادی</span>
                        </td>
                        <td class="px-3 py-2">
                            <span v-if="user.limited != 0" class="px-2 py-1 rounded bg-red-500 text-white text-xs">خوانده نشده</span>
                            <span v-else class="px-2 py-1 rounded bg-green-500 text-white text-xs">محدود نشده</span>
                        </td>
                        <td class="px-3 py-2">
                            <button @click="showUser(user)" class="rounded bg-light-green px-3 py-1 text-white text-sm">مشاهده</button>
                            <button @click="delete(feedback.id)" class="rounded bg-red-500 px-2 mx-1 py-1 text-white text-sm">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- card footer:start -->
        <div class="w-full p-5 bg-gray-100 flex items-center justify-center mt-10 rounded-b-xl">
            <!-- pagination:start -->
            <div class="w-full flex items-center justify-center gap-2">
                <button v-for="(link, index) in store.state.manage.links" @click="changePage(link)" :key="index" :class="'h-8 w-8 rounded-xl flex items-center justify-center duration-150 ' + (link.active ? 'bg-light-green text-white hover:bg-white hover:text-gray-700' : 'bg-white hover:bg-light-green hover:text-white') ">
                    <span v-if="0 == index">
                        <ion-icon name="caret-forward-outline"></ion-icon>
                    </span>
                    <span v-if="index !== store.state.manage.links.length - 1 && index !== 0" v-html="link.label"></span>
                    <span v-if="store.state.manage.links.length - 1 == index">
                        <ion-icon name="caret-back-outline"></ion-icon>
                    </span>
                </button>
            </div>
            <!-- pagination:end -->
        </div>
        <!-- card footer:end -->
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { useStore } from 'vuex';
    import Swal from 'sweetalert2';

    const store = useStore();

    function isOdd(num) { return num % 2}

    let users = ref([]);

    let showUser = (user) => {
        console.log(user)
        Swal.fire({
            title: 'اطلاعات حساب کاربری',
            html: `
                <div class="w-full vazir-fd">
                    <div class="mt-1 mb-5 rounded-xl py-1 flex items-center justify-center">
                        <img src="${user.image}" class="h-32 w-32 rounded-full">
                    </div>
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>نام</span>
                        <span>${user.name}</span>
                    </div>
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>نام خانوادگی</span>
                        <span>${user.last_name}</span>
                    </div> 
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>شماره تماس</span>
                        <span>${user.phone}</span>
                    </div>
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>ایمیل</span>
                        <span>${user.email}</span>
                    </div>
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>${user.is_vip ? 'کاربر ویژه سایت هست' : 'کاربر عادی سایت هست'}</span>
                    </div>  
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>شهر</span>
                        <span>${user.city}</span>
                    </div>
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>استان</span>
                        <span>${user.state}</span>
                    </div> 
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>نام شرکت</span>
                        <span>${user.company}</span>
                    </div> 
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>آدرس شرکت</span>
                        <span>${user.company_exact_address}</span>
                    </div> 
                    <div class="my-1 rounded-xl border py-1 flex items-center justify-between px-10">
                        <span>شماره ثبت شرکت</span>
                        <span>${user.company_registration_number}</span>
                    </div> 
                </div>
            `
        });
    }

    let changePage = (link) => {
        if(!link.url || link.active){
            return;
        }

        store.dispatch('fetchAllUsers', ({url: link.url}))
        .then(() => {
            users.value = store.state.manage.users;
        })
    };

    onMounted(() => {
        store.dispatch('fetchAllUsers')
            .then(() => {
                users.value = store.state.manage.users;
            })

    })
</script>

<style>

</style>