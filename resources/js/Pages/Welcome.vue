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
    streemings: {
        type: Array,
    },
    socialLinks: {
        type: Array,
    },
});

const currentYear = new Date().getFullYear()

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
                    <a :href="locale === 'en' ? 'https://rominlove.ru' : 'https://rominlove.com'"
                       class="header-btn uppercase">{{ locale }}</a>
                </div>
            </div>
        </div>
        <div class="wrapper info mt-2">
            <h2 class="text-2xl">{{ translations.listen }}</h2>
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
                    <div class="icon-panel services gap-y-2">
                        <a v-for="service in streemings"
                           :key="service.name"
                           :href="service.link"
                           target="_blank"
                           class="icon-link">
                            <img class="icon" :src="'/'+service.name.toLowerCase()+'.svg'" :alt="service.name">
                            <span>{{ service.name }}</span>
                        </a>
                    </div>
                </div>
                <div class="album-panel all" id="albumAll">
                    <div class="icon-panel services">
                        <button @click="toggle" class="icon-link" id="toggleButton"><i
                            class="fa-solid fa-chevron-right"></i><span>{{ translations.all }}</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper slider mt-2">
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
                                <h2>{{ item.collected }} {{ translations.of }} {{
                                        item.target
                                    }}{{ locale === 'en' ? '$' : '₽' }}
                                    {{ translations.money_raised }}</h2>
                                <a>{{ item.description[locale] }}</a>
                                <div class="goal-buttons">
                                    <div class="goal-btn" v-if="!item.active ">
                                        {{ translations.donation_is_over }}
                                    </div>
                                    <a v-else class="goal-btn" target="_blank" :href="item.donate">
                                        {{ translations.donate }}
                                    </a>
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
        <div class="wrapper social mt-2">
            <div class="content social">
                <div class="icon-panel">
                    <a v-for="item in socialLinks" :key="item.icon" :href="item.url" target="_blank"
                       class="icon-link"><i
                        :class="['fa-brands', 'fa-'+item.icon.toLowerCase()]"></i></a>
                </div>
            </div>
        </div>
        <div class="wrapper footer mt-6">
            <div class="content footer">
                <a>ROMINLOVE © {{ currentYear }}</a>
            </div>
        </div>
    </div>
</template>
