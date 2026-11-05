<script setup>
    import { Link } from '@inertiajs/vue3'
    import { ArrowRight } from 'lucide-vue-next'

    defineProps({
        title: {
            type: String,
            required: true,
        },

        icon: {
            type: [Object, Function],
            required: true,
        },

        linkText: {
            type: String,
            default: null,
        },

        linkHref: {
            type: String,
            default: null,
        },
    })
</script>

<template>

    <div class="flex items-center gap-3">
        <component
            :is="icon"
            :size="40"
            class="text-green-700"
        />

        <h2 class="text-xl font-bold text-green-900">
            {{ title }}
        </h2>
    </div>

    <Link
        v-if="linkText && linkHref"
        :href="linkHref"
        class="flex items-center gap-1 text-sm font-medium text-green-700 hover:underline"
    >
        {{ linkText }}

        <ArrowRight :size="14" />

    </Link>

</template>

