<script setup lang="ts">
    defineProps<{
    product: {
        id: number
        name: string
        price: string
        image: string
    }
    }>();
</script>

<template>
    <div class="flex items-center gap-3 p-3 bg-white rounded shadow-sm hover:shadow transition">
        <img
            :src="product.image || 'https://via.placeholder.com/48'"
            alt="product"
            class="w-12 h-12 object-contain shrink-0" />
        <CardContent class="flex flex-col">
            <p class="text-sm text-gray-700 line-clamp-3 min-h-[4rem] 2xl:min-h-[3rem]">
                {{ product.name }}
            </p>
            <p class="text-sm font-semibold text-blue-600">{{ product.price }}</p>
        </CardContent>
    </div>
</template>