<script setup>
    defineProps({
        label: { type: String, required: true },
    });
</script>

<template>
    <div class="bg-gray-200 text-gray-700 border border-gray-400 rounded px-2 py-1 text-center min-w-[60px]">
        <p class="text-xs font-medium leading-tight">{{ label }}</p>
    </div>
</template>
