<script setup>
    import { ref, computed, onMounted, onUnmounted, watch } from "vue";
    import { ChevronLeft, ChevronRight } from "lucide-vue-next";

    const props = defineProps({
        flashs: { type: Array, default: () => [] },
    })

    const INTERVAL_MS = 8000;

    const current = ref(0);
    let intervalId = null;

    function startAutoSlide() {
        clearInterval(intervalId);
        if (props.flashs.length === 0) return;
        intervalId = setInterval(() => {
            current.value = current.value === props.flashs.length - 1 ? 0 : current.value + 1;
        }, INTERVAL_MS);
    }

    function nextSlide() {
        if (props.flashs.length === 0) return;
        current.value = current.value === props.flashs.length - 1 ? 0 : current.value + 1;
        startAutoSlide(); // on relance le minuteur pour éviter un double changement rapproché
    }

    function prevSlide() {
        if (props.flashs.length === 0) return;
        current.value = current.value === 0 ? props.flashs.length - 1 : current.value - 1;
        startAutoSlide();
    }

    const currentNews = computed(() => props.flashs[current.value] ?? null);

    watch(
        () => props.flashs,
        () => {
            current.value = 0;
            startAutoSlide();
        }
    );

    onMounted(async () => {
        startAutoSlide();
    });

    onUnmounted(() => {
        clearInterval(intervalId);
    });
</script>

<template>
    <div v-if="flashs.length === 0" class="w-full bg-gray-100 p-4 animate-pulse">
        Chargement...
    </div>

    <section v-else class="hidden md:block w-full">
        <div class="bg-white shadow-md overflow-hidden border border-gray-200">
            <div class="flex items-center">
                <!-- LEFT TITLE -->
                <div class="bg-green-950 text-white font-bold px-5 py-4 whitespace-nowrap">
                    Flash News
                </div>

                <!-- NEWS CONTENT -->
                <div class="flex-1 overflow-hidden relative h-[60px] flex items-center px-4">
                    <Transition name="news-slide" mode="out-in">
                        <div :key="current" class="whitespace-nowrap">
                            <a :href="currentNews?.url"
                                class="text-gray-800 font-medium hover:text-green-600 transition">
                                {{ currentNews?.titre }}
                            </a>
                        </div>
                    </Transition>
                </div>

                <!-- CONTROLS -->
                <div class="flex items-center gap-2 px-4">
                    <button @click="prevSlide"
                        class="w-9 h-9 rounded-full border border-gray-300 hover:bg-gray-100 flex items-center justify-center transition">
                        <ChevronLeft :size="18" />
                    </button>

                    <button @click="nextSlide"
                        class="w-9 h-9 rounded-full border border-gray-300 hover:bg-gray-100 flex items-center justify-center transition">
                        <ChevronRight :size="18" />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
    /* Slide + fade synchronisé avec le changement réel de current (500ms) */
    .news-slide-enter-active,
    .news-slide-leave-active {
        transition: transform 0.5s ease, opacity 0.5s ease;
        position: absolute;
    }

    .news-slide-enter-from {
        transform: translateX(40px);
        opacity: 0;
    }

    .news-slide-enter-to {
        transform: translateX(0);
        opacity: 1;
    }

    .news-slide-leave-from {
        transform: translateX(0);
        opacity: 1;
    }

    .news-slide-leave-to {
        transform: translateX(-40px);
        opacity: 0;
    }
</style>
