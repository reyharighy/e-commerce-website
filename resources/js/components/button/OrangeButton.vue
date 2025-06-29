<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({});
</script>

<template>
  <button class="h-[44px] bg-[#fa8232] flex gap-2 items-center text-white px-12 rounded-sm hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    <slot name="icon" />
  </button>
</template>
