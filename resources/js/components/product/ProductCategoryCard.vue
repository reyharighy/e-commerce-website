<script setup lang="ts">
    defineProps<{
    product: {
        id: number;
        name: string;
        price: string;
        image: string;
    };
    }>();
</script>

<template>
    <div class="flex items-center gap-4 p-3 border rounded-sm bg-white hover:shadow-sm transition">
        <!-- Gambar konsisten -->
        <img
        :src="product.image || 'https://via.placeholder.com/64'"
        :alt="product.name"
        class="w-16 h-16 object-cover aspect-square rounded-sm shrink-0"
        />

        <!-- Konten -->
        <div class="flex flex-col justify-between w-full min-h-[4.5rem]">
        <p class="text-sm font-medium text-gray-800 leading-tight line-clamp-2">
            {{ product.name }}
        </p>
        <p class="text-sm font-semibold text-blue-600 mt-auto">${{ product.price }}</p>
        </div>
    </div>
</template>

