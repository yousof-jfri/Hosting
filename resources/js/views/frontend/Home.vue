<template>
    <div class="w-full lg:px-32">
        <div class="md:mt-0 mt-14 grid lg:grid-cols-4 grid-cols-2 lg:gap-1 px-1 border-box">
            <div v-for="section in sections" :key="section.id" class="col-span-1">
                <div class="duration-700 y-card relative w-full h-full lg:h-96 h-86 lg:rounded-xl md:border-2 border border-gold-yellow rounded-xl">
                    <!-- show this part by default -->
                    <div class="y-front relative w-full h-full">
                        <img :src="section.image" alt="aria cinema" class="w-full h-full rounded-xl">
                        <div :class="'w-full absolute top-0 left-0 w-full h-full opacity-40 rounded-xl ' + section.background"></div>
                        <div class="w-full absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <div class="h-1/2 w-3/6 rounded-xl text-center">
                                <div class="w-full h-24 bg-white rounded-xl flex items-center justify-center">
                                    <img :src="section.iconImage" alt="" class="md:h-16 md:w-16 w-12 h-12">
                                </div>
                                <h3 class="md:text-2xl text-xl text-bold text-white mt-8">{{ section.title }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- show this part whene hover -->
                    <div class="y-back absolute w-full h-full top-0 left-0">
                        <div class="relative overflow-hidden rounded-xl h-full bg-white">
                            <div class="w-full rounded-xl h-full">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200">
                                        <path fill="#067803" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,96C384,96,480,128,576,154.7C672,181,768,203,864,202.7C960,203,1056,181,1152,160C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="my-5 text-center">
                                    <p class="mb-10">{{ section.description }}</p>

                                    <router-link :to="{ name: section.path }" class="px-3 py-1 rounded text-red-500 border-2 border-red-500 mt-5 hover:bg-red-500 hover:text-white duration-150">مشاهده</router-link>
                                </div>
                                <div class="absolute w-full bottom-0 left-0 rotate-180">
                                    <svg viewBox="0 0 1440 200">
                                        <path fill="rgb(187,7,7)" fill-opacity="1" d="M0,160L48,144C96,128,192,96,288,96C384,96,480,128,576,154.7C672,181,768,203,864,202.7C960,203,1056,181,1152,160C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 w-full w-full px-7 py-5 bg-gray-100 left-0 text-sm md:block hidden">
            <span>&copy; AriaWith - 2022</span>
        </div>
    </div>
</template>

<script setup>
   
    import { useStore } from 'vuex';
 
    const store = useStore();

    const sections = store.state.sections.sections;
</script>