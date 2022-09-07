<template>
    <div class="w-full overflow-hidden rounded-xl bg-white p-5">
        <!-- card header:start -->
        <div class="w-full  bg-white">
            <div class="w-full flex items-center justify-between">
                <span class="text-xl">پیشنهادات کاربران</span>
                <div class="flex items-center">
                    <label> مرتب سازی بر اساس موضوع</label>
                    <select v-model="sortBy" class="mx-2 px-3 py-1 rounded-xl bg-gray-100">
                        <option value="all">همه</option>
                        <option value="upload">آپلود فیلم</option>
                        <option value="watch">تماشای فیلم</option>
                        <option value="normalUser">کاربران عادی</option>
                        <option value="VIPUser">کاربران ویژه</option>
                        <option value="discount_price">تخفیف ها و قیمت ها</option>
                        <option value="license">مجوز ها</option>
                        <option value="site_problems">مشکلات سایت</option>
                        <option value="report">گزارش تخلفات</option>
                        <option value="more">سایر</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- card header:end -->

        <!-- card body:start -->
        <div class="p-5 text-center bg-gray-100 rounded-xl mt-5 overflow-x-auto">
            <div class="w-[70rem]">
                <table class="w-full" v-if="!store.state.feedback.loading">
                    <thead>
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">نام</th>
                            <th class="px-3 py-2">نام خانواده گی</th>
                            <th class="px-3 py-2">موضوع</th>
                            <th class="px-3 py-2">راه های ارتباطی</th>
                            <th class="px-3 py-2">مدت زمان</th>
                            <th class="px-3 py-2">وضعیت</th>
                            <th class="px-3 py-2">تغییرات</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        <tr :class="isOdd(index) ? 'bg-gray-100' : 'bg-white'" v-for="(feedback, index) in feedbacks" :key="index">
                            <td class="px-3 py-2">{{ feedback.id }}</td>
                            <td class="px-3 py-2">{{ feedback.name }}</td>
                            <td class="px-3 py-2">{{ feedback.last_name }}</td>
                            <td class="px-3 py-2">{{ feedback.issue }}</td>
                            <td class="px-3 py-2">{{ feedback.email }} | {{ feedback.phone }}</td>
                            <td class="px-3 py-2">{{ feedback.created_at }} ساعت پیش</td>
                            <td class="px-3 py-2">
                                <span v-if="feedback.type == 'unreaded'" class="px-2 py-1 rounded bg-red-500 text-white text-xs">خوانده نشده</span>
                                <span v-else-if="feedback.type == 'readed'" class="px-2 py-1 rounded bg-green-500 text-white text-xs">خوانده شده</span>
                                <span v-else-if="feedback.type == 'inProgress'" class="px-2 py-1 rounded bg-gold-yellow text-white text-xs">در حال پیگیری</span>
                                <span v-else class="px-2 py-1 rounded bg-blue-500 text-white text-xs">جواب داده شده</span>
                            </td>
                            <td class="px-3 py-2">
                                <button @click="showFeedBack(feedback.feedback, feedback.id)" class="rounded bg-light-green px-3 py-1 text-white text-sm">مشاهده</button>
                                <button @click="deleteFeedBack(feedback.id)" class="rounded bg-red-500 px-2 mx-1 py-1 text-white text-sm">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                                <select @change="setNewType(feedback.id, $event)" class="rounded bg-gold-yellow px-2 mx-1 py-1 text-white text-sm">
                                    <option :value="feedback.type">
                                        <span v-if="feedback.type == 'readed'">خوانده شده</span>
                                        <span v-else-if="feedback.type == 'unreaded'">خوانده نشده</span>
                                        <span v-else-if="feedback.type == 'inProgress'">در حال پیگیری</span>
                                        <span v-else>جواب داده شده</span>
                                    </option>
                                    <option value="answered">جواب داده شده</option>
                                    <option value="inProgress">در حل پیگیری</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="feedbacks.length < 1" class="w-full bg-white p-5 text-center rounded-xl mt-5">
                <span>هیچ پیشنهادی وجود ندارد</span>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, watch } from 'vue';
    import { useStore } from 'vuex';
    import Swal from 'sweetalert2';

    const store = useStore();
    let feedbacks = ref([]);

    let sortBy = ref('all');

    watch(sortBy, (currentValue, oldValue) => {
        feedbacks.value = store.state.feedback.feedbacks.filter(feedback => {
            if(currentValue == 'all') return feedback;
            if (feedback.issue == currentValue)
            {
                return feedback;
            }
        })
    })

    let showFeedBack = (feedback, id) => {
        Swal.fire({
            title: 'پیشنهاد کاربر',
            text: feedback,
        })
            .then(() => {
                store.dispatch('changeFeedBackStatus', {id: id, type: 'readed'})
            })
    };

    function isOdd(num) { return num % 2}

    let deleteFeedBack = (id) => {
        Swal.fire({
            title: 'آیا میخواهید این پیشنهاد را حذف کنید؟',
            text: 'اطلاعات مربوطه دیگر قابل دسترس نیستند',
            showDenyButton: true,
            denyButtonText: 'لغو',
            confirmButtonText: 'حذف پیشنهاد',
        })
        .then(result => {
            if (result.isConfirmed) {
                store.dispatch('deleteFeedback', { id: id })
            }
        })
    }


    let setNewType = (id, event) => {
        console.log(event.target.value, id)
        store.dispatch('changeFeedBackStatus', {id: id, type: event.target.value})
    }

    onMounted(() => {
        store.dispatch('fetchAllFeedbacks')
            .then(() => {
                feedbacks.value = store.state.feedback.feedbacks;
            })

    })
</script>

<style>

</style>