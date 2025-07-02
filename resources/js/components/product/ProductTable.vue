<script setup lang="ts">
interface Product {
    image: string;
    name: string;
    description: string;
    price: number;
    quantity: number;
}

defineProps<{
    products: Product[]
}>();
</script>

<template>
    <div>
        <!-- Judul dan jumlah produk -->
        <h2 class="text-lg font-semibold mb-4">
        Product <span class="font-medium text-gray-500">({{ products.length.toString().padStart(2, '0') }})</span>
        </h2>

        <!-- Tabel Produk -->
        <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
            <tr>
            <th class="p-2">Products</th>
            <th class="p-2">Price</th>
            <th class="p-2">Quantity</th>
            <th class="p-2 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index" class="border-b">
            <td class="p-2 flex items-center gap-3">
                <img
                :src="product.image"
                alt="Product image"
                class="min-w-[48px] w-12 h-12 sm:w-16 sm:h-16 object-cover rounded"
                />

                <div>
                <div class="font-medium">{{ product.name }}</div>
                <div class="text-xs text-gray-500">{{ product.description }}</div>
                </div>
            </td>
            <td class="p-2">${{ product.price }}</td>
            <td class="p-2">x{{ product.quantity }}</td>
            <td class="p-2 text-right font-semibold">
                ${{ (product.price * product.quantity).toFixed(2) }}
            </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>


