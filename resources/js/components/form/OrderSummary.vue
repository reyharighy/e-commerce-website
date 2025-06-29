<script setup lang="ts">
    import { MoveRight } from 'lucide-vue-next';
    import OrangeButton from '../button/OrangeButton.vue';

    interface OrderItem {
    image: string;
    name: string;
    quantity: number;
    price: number;
    }

    interface SummaryDetail {
    [key: string]: string | number; // e.g., shipping: "Free", tax: 10
    }

    defineProps<{
    items: OrderItem[];
    summaryDetails: SummaryDetail;
    total: number;
    }>();
</script>

<template>
    <div class="max-w-sm mx-auto bg-white border p-6 rounded">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

        <div class="space-y-4">
        <div v-for="(item, index) in items" :key="index" class="flex items-center">
            <img :src="item.image" class="h-16 w-16 rounded-sm object-cover mr-4" :alt="item.name" />
            <div class="flex-1">
            <p class="font-medium text-gray-800 line-clamp-1">{{ item.name }}</p>
            <p class="text-sm text-gray-500">
                {{ item.quantity }} x
                <span class="text-blue-600 font-semibold">${{ item.price }}</span>
            </p>
            </div>
        </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-200">
        <div class="space-y-2 text-gray-600">
            <dl class="flex items-center justify-between" v-for="(value, key) in summaryDetails" :key="key">
            <dt class="capitalize">{{ key }}</dt>
            <dd class="font-medium text-gray-800">
                {{ typeof value === 'number' ? `$${value}` : value }}
            </dd>
            </dl>
        </div>

        <dl class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
            <dt class="text-lg font-medium text-gray-900">Total</dt>
            <dd class="text-lg font-medium text-gray-900">${{ total }} USD</dd>
        </dl>
        </div>

        <div class="mt-6">
        <OrangeButton class="w-full flex items-center justify-center font-bold">
            <template #icon>
            PLACE ORDER
            <MoveRight />
            </template>
        </OrangeButton>
        </div>
    </div>
</template>
