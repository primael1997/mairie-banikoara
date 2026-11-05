<script setup>
    defineProps({
        label: { type: String, required: true },
    });
</script>

<template>
    <div class="bg-green-100 text-green-900 border border-green-400 rounded-lg px-3 py-2 text-center min-w-[100px]">
        <p class="text-xs font-semibold leading-tight">{{ label }}</p>
    </div>
</template>
