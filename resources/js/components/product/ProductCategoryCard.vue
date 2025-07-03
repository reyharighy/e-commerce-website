<script setup lang="ts">
import { Product } from '@/types';

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

            <p class="text-sm font-semibold text-blue-500 dark:text-blue-200 mt-auto">
                Rp. {{ priceFormat(currentPrice(product)) }}
            </p>
        </div>
    </div>
</template>

