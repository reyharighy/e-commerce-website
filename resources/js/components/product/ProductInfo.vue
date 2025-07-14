<script setup lang="ts">
    import TagBadge from './TagBadge.vue'
    import RatingStars from './RatingStars.vue'

    defineProps<{
    rating: number
    feedbackCount: number
    title: string
    sku?: string
    availability: string
    brand?: string
    category: string
    price: string
    oldPrice: string
    discountTag: string
    }>()
</script>

<template>
    <div class="space-y-4">
        <!-- Rating Section -->
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-700">
        <RatingStars :rating="rating" />
        <span class="font-medium">{{ rating.toFixed(1) }} Star Rating</span>
        <span class="text-gray-500">({{ feedbackCount.toLocaleString() }} Reviews)</span>
        </div>

        <!-- Title -->
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900">{{ title }}</h1>

        <!-- Info Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-2 text-sm text-gray-600">
        <div>Category: <span class="font-medium text-gray-800">{{ category }}</span></div>
        <div>
            Availability:
            <span :class="availability === 'In Stock' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">
            {{ availability }}
            </span>
        </div>
        <!-- <div class="text-transparent">Brand: <span class="font-medium text-transparent">{{ brand }}</span></div>
        <div class="text-transparent">Category: <span class="font-medium text-transparent">{{ category }}</span></div> -->
        </div>

        <!-- Price and Tag -->
        <div class="flex flex-wrap items-center gap-3 mt-2">
        <span class="text-2xl font-bold text-[#fa8232]">{{ price }}</span>
        <span class="line-through text-gray-400 text-lg">{{ oldPrice }}</span>
        <TagBadge :tag="discountTag" />
        </div>

        <hr class="mt-4 border-gray-200" />
    </div>
</template>