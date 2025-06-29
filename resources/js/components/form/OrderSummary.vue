<script setup lang="ts">
    import { MoveRight } from 'lucide-vue-next'
    import OrangeButton from '../button/OrangeButton.vue'

    interface OrderItem {
    image: string
    name: string
    quantity: number
    price: number
    }

    interface SummaryDetail {
    [key: string]: string | number
    }

    defineProps<{
    items: OrderItem[]
    summaryDetails: SummaryDetail
    total: number
    }>()

    function formatCurrency(value: number): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }).format(value)
    }
</script>

<template>
    <div class="max-w-sm w-full mx-auto bg-white border border-gray-200 p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

        <!-- Order Items -->
        <div class="space-y-5">
        <div
            v-for="(item, index) in items"
            :key="index"
            class="flex items-start gap-4"
        >
            <img
            :src="item.image"
            :alt="item.name"
            class="h-16 w-16 rounded object-cover border"
            />
            <div class="flex-1">
            <p class="font-medium text-gray-900 line-clamp-1">
                {{ item.name }}
            </p>
            <p class="text-sm text-gray-600">
                {{ item.quantity }} ×
                <span class="text-blue-600 font-semibold">
                {{ formatCurrency(item.price) }}
                </span>
            </p>
            </div>
        </div>
        </div>

        <!-- Summary Details -->
        <div class="mt-6 pt-5 border-t border-gray-200">
        <dl
            v-for="(value, key) in summaryDetails"
            :key="key"
            class="flex items-center justify-between py-1 text-sm text-gray-700"
        >
            <dt class="capitalize">{{ key }}</dt>
            <dd class="font-medium text-gray-900">
            {{ typeof value === 'number' ? formatCurrency(value) : value }}
            </dd>
        </dl>

        <dl class="flex items-center justify-between mt-4 pt-4 border-t border-gray-300">
            <dt class="text-lg font-semibold text-gray-900">Total</dt>
            <dd class="text-lg font-semibold text-gray-900">
            {{ formatCurrency(total) }}
            </dd>
        </dl>
        </div>

        <!-- CTA Button -->
        <div class="mt-6">
        <OrangeButton class="w-full flex items-center justify-center font-semibold gap-2 py-2">
            <template #icon>
            PLACE ORDER
            <MoveRight class="ml-1" />
            </template>
        </OrangeButton>
        </div>
    </div>
</template>
