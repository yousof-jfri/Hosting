<template>
    <div>
        <h5 class="text-2xl font-bold">جستجو پیشرفته در آریا سینما</h5>
        <div class="p-5 flex gap-10 mt-5">
            <div>
                <input type="text" v-model="searchData.name" class="w-full rounded bg-gray-100 px-3 py-2 outline-none mt-2 text-sm" placeholder="جستجو بر اساس نام فیلم">
                <input type="text" v-model="searchData.genre" class="w-full rounded bg-gray-100 px-3 py-2 outline-none mt-2 text-sm" placeholder="جستجو بر اساس ژانر فیلم">
            </div>
            <div>
                <input type="text" v-model="searchData.director" class="w-full rounded bg-gray-100 px-3 py-2 outline-none mt-2 text-sm" placeholder="جستجو بر اساس نام کارگردان">
                <input type="text" v-model="searchData.actor" class="w-full rounded bg-gray-100 px-3 py-2 outline-none mt-2 text-sm" placeholder="جستجو بر اساس نام بازیگر">
            </div>
        </div>
        <div class="flex items-center">
            <span>جستجو بر اساس سال تولید فیلم</span>
            <select name="" id="" class="px-3 py-1 rounded-xl bg-light-green text-white vazir-bold mx-3" v-model="dateType">
                <option value="none" selected>انتخواب تاریح</option>
                <option value="k">خورشیدی</option>
                <option value="m">میلادی</option>
            </select>
        </div>
        <div class="flex items-center justify-center mt-5">
            <div class="flex flex-col">
                <label for="" class="mr-7">از</label>
                <input type="text" class="px-3 py-2 rounded bg-gray-100 mx-5 w-28 outline-none">
            </div>
            <div class="flex flex-col">
                <label for="" class="mr-7">تا</label>
                <input type="text" class="px-3 py-2 rounded bg-gray-100 mx-5 w-28 outline-none">
            </div>
        </div>
        <div class="flex items-center mt-5">
            <button @click="searchCinema" class="px-3 py-2 bg-light-green rounded-xl text-white w-1/2">جستجو</button>
            <button class="w-1/2 text-gray-700" @click="closeWindow">بستن</button>
        </div>
    </div>
</template>

<script setup>
    import { ref, defineEmits } from 'vue';
    import { useStore } from 'vuex'

    const store = useStore();

    let searchData = ref({
        name: '',
        genre: '',
        director: '',
        actor: '',
    });
 
    // date time m = میلادی k = خورشیدی
    let dateType = ref('none');

    let searchCinema = () => {
        store.dispatch('fetchAllVideos', searchData.value);
    };

    const emit = defineEmits(['closeWin'])

    const closeWindow = () => {
        emit('closeWin')
    }

</script>

<style>

</style>