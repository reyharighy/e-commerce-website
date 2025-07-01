<script setup lang="ts">
    import { Trash2 } from 'lucide-vue-next'

    interface Product {
    image: string
    name: string
    description: string
    price: number
    inStock: boolean
    }

    defineProps<{
    products: Product[]
    }>()
</script>

<template>
    <div class="p-4 md:p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-1">Your Wishlist Items</h2>
        <p class="text-sm text-gray-600 mb-4">
        There are {{ products.length.toString().padStart(2, '0') }} products in this list
        </p>

        <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg text-sm">
            <thead class="text-left text-gray-600">
            <tr class="border-b">
                <th class="p-3 font-semibold whitespace-nowrap">Product</th>
                <th class="p-3 font-semibold whitespace-nowrap">Price</th>
                <th class="p-3 font-semibold whitespace-nowrap">Stock Status</th>
                <th class="p-3 font-semibold whitespace-nowrap">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(product, index) in products"
                :key="index"
                class="border-b hover:bg-gray-50 transition"
            >
                <!-- Product -->
                <td class="p-3 min-w-[200px]">
                <div class="flex items-center gap-3">
                    <img
                    :src="product.image"
                    alt="product"
                    class="w-12 h-12 rounded object-cover bg-gray-100"
                    />
                    <div class="text-sm">
                    <p class="font-semibold">{{ product.name }}</p>
                    <p class="text-xs text-gray-500">{{ product.description }}</p>
                    </div>
                </div>
                </td>

                <!-- Price -->
                <td class="p-3 font-semibold text-gray-900">${{ product.price.toFixed(2) }}</td>

                <!-- Stock -->
                <td class="p-3">
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full whitespace-nowrap"
                    :class="product.inStock ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'"
                >
                    {{ product.inStock ? 'In Stock' : 'Stock Out' }}
                </span>
                </td>

                <!-- Action -->
                <td class="p-3">
                <div class="flex items-center gap-2">
                    <button
                    class="px-4 py-2 text-xs font-medium rounded-md whitespace-nowrap"
                    :class="product.inStock ? 'bg-[#fa8232] text-white hover:bg-orange-600' : 'bg-gray-500 text-white hover:bg-gray-700'"
                    >
                    {{ product.inStock ? 'Add to Cart' : 'Contact Us' }}
                    </button>
                    <button
                    @click="$emit('remove', product)"
                    class="hover:text-red-600 transition p-1"
                    aria-label="Remove item"
                    >
                    <Trash2 class="w-4 h-4" />
                    </button>
                </div>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>
