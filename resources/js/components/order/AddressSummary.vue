<script setup lang="ts">
    defineProps({
    billing: {
        type: Object,
        required: true
    },
    shipping: {
        type: Object,
        required: true
    },
    notes: {
        type: String,
        default: ''
    }
    })
</script>

<template>
    <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:divide-x">
        <!-- Billing Address -->
        <div class="min-w-0">
        <h3 class="font-semibold mb-1 text-lg">Billing Address</h3>
        <h4 class="font-semibold text-sm">{{ billing.name }}</h4>
        <p class="text-sm text-gray-700 break-words whitespace-normal">
            {{ billing.address }} <br />
            {{ billing.email }}
        </p>
        <p class="text-sm text-gray-700 mt-1">
            <span class="font-semibold">Phone Number:</span>
            <span class="font-light">{{ billing.phone }}</span>
        </p>
        <p class="text-sm text-gray-700">
            <span class="font-semibold">Email:</span>
            <span class="font-light break-words">{{ billing.email }}</span>
        </p>
        </div>

        <!-- Shipping Address -->
        <div class="min-w-0">
        <h3 class="font-semibold mb-1 text-lg">Shipping Address</h3>
        <h4 class="font-semibold text-sm">{{ shipping.name }}</h4>
        <p class="text-sm text-gray-700 break-words whitespace-normal">
            {{ shipping.address }} <br />
            {{ shipping.email }} <br />
            {{ shipping.phone }}
        </p>
        <p class="text-sm text-gray-700 mt-1">
            <span class="font-semibold">Phone Number:</span>
            <span class="font-light">{{ shipping.phone }}</span>
        </p>
        <p class="text-sm text-gray-700">
            <span class="font-semibold">Email:</span>
            <span class="font-light break-words">{{ shipping.email }}</span>
        </p>
        </div>

        <!-- Order Notes -->
        <div class="min-w-0">
        <h3 class="font-semibold mb-1 text-lg">Order Notes</h3>
        <p class="text-sm text-gray-700 break-words whitespace-normal">
            {{ notes }}
        </p>
        </div>
    </div>
</template>

