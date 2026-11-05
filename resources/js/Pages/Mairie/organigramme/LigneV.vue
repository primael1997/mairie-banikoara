<script setup>
    defineProps({
        h: { type: String, default: "h-4" },
    });
</script>

<template>
    <div :class="['w-px', h, 'bg-gray-400 mx-auto']" />
</template>
