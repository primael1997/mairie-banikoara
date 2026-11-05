<script setup>
    defineProps({
        label: { type: String, required: true },
        sub: { type: String, default: "" },
    });
</script>

<template>
  <div class="bg-green-800 text-white border border-green-600 rounded-lg px-3 py-2 text-center min-w-[120px]">
    <p class="text-xs font-bold leading-tight">{{ label }}</p>
    <p v-if="sub" class="text-xs font-bold leading-tight">{{ sub }}</p>
  </div>
</template>
