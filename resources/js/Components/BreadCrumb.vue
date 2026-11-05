<script setup>
import { Link } from '@inertiajs/vue3'
import { Home, ChevronRight } from 'lucide-vue-next'

defineProps({
    items: {
        type: Array,
        default: () => [],
    },
})
</script>

<template>
    
    <div class="relative mb-8 overflow-hidden rounded-2xl bg-green-950 px-8 py-8 text-white">

        <div
            data-aos="fade-down"
            class="absolute right-16 top-2 h-16 w-16 rounded-full border border-green-700 opacity-20"
        ></div>

        <div
            data-aos="fade-up"
            class="absolute -bottom-4 right-8 h-24 w-24 rounded-full border border-green-600 opacity-10"
        ></div>

        <div
            data-aos="fade-left"
            class="absolute right-1/3 top-3 h-5 w-5 rotate-12 rounded bg-green-600 opacity-20"
        ></div>

        <div
            data-aos="zoom-in"
            class="absolute -left-8 top-1/2 h-32 w-32 -translate-y-1/2 rounded-full border-2 border-green-500 opacity-10"
        ></div>

        <div
            data-aos="fade-up"
            class="absolute bottom-2 left-1/4 h-3 w-3 rounded-full bg-green-400 opacity-20"
        ></div>


        <div class="absolute bottom-0 left-0 top-0 w-1 rounded-l-2xl bg-green-500"></div>


        <nav
            aria-label="Fil d'Ariane"
            class="relative flex flex-wrap items-center gap-1.5 text-sm"
        >

            <Link
                href="/"
                class="flex items-center gap-1.5 text-white-400 transition-colors hover:text-green-400"
            >
                <Home :size="20" />
                <span class="text-2xl">Accueil</span>
            </Link>

            <template
                v-for="(item, index) in items"
                :key="index"
            >

                <ChevronRight
                    :size="14"
                    class="text-green-500"
                />

                <Link
                    v-if="item.href"
                    :href="item.href"
                    class="text-white-400 text-2xl transition-colors hover:text-green-400"
                >
                    {{ item.label }}
                </Link>

                <span
                    v-else
                    class="font-medium text-white text-2xl"
                >
                    {{ item.label }}
                </span>

            </template>

        </nav>

    </div>
</template>
