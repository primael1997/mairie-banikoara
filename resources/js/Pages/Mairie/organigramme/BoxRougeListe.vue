<script setup>
    defineProps({
        items: { type: Array, required: true },
    });
</script>

<template>
  <div class="bg-red-200 text-red-900 border border-red-400 rounded-lg px-3 py-2 min-w-[120px]">
    <p v-for="item in items" :key="item" class="text-xs leading-tight">› {{ item }}</p>
  </div>
</template>
