<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps({
    tag: String
})

const badgeClass = computed(() => {
    if (!props.tag) return ''
    if (props.tag === 'HOT') return 'bg-red-500 text-white'
    if (props.tag === 'SALE') return 'bg-green-500 text-white'
    if (props.tag.includes('%')) return 'bg-yellow-400 text-black'
    if (props.tag === 'BEST DEALS') return 'bg-blue-500 text-white'
    return 'bg-gray-200 text-black'
})
</script>

<template>
    <span v-if="tag" :class="badgeClass" class="px-2 py-1 text-xs font-semibold rounded">
        {{ tag }}
    </span>
</template>