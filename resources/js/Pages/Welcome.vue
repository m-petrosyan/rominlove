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
    locale: {
        type: String,
    },
    translations: {
        type: Object,
    },
});

const albumImage = ref('/album.jpg')
const currentYear = new Date().getFullYear()

const streamingServices = ref([
    {name: 'Spotify', icon: '/spotify.svg', link: '#'},
    {name: 'Apple', icon: '/apple.svg', link: '#'},
    {name: 'Itupes', icon: '/itunes.svg', link: '#'},
    {name: 'Amazon', icon: '/amazon.svg', link: '#'},
    {name: 'Tidal', icon: '/tidal.svg', link: '#'},
    {name: 'Deezer', icon: '/deezer.svg', link: '#'},
    {name: 'Youtube', icon: '/youtube.svg', link: '#'},
    {name: 'Tiktok', icon: '/tiktok.svg', link: '#'},
    {name: 'Yandex', icon: '/yandex.svg', link: '#'},
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

function toggle() {
    const albumInfo = document.getElementById('albumInfo');
    const albumLinks = document.getElementById('albumLinks');
    const contentInfo = document.getElementById('contentInfo');
    const toggleIcon = document.querySelector('#toggleButton i');

    albumInfo.classList.toggle('hidden');
    albumLinks.classList.toggle('expanded');
    contentInfo.classList.toggle('expanded-height');
    toggleIcon.classList.toggle('fa-chevron-right');
    toggleIcon.classList.toggle('fa-chevron-left');
}
</script>

<template>

    <div class="container">
        <div class="wrapper">
            <div class="content header">
                <div class="logo">
                    <div class="title"><h1>ROMINLOVE</h1></div>
                    <div class="typing"><a>{{ translations.subtitle }}</a></div>
                </div>
                <div class="header-buttons">
                    <div class="header-btn uppercase">{{ locale }}</div>
                </div>
            </div>
        </div>
        <div class="wrapper info">
            <h2 class="text-2xl pt-10">{{ translations.listen }}</h2>
            <div class="content info" id="contentInfo">
                <div class="album-panel info" id="albumInfo">
                    <div class="album-img">
                        <img src="/album.jpg" alt="Album image">
                    </div>
                    <div class="album-info">
                        <h1>{{ translations.hold }}</h1>
                        <a>{{ translations.latest }}</a>
                    </div>
                </div>
                <div class="album-panel links" id="albumLinks">
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
                <div class="album-panel all" id="albumAll">
                    <div class="icon-panel services">
                        <button @click="toggle" class="icon-link" id="toggleButton"><i
                            class="fa-solid fa-chevron-right"></i><span>All</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper slider mt-10">
            <h2 class="text-2xl">{{ translations.fundraiser }}</h2>
            <div class="content slider">
                <div v-if="data.length" class="swiper-container" ref="swiperContainer">
                    <div class="swiper-wrapper">
                        <div v-for="(item, index) in data"
                             :key="index"
                             class="swiper-slide">
                            <div class="goal-text">
                                <div class="goal-bar">
                                    <div class="goal-progress"
                                         :style="{ width: `${(item.collected / item.target) * 100}%` }">
                                    </div>
                                    <span>
                                        {{
                                            item.active ? translations.active_fundraising : translations.archive_fundraising
                                        }}
                                    </span>
                                </div>
                                <h2>{{ item.collected }} of {{ item.target }}$ money raised</h2>
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
                <div v-else class=" text-center font-medium">
                    Oh, something went wrong, try again later.
                </div>
            </div>
        </div>
        <div class="wrapper social mt-10">
            <div class="content social">
                <div class="icon-panel">
                    <a href="https://t.me/rominlove" target="_blank" class="icon-link"><i
                        class="fa-brands fa-telegram"></i></a>
                    <a href="https://www.instagram.com/rominlovemusic" target="_blank" class="icon-link"><i
                        class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/groups/rominlove" target="_blank" class="icon-link"><i
                        class="fa-brands fa-facebook"></i></a>
                    <a href="https://x.com/rominlovemusic" target="_blank" class="icon-link"><i
                        class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/@rominlove" target="_blank" class="icon-link"><i
                        class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@rominlovemusic" target="_blank" class="icon-link"><i
                        class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="wrapper footer mt-10">
            <div class="content footer">
                <a>ROMINLOVE © {{ currentYear }}</a>
            </div>
        </div>
    </div>
</template>
