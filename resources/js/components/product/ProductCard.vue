<script setup lang="ts">
import Card from '../ui/card/Card.vue';
import CardDescription from '../ui/card/CardDescription.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import RatingStars from './RatingStars.vue';
import TagBadge from './TagBadge.vue';
import { Heart, ShoppingCart } from 'lucide-vue-next';

defineProps({
  product: {
    type: Object,
    required: true,
  },
});
</script>

<template>
    <Card
        class="bg-white text-black rounded-sm shadow-sm hover:shadow-md transition-shadow p-4 relative flex flex-col"
    >
        <!-- Tag Badge -->
        <TagBadge
        v-if="product.tag"
        :tag="product.tag"
        class="absolute top-2 left-2 px-2 py-1 text-xs font-bold rounded z-10"
        >
        {{ product.tag }}
        </TagBadge>

        <!-- Product Image -->
        <div class="w-full h-40 overflow-hidden bg-gray-50 rounded-sm">
        <img
            :src="product.image || 'https://via.placeholder.com/150'"
            :alt="product.title"
            class="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
        />
        </div>

        <!-- Rating -->
        <div class="mt-3">
        <RatingStars :rating="product.rating" />
        </div>

        <!-- Title -->
        <CardTitle
        class="line-clamp-2 min-h-[3rem] mt-2 font-semibold text-gray-800"
        >
        {{ product.title }}
        </CardTitle>

        <!-- Price -->
        <CardDescription class="mt-1 flex gap-2 items-center">
        <span class="text-blue-600 font-bold text-base">
            ${{ product.price }}
        </span>
        <span
            v-if="product.originalPrice"
            class="line-through text-gray-400 text-sm"
        >
            ${{ product.originalPrice }}
        </span>
        </CardDescription>

        <!-- Icons -->
        <div
        class="absolute top-2 right-2 flex flex-col gap-2 z-10"
        >
        <button
            class="bg-white p-1.5 rounded-full shadow hover:bg-gray-100 transition"
            aria-label="Add to Wishlist"
        >
            <Heart class="w-4 h-4 text-gray-600" />
        </button>
        <button
            class="bg-white p-1.5 rounded-full shadow hover:bg-gray-100 transition"
            aria-label="Add to Cart"
        >
            <ShoppingCart class="w-4 h-4 text-gray-600" />
        </button>
        </div>
    </Card>
</template>
