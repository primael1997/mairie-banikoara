<script setup>
    defineProps({
        label: { type: String, required: true },
    });
</script>

<template>
  <div class="bg-red-200 text-red-900 border border-red-400 rounded-lg px-2 py-1.5 text-center min-w-[80px]">
    <p class="text-xs font-medium leading-tight">{{ label }}</p>
  </div>
</template>
