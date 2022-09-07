<template>
    <div class="w-full overflow-hidden rounded-xl bg-white">
        <!-- card header:start -->
        <div class="w-full p-5 bg-gray-100">
            <div class="w-full flex items-center justify-between">
                <span class="text-xl">ویدیو های شما</span>
                <router-link :to="{ name: 'NewVideo' }" class="px-3 py-2 bg-red-500 text-white rounded-xl hover:bg-transparent border border-red-500 hover:text-red-500 duration-150">افزودن ویدیو جدید</router-link>
            </div>
        </div>
        <!-- card header:end -->

        <!-- card body:start -->
        <div class="p-5 text-center">
            <span v-if="store.state.videos.loading">در حال بارگزاری</span>
            <div v-else>
                <div v-if="videos.length > 0" class="w-full grid md:grid-cols-3 grid-cols-1 gap-5">
                    <!-- videos start -->
                    <div class="col-span-1" v-for="video in videos" :key="video.id">
                        <div class="w-full p-5 bg-gray-50 rounded-xl">
                            <div class="w-full rounded-xl bg-gray-500 h-40 overflow-hidden">
                                <img :src="'http://127.0.0.1:8000/' + video.poster " alt="">
                            </div>
                            <div class="mt-3 mx-3">
                                <span>{{ video.title }}</span>
                            </div>
                            <div class="mt-3 mx-3 flex items-center justify-between">
                                <router-link :to="{ name: 'EditVideo', params: { id:video.id } }" class="text-sm px-3 py-2 bg-yellow-400 text-white rounded-xl duration-150 hover:bg-yellow-500">ویرایش</router-link>
                                <button @click="deleteVideo(video.id)" class="text-red-500">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- videos end -->
                </div>

                <!-- if there were no video -->
                <div v-else class="text-center">   
                    <span>در حال حاضر شما هیچ ویدیو ای ندارید</span>
                    <br>
                    <span>لطفا از طریق دکمه افزودن ویدیو یک ویدیو جدید اضافه کنید</span>
                </div>
            </div>
        </div>
        <!-- card body:end -->

        <!-- card footer:start -->
        <div class="w-full p-5 bg-gray-100 flex items-center justify-center">
            <!-- pagination:start -->
            <div class="w-full flex items-center justify-center gap-2">
                <button v-for="(link, index) in store.state.videos.meta.links" @click="changePage(link)" :key="index" :class="'h-8 w-8 rounded-xl flex items-center justify-center duration-150 ' + (link.active ? 'bg-light-green text-white hover:bg-white hover:text-gray-700' : 'bg-white hover:bg-light-green hover:text-white') ">
                    <span v-if="0 == index">
                        <ion-icon name="caret-forward-outline"></ion-icon>
                    </span>
                    <span v-if="index !== store.state.videos.meta.links.length - 1 && index !== 0" v-html="link.label"></span>
                    <span v-if="store.state.videos.meta.links.length - 1 == index">
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
    import Swal from 'sweetalert2'
    import { ref, onMounted } from 'vue';
    import { useStore } from 'vuex';

    const store = useStore();

    let videos = ref([]);

    let changePage = (link) => {
        if(!link.url || link.active){
            return;
        }

        store.dispatch('fetchVideos', ({url: link.url}))
            .then(() => {
                videos.value = store.state.videos.videos;
            })
    };

    onMounted(() => {
        store.dispatch('fetchVideos', store.state.dashboard.data.id)
            .then(() => {
                videos.value = store.state.videos.videos;
            })
    });

    let deleteVideo = (id) => {
        Swal.fire({
            title: 'آیا میخواهید این ویدیو رو پاک کنید',
            text: "ویدیو قابل بازگشت نیست",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله پاکش کن',
            cancelButtonText: 'لغو',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                store.dispatch('deleteVideo', id)
                    .then(() => {
                        Swal.fire(
                            'ویدیو پاک شد',
                            'ویدیو شما با موفقیت پاک شد',
                            'success',
                        )
                        store.dispatch('fetchVideos', store.state.dashboard.data.id)
                            .then(() => {
                                videos.value = store.state.videos.videos;
                            })
                    })
            }
        })
    }

</script>

<style>

</style>