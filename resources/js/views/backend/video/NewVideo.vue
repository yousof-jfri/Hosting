<template>
    <div class="w-full bg-white rounded-xl overflow-hidden shadow">
        <!-- card header:start -->
        <div class="w-full p-5 bg-gray-100 flex items-center justify-between">
            <h4 class="text-xl">افزودن ویدیو جدید</h4>
            <router-link :to="{ name: 'Videos' }" class="px-3 py-2 bg-red-500 text-white rounded-xl hover:bg-transparent border border-red-500 hover:text-red-500 duration-150">
                <span>ویدیو های شما</span>
            </router-link>
        </div>
        <!-- card header:end -->

        <!-- card body:start -->
        <div class="p-5 bg-white">
            <div class="my-3">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="title">نام فیلم</label>
                        <input type="text" v-model="videoData.title" id="title" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.title" class="text-red-500 text-sm">{{ errors.title[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <label for="director">نام کارگردان</label>
                        <input type="text" v-model="videoData.director" id="director" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.director" class="text-red-500 text-sm">{{ errors.director[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex md:flex-row flex-col items-center justify-between gap-5">
                    <div class="md:flex-1 w-full">
                        <label for="">ژانر فیلم</label>
                        <select v-model="videoData.genre" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                            <option value="کمدی">کمدی</option>
                            <option value="ترسناک">ترسناک</option>
                            <option value="اکشن">اکشن</option>
                            <option value="هیجانی">هیجانی</option>
                        </select>
                        <span v-if="errors.genre" class="text-red-500 text-sm">{{ errors.genre[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="release">سال تولید</label>
                        <input type="date" v-model="videoData.release" id="release" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.release" class="text-red-500 text-sm">{{ errors.release[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="">کشور سازنده</label>
                        <input type="text" v-model="videoData.country" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.country" class="text-red-500 text-sm">{{ errors.country[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex-1">
                        <label for="">توضیحات فیلم</label>
                        <textarea v-model="videoData.description" rows="12" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3"></textarea>
                        <span v-if="errors.description" class="text-red-500 text-sm">{{ errors.description[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                    <div class="col-span-1">
                        <label for="">بازیگران</label>
                        <div class="mt-3 flex flex-col gap-5">
                            <div v-for="actor in videoData.actors" :key="actor.id" class="flex-1 w-full bg-gray-100 p-2 rounded-xl flex items-center gap-5">
                                <div class="">
                                    <input type="text" v-model="actor.name" name="" id="" class="w-full rounded-xl outline-none px-3 py-2 bg-white" placeholder="نام بازیگر">
                                </div>
                                <div class="">
                                    <button @click="removeActor(actor.id)" class="bg-red-500 px-3 py-2 text-white rounded-xl">حذف</button>
                                </div>
                            </div>
                        </div>
                        <button @click="newActor" class="bg-light-green mt-3 px-3 py-2 text-white rounded-xl duration-150 hover:bg-green-500">افزودن</button>
                        <span v-if="errors.actors" class="text-red-500 text-sm">{{ errors.actors[0] }}</span>
                    </div>
                    <div class="col-span-1">
                        <label for="">نویسنده گان</label>
                        <div class="mt-3 flex flex-col gap-5">
                            <div v-for="writer in videoData.writers" :key="writer.id" class="flex-1 w-full bg-gray-100 p-2 rounded-xl flex items-center gap-5">
                                <div class="">
                                    <input v-model="writer.name" type="text" name="" id="" class="w-full rounded-xl outline-none px-3 py-2 bg-white" placeholder="نام نویسنده">
                                </div>
                                <div class="">
                                    <button @click="removeWriter(writer.id)" class="bg-red-500 px-3 py-2 text-white rounded-xl">حذف</button>
                                </div>
                            </div>
                        </div>
                        <button @click="newWriter" class="bg-light-green mt-3 px-3 py-2 text-white rounded-xl duration-150 hover:bg-green-500">افزودن</button>
                        <span v-if="errors.writer" class="text-red-500 text-sm">{{ errors.writer[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex md:flex-row flex-col items-center justify-between gap-5">
                    <div class="md:flex-1 w-full">
                        <label for="">پستر فیلم</label>
                        <button type="button" class="w-full rounded-xl bg-gray-100 relative outline-none px-3 py-2 my-3 overflow-hidden">
                            <input @change="selectPoster" type="file" name="" id="" class="absolute top-0 left-0 w-full h-full opacity-0" accept=".png,.jpg,.jpeg,.gif">
                            <div class="flex items-center gap-3 w-full justify-center">
                                <ion-icon name="image-outline"></ion-icon>
                                <span>انتخاب پستر</span>
                            </div>
                        </button>
                        <div class="m-3">
                            <div class="w-full h-32 rounded-xl bg-gray-100 flex items-center justify-center text-3xl overflow-hidden">
                                <img v-if="videoData.poster" :src="videoData.poster" alt="" class="w-full object-cover">
                                <ion-icon v-else name="image-outline"></ion-icon>
                            </div>
                        </div>
                        <span v-if="errors.poster" class="text-red-500 text-sm">{{ errors.poster[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="">تیزر فیلم</label>
                        <button type="button" class="w-full rounded-xl bg-gray-100 relative outline-none px-3 py-2 my-3 overflow-hidden">
                            <input @change="selectTeaser" type="file" name="" id="" class="absolute top-0 left-0 w-full h-full opacity-0" accept=".ogg,.mp4,.mvc">
                            <div class="flex items-center gap-3 w-full justify-center">
                                <ion-icon name="camera-outline"></ion-icon>
                                <span>انتخاب تیزر</span>
                            </div>
                        </button>
                        <div class="m-3">
                            <div class="w-full h-32 rounded-xl bg-gray-100 flex items-center justify-center text-3xl overflow-hidden">
                                <video v-if="videoData.teaser" width="400" controls>
                                    <source :src="videoData.teaser" type="video/mp4">
                                    <source :src="videoData.teaser" type="video/mvc">
                                    <source :src="videoData.teaser" type="video/ogg">
                                    مرور گر شما نمیتواند این ویدیو رو ساپورت کند
                                </video>

                                <ion-icon v-else name="camera-outline"></ion-icon>
                            </div>
                        </div>
                        <span v-if="errors.teaser" class="text-red-500 text-sm">{{ errors.teaser[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="">فیلم</label>
                        <button type="button" class="w-full rounded-xl bg-gray-100 relative outline-none px-3 py-2 my-3 overflow-hidden">
                            <input @change="selectVideo" type="file" name="" id="" class="absolute top-0 left-0 w-full h-full opacity-0" accept=".ogg,.mp4,.mvc">
                            <div class="flex items-center gap-3 w-full justify-center">
                                <ion-icon name="videocam-outline"></ion-icon>
                                <span>انتخاب فیلم</span>
                            </div>
                        </button>
                        <div class="m-3">
                            <div class="w-full h-32 rounded-xl bg-gray-100 flex items-center justify-center text-3xl overflow-hidden">
                                <video v-if="videoData.video" width="400" controls>
                                    <source :src="videoData.video" type="video/mp4">
                                    <source :src="videoData.video" type="video/mvc">
                                    <source :src="videoData.video" type="video/ogg">
                                    مرور گر شما نمیتواند این ویدیو رو ساپورت کند
                                </video>
                                <ion-icon v-else name="videocam-outline"></ion-icon>
                            </div>
                        </div>
                        <span v-if="errors.video" class="text-red-500 text-sm">{{ errors.video[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex md:flex-row flex-col items-center justify-between gap-5">
                    <div class="md:flex-1 w-full">
                        <label for="">تخفیف من</label>
                        <input v-model="videoData.discountFromUser" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.discountFromUser" class="text-red-500 text-sm">{{ errors.discountFromUser[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="">تخفیف دیگران</label>
                        <input v-model="videoData.discountFromProgram" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.discountFromProgram" class="text-red-500 text-sm">{{ errors.discountFromProgram[0] }}</span>
                    </div>
                    <div class="md:flex-1 w-full">
                        <label for="">قیمت فیلم</label>
                        <input v-model="videoData.price" type="text" name="" id="" class="w-full rounded-xl bg-gray-100 outline-none px-3 py-2 my-3">
                        <span v-if="errors.price" class="text-red-500 text-sm">{{ errors.price[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="flex md:flex-row flex-col items-center justify-between gap-5">
                    <div class="md:flex-1 w-full">
                        <label for="">آپلود مجوزات</label>
                        <button type="button" class="w-full rounded-xl bg-gray-100 relative outline-none px-3 py-2 my-3 overflow-hidden">
                            <input @change="selectJustification" type="file" name="" id="" class="absolute top-0 left-0 w-full h-full opacity-0" accept=".pdf">
                            <div class="flex items-center gap-3 w-full justify-center">
                                <ion-icon name="videocam-outline"></ion-icon>
                                <span>انتخاب فایل مجوز</span>
                            </div>
                        </button>
                        <span v-if="errors.justification" class="text-red-500 text-sm">{{ errors.justification[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <button @click="saveVideo" class="bg-light-green mt-3 px-3 py-2 text-white rounded-xl duration-150 hover:bg-green-500">ثبت فیلم</button>
            </div>
            <div class="my-3" v-if="showLoader">
                <div class="h-5 w-full rounded-xl bg-gray-100 overflow-hidden">
                    <div class="h-full bg-light-green text-center text-white duration-150" :style="'width:' + store.state.videos.loadingPercentage + '%;'">
                        <span>{{ store.state.videos.loadingPercentage }}%</span>
                    </div>
                </div>
                <div class="mt-4">
                    <span>لطفا منتظر باشید تا لودر بالا بسته شده و پیغام موفقیت به شما نمایش داده شود</span>
                </div>
            </div>
        </div>
        <!-- card body:end -->
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import toastr from 'toastr';

    //  ============ VARIABLES
    const store = useStore();

    let showLoader = ref(false);

    let errors = ref({});

    let videoData = ref({
        title: '',
        description: '',
        poster: '', 
        teaser: '',
        video: '',
        director: '',
        genre: '',
        justification: '',
        release: '',
        country: '',
        price: '',
        discountFromUser: '',
        discountFromProgram: '',
        user_id: store.state.dashboard.data.id,
        actors: [],
        writers: [],
    });

    //  ============ FUNCTIONS
    // add new actor
    let newActor = () => {
        let newActor = { id: videoData.value.actors.length + 1, name: '' };
        videoData.value.actors.push(newActor);
    };

    // remove actor
    let removeActor = (id) => {
        videoData.value.actors = videoData.value.actors.filter(actor => actor.id !== id)
    };

    // add new writer
    let newWriter = () => {
        let newWriter = { id:  videoData.value.writers.length + 1, name: '' };
        videoData.value.writers.push(newWriter);
    };

    // remove actor
    let removeWriter = (id) => {
        videoData.value.writers = videoData.value.writers.filter(writer => writer.id !== id)
    };

    // set the poster
    let selectPoster = (e) => {
        let file = e.target.files[0]
        let reader = new FileReader();
        reader.onload = function(){
            videoData.value.poster = this.result;
        }
        reader.readAsDataURL(file);
    }

    // set Teaser
    let selectTeaser = (e) => {
        let file = e.target.files[0]
        let reader = new FileReader();
        reader.onload = function(){
            console.log(this.result)
            videoData.value.teaser = this.result;
        }
        reader.readAsDataURL(file);
    }

    // set Teaser
    let selectVideo = (e) => {
        let file = e.target.files[0]
        let reader = new FileReader();
        reader.onload = function(){
            videoData.value.video = this.result;
        }
        reader.readAsDataURL(file);
    }

    let selectJustification = (e) => {
        let file = e.target.files[0]
        let reader = new FileReader();
        reader.onload = function(){
            videoData.value.justification = this.result;
        }
        reader.readAsDataURL(file);
    }

    // upladd video
    let saveVideo = () => {
        showLoader.value = true;
        store.dispatch('uploadVideo', videoData.value)
            .then(() => {
                showLoader.value = false;
                toastr.success('ویدیو با موفقیت آپلود شد');
                videoData.value = {
                    title: '',
                    description: '',
                    poster: '', 
                    teaser: '',
                    video: '',
                    director: '',
                    genre: '',
                    release: '',
                    country: '',
                    price: '',
                    discountFromUser: '',
                    discountFromProgram: '',
                    user_id: store.state.dashboard.data.id,
                    actors: [],
                    writers: [],
                };
            })
            .catch(err => {
                console.log(err)
                showLoader.value = false;
                errors.value = err.response.data.errors
                toastr.error('مشکلی در آپلود به وجود آمد لطفا تمام فیلد ها را چک و دوباره امتحان کنید');
            })
    };
</script>

<style>
    @import 'toastr';
</style>