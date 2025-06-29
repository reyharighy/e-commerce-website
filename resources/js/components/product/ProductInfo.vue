<script setup lang="ts">
import TagBadge from './TagBadge.vue'
import { defineProps } from 'vue'
import RatingStars from './RatingStars.vue';

defineProps<{
    rating: number
    feedbackCount: number
    title: string
    sku: string
    availability: string
    brand: string
    category: string
    price: string
    oldPrice: string
    discountTag: string
}>()

</script>

<template>
    <div>
        <div class="flex items-center mb-4">
            <RatingStars :rating="rating" />
            <span class="ml-2">{{ rating }} Star Rating</span>
            <span class="ml-4 text-gray-600">({{ feedbackCount.toLocaleString() }} User feedback)</span>
        </div>

        <h2 class="text-2xl font-medium mb-2">{{ title }}</h2>

        <div class="grid grid-cols-2 mb-4 gap-4">
        <p class="text-gray-600">SKU: {{ sku }}</p>
        <p class="text-gray-600">
            Availability:
            <span :class="availability === 'In Stock' ? 'text-green-600' : 'text-red-600'">{{ availability }}</span>
        </p>
        <p class="text-gray-600">Brand: {{ brand }}</p>
        <p class="text-gray-600">Category: {{ category }}</p>
        </div>

        <div class="mb-4">
        <span class="text-2xl font-bold mr-2">{{ price }}</span>
        <span class="text-gray-500 line-through">{{ oldPrice }}</span>
        <span class="ml-4">
            <TagBadge :tag="discountTag" />
        </span>
        <hr class="mt-4" />
        </div>
    </div>
</template>
