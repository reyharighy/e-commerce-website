<script setup lang="ts">
interface Props {
    tag: number;
}

defineProps<Props>();
</script>

<template>
    <div v-if="tag" class="px-3 py-1 text-lg font-semibold rounded bg-yellow-400 text-gray-900">
        {{ tag }} %
    </div>
</template>