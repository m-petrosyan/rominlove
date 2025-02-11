<script setup>
import {onMounted, onUnmounted, ref} from 'vue'
import Swiper from 'swiper'
import 'swiper/css'
import {Navigation} from 'swiper/modules'
// import 'swiper/css/navigation'

defineProps({
    data: {
        type: Object,
    },
});

const albumImage = ref('/album.jpg')
const currentYear = new Date().getFullYear()

const streamingServices = ref([
    {name: 'Spotify', icon: '/spotify.svg', link: '#'},
    {name: 'Apple', icon: '/apple.svg', link: '#'},
    {name: 'Yandex', icon: '/yandex.svg', link: '#'}
])

const socialLinks = ref([
    {name: 'telegram', icon: 'fa-brands fa-telegram', url: 'https://telegram.org'},
    {name: 'instagram', icon: 'fa-brands fa-instagram', url: 'https://instagram.com'},
    {name: 'twitter', icon: 'fa-brands fa-twitter', url: 'https://twitter.com'},
    {name: 'youtube', icon: 'fa-brands fa-youtube', url: 'https://youtube.com'}
])

const swiperContainer = ref(null);
let swiperInstance = null;

onMounted(() => {
    swiperInstance = new Swiper(swiperContainer.value, {
        modules: [Navigation],
        slidesPerView: 1.2,
        spaceBetween: 10,
        centeredSlides: true,
        loop: false,
        mousewheel: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        initialSlide: 0,
    });
});

onUnmounted(() => {
    if (swiperInstance) {
        swiperInstance.destroy();
    }
});

</script>

<template>
    <div class="container">
        <div class="wrapper">
            <div class="content header">
                <div class="logo">
                    <h1>ROMINLOVE</h1>
                    <div class="typing">
                        <a>music beyond limits and boundaries.</a>
                    </div>
                </div>
                <div class="buttons">
                    <div class="btn">EN</div>
                </div>
            </div>
        </div>

        <div class="wrapper info">
            <h2>Listen on streaming</h2>
            <div class="content info">
                <div class="album-panel">
                    <div class="album">
                        <img :src="albumImage" alt="Album image">
                    </div>
                    <div class="album-info">
                        <h1>Hold me tight</h1>
                        <a>LATEST SINGLE</a>
                    </div>
                </div>
                <div class="album-panel">
                    <div class="icon-panel services">
                        <a v-for="service in streamingServices"
                           :key="service.name"
                           :href="service.link"
                           class="icon-link">
                            <img class="icon" :src="service.icon" :alt="service.name">
                            <span>{{ service.name }}</span>
                        </a>
                    </div>
                </div>
                <div class="album-panel">
                    <div class="icon-panel services">
                        <a class="icon-link">
                            <i class="fa-solid fa-chevron-right"></i>
                            <span>All</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper slider">
            <h2>Fundraiser</h2>
            <div class="content slider">
                <div class="swiper-container" ref="swiperContainer">
                    <div class="swiper-wrapper">
                        <div v-for="(item, index) in data"
                             :key="index"
                             class="swiper-slide">
                            <div class="goal-panel">
                                <div :class="['goal',{ active: item.active  }]">
                                    <h2>{{ item.active ? 'Active fundraising' : 'Archive fundraising' }}</h2>
                                </div>
                            </div>
                            <div class="goal-text">
                                <div class="goal-bar">
                                    <div class="goal-progress"
                                         :style="{ width: `${(item.collected / item.target) * 100}%` }">
                                    </div>
                                </div>
                                <h2>{{ item.collected }} of {{ item.target }} money raised</h2>
                                <a>{{ item.description }}</a>
                                <div class="goal-buttons">
                                    <div class="goal-btn">{{ item.active ? 'Donate' : 'Donation is over' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="swiper-button-next"/>
                    <button class="swiper-button-prev"/>
                </div>
            </div>
        </div>

        <div class="wrapper social">
            <div class="content social">
                <div class="icon-panel">
                    <a v-for="social in socialLinks"
                       :key="social.name"
                       @click="delay(social.url)"
                       class="icon-link">
                        <i :class="social.icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="wrapper footer">
            <div class="content footer">
                <a>ROMINLOVE © {{ currentYear }}</a>
            </div>
        </div>
    </div>
</template>
