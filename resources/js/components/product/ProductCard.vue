<script setup lang="ts">
import { Product } from '@/types';
import Card from '../ui/card/Card.vue';
import CardDescription from '../ui/card/CardDescription.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import RatingStars from './RatingStars.vue';
import TagBadge from './TagBadge.vue';
import { Heart, ShoppingCart } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

interface Props {
    product: Product;
}

defineProps<Props>();

const currentPrice = (product: Product): number => {
    return product.price * (100 - product.discount_percentage) / 100;
};

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

const getSource = (product: Product): string | undefined => {
    return product.product_variants?.pop()?.product_images?.pop()?.url;
};
</script>

<template>
    <Link :href="route('product-details', {product: product})">
        <Card class="bg-white text-black rounded-sm shadow-sm hover:shadow-md transition-shadow p-4 relative flex flex-col">
            <!-- Product Image -->
            <div class="w-full h-40 overflow-hidden bg-gray-50 rounded-sm">
                <img
                    :src="route('storage.local', {path: getSource(product)})"
                    :alt="product.name"
                    class="h-full w-full object-contain transition-transform duration-300 hover:scale-105"
                />
            </div>
    
            <!-- Rating & Review -->
            <div class="flex flex-col gap-2">
                <RatingStars :rating="product.rating" />
                <span class="text-primary">{{ product.review }} reviews</span>
            </div>
    
            <!-- Title -->
            <CardTitle class="mt-1 font-semibold text-gray-800">
                {{ product.name }}
            </CardTitle>
    
            <!-- Price -->
            <CardDescription class="mt-1 flex gap-2 items-center">
                <span class="text-blue-600 font-bold text-base">
                    Rp. {{ priceFormat(currentPrice(product)) }}
                </span>
    
                <span 
                    v-if="product.discount_percentage > 0"
                    class="line-through text-gray-400 text-sm"
                >
                    Rp. {{ priceFormat(product.price) }}
                </span>
            </CardDescription>
    
            <!-- Icons -->
            <div class="absolute top-2 right-2 flex flex-col gap-2 z-10">
                <button
                    class="bg-primary-foreground p-1.5 rounded-full shadow hover:cursor-pointer transition"
                    aria-label="Add to Wishlist"
                >
                    <Heart class="w-4 h-4 text-primary hover:fill-pink-500 hover:text-pink-500" />
                </button>
    
                <button
                    class="bg-primary-foreground p-1.5 rounded-full shadow hover:cursor-pointer transition"
                    aria-label="Add to Cart"
                >
                    <ShoppingCart class="w-4 h-4 text-primary hover:fill-orange-500 hover:text-orange-500" />
                </button>
            </div>
        </Card>
    </Link>
</template>
