<template>
  <div class="bg-white p-6 rounded-xl shadow-md w-full">
    <h3 class="text-gray-700 text-sm">{{ title }}</h3>
    <p class="text-2xl font-bold mt-2">{{ value }}</p>
  </div>
</template>

<script setup lang="ts">
defineProps({
  title: String,
  value: String,
})
</script>
