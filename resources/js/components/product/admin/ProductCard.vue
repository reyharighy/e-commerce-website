<script setup lang="ts">
import { Card, CardDescription } from '@/components/ui/card';
import { StarRatings, TagBadge } from '.';

interface Props {
    product: any;
}

defineProps<Props>();
</script>

<template>
    <Card class="bg-white text-black rounded shadow p-4 relative flex flex-col">
        <!-- Tag Badge -->
        <TagBadge
            :tag="product.tag"
            class="absolute top-2 left-2 px-2 py-1 text-xs font-bold rounded z-10">
            {{ product.tag }}
        </TagBadge>

        <!-- Product Image -->
        <div class="w-full h-40 overflow-hidden bg-gray-50">
        <img
            :src="product.image || 'https://via.placeholder.com/150'"
            class="h-full w-full object-cover"/>
        </div>

        <!-- Rating -->
        <StarRatings :rating="product.rating"/>

        <!-- Title -->
        <CardTitle
            :title="product.title"
            class="line-clamp-2 min-h-[3rem]">
            {{ product.title }}
        </CardTitle>

        <!-- Price -->
        <CardDescription>
            <span class="text-blue-600 font-bold text-base">${{ product.price }}</span>
            <span
                v-if="product.originalPrice"
                class="line-through text-gray-400 text-sm">${{ product.originalPrice }}</span>
        </CardDescription>

        <!-- Icons -->
        <div class="absolute top-2 right-2 flex flex-col gap-2">
            <button class="bg-white p-1 rounded-full shadow hover:bg-gray-100">♡</button>
            <button class="bg-white p-1 rounded-full shadow hover:bg-gray-100">🛒</button>
        </div>
    </Card>
</template>