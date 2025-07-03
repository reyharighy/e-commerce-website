<script setup lang="ts">
import { defineProps } from 'vue'
import StarRatings from './StarRatings.vue'

interface Props {
    rating: number;
    feedbackCount: number;
    name: string;
    category: string;
}

defineProps<Props>()

</script>

<template>
    <div class="flex flex-col justify-evenly h-1/3 shrink-0 border border-yellow-500">
        <div class="flex flex-col gap-2">
            <h2 class="text-2xl font-semibold text-primary">{{ name }}</h2>

            <div class="flex items-center gap-4">
                <StarRatings :rating="rating" />
                <span class="text-primary">({{ feedbackCount.toLocaleString() }} reviews)</span>
            </div>
        </div>

        <div class="flex gap-4">
            <div class="text-primary text-lg font-medium rounded-lg bg-blue-200 py-3 px-5">{{ category }}</div>
        </div>
    </div>
</template>
