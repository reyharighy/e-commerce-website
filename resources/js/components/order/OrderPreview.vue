<script setup lang="ts">
    defineProps({
    orderId: {
        type: [String, Number],
        required: true
    },
    productCount: {
        type: Number,
        required: true
    },
    orderDate: {
        type: String,
        required: true
    },
    orderTime: {
        type: String,
        required: true
    },
    totalAmount: {
        type: [String, Number],
        required: true
    }
    })
</script>

<template>
    <div class="bg-[#fdfae7] p-4 rounded flex justify-between items-center border border-orange-200">
        <div>
        <div class="text-gray-600 text-md font-semibold mb-2">#{{ orderId }}</div>
        <div class="text-gray-500 text-xs">
            {{ productCount }} Products • Order Placed on {{ orderDate }} at {{ orderTime }}
        </div>
        </div>
        <div class="text-2xl font-semibold text-[#2da5f3]">
        ${{ totalAmount }}
        </div>
    </div>
</template>
