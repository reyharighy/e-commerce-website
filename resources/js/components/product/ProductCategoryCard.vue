<script setup lang="ts">
import { Product } from '@/types';
import { Link } from '@inertiajs/vue3';
import TagBadge from './TagBadge.vue';
import RatingStars from './RatingStars.vue';
import { formatDistanceToNow } from 'date-fns'

interface Props {
    product: Product;
    typeBadge: string;
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
        <div class="flex items-center gap-4 p-3 border rounded-sm hover:shadow-sm transition">
            <!-- Gambar konsisten -->
            <img
                :src="route('storage.local', {path: getSource(product)})"
                class="w-16 h-16 object-contain aspect-square rounded-sm shrink-0"
            />
    
            <!-- Konten -->
            <div class="flex flex-col justify-between w-full min-h-[4.5rem]">
                <p class="text-sm font-medium text-primary leading-tight line-clamp-2">
                    {{ product.name }}
                </p>

                <TagBadge v-if="typeBadge === 'flashSale'" :tag="product.discount_percentage + '% OFF'" class="w-fit mt-1 text-base" />
                <p v-else-if="typeBadge === 'bestSellers'" class="text-primary mt-1 text-xs font-semibold">{{ product.review }} reviews</p>
                <RatingStars v-else-if="typeBadge === 'topRated'" :rating="product.rating" class="w-full mt-1" />
                <p v-else class="text-xs font-semibold mt-1">{{ formatDistanceToNow(product.created_at, { addSuffix: true }) }}</p>
    
                <p class="text-sm font-semibold text-blue-500 dark:text-blue-200 mt-auto">
                    Rp. {{ priceFormat(currentPrice(product)) }}
                </p>
            </div>
        </div>
    </Link>
</template>

