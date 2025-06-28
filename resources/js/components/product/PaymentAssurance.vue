<script setup lang="ts">
const paymentIcons = [
    'https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png',
    'https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg',
    'https://picsum.photos/200/300',
    'https://picsum.photos/200/400',
    'https://picsum.photos/200/600',
    'https://picsum.photos/200/300',
    'https://picsum.photos/200/300',
    'https://picsum.photos/600/300'
  ];
</script>

<template>
    <div class="p-4 border rounded shadow-sm bg-white w-fit">
        <p class="text-sm font-medium mb-2">100% Guarantee Safe Checkout</p>
        <div class="flex items-center space-x-2">
            <img
            v-for="(icon, index) in paymentIcons"
            :key="index"
            :src="icon"
            alt="Payment Method"
            class="w-[60px] h-[24px] object-contain"
            />
        </div>
    </div>
</template>