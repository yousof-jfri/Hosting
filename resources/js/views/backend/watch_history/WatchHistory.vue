<template>
    <div>
        <div class="w-full bg-white rounded-xl overflow-hidden shadow">
            <!-- card header:start -->
            <div class="w-full p-5 bg-gray-100 flex items-center justify-between">
                <h4 class="text-xl">سابقه تماشای شما</h4>
            </div>
            <!-- card header:end -->

            <!-- card body:start -->
            <div class="p-5 bg-white">
                <div class="py-3 text-center" v-if="store.state.dashboard.historyLoading">
                    <span>در حال بارگزاری...</span>
                </div>
                <div class="w-full flex flex-col gap-1" v-else>
                    <div v-for="video in videos" :key="video.id" class="w-full rounded-xl p-3 flex md:flex-row flex-col items-center">
                        <div class="h-32 w-72 rounded-xl overflow-hidden bg-gray-100 md:mb-0 mb-10 flex items-center justify-center">
                            <img :src="video.poster" alt="" class="w-32 h-auto object-cover">
                        </div>
                        <div class="px-5">
                            <h3 class="text-xl vazir-bold">{{ video.title }}</h3>
                            <p class="mt-2">{{ video.description }}</p>
                            <div class="flex items-center mt-5 gap-5">
                                <button class="px-3 py-1 rounded-xl bg-red-500 text-white text-sm border border-red-500 hover:text-red-500 hover:bg-white duration-150">حذف از سابقه تماشا</button>
                                <button class="px-3 py-1 rounded-xl bg-green-500 text-white text-sm border border-green-500 hover:text-green-500 hover:bg-white duration-150">مشاهده ویدیو</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card body:end -->
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { useStore } from 'vuex'

    const store = useStore();

    let videos = ref([]);


    onMounted(() => {
        store.dispatch('getUserWatchHistory', store.state.auth.data.id)
            .then(() => {
                videos.value = store.state.dashboard.watchHistory
                console.log(videos.value)
            })
    })
</script>

<style>

</style>