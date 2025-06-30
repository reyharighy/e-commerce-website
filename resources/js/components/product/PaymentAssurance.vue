<script setup lang="ts">
    const paymentIcons = [
    {
        src: 'https://cdn.freebiesupply.com/logos/large/2x/visa-logo-svg-vector.svg',
        alt: 'Payment Option 1'
    },
    {
        src: 'https://images.seeklogo.com/logo-png/8/2/master-card-logo-png_seeklogo-89117.png',
        alt: 'Payment Option 2'
    },
    {
        src: 'https://download.logo.wine/logo/PayPal/PayPal-Logo.wine.png',
        alt: 'Payment Option 3'
    },
    {
        src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-U8tK4EfgFz0FAX0yYoXfE05yWfq2tqNLQw&s',
        alt: 'Payment Option 4'
    },
    {
        src: 'https://brandlogos.net/wp-content/uploads/2022/10/gopay-logo_brandlogos.net_gph3u.png',
        alt: 'Payment Option 5'
    },
    {
        src: 'https://images.seeklogo.com/logo-png/39/2/dana-e-wallet-app-logo-png_seeklogo-399948.png',
        alt: 'Payment Option 6'
    }
    ];
</script>

<template>
    <div class="p-4 border rounded shadow-sm bg-white w-full max-w-sm">
        <p class="text-sm font-medium mb-3">100% Guarantee Safe Checkout</p>
        <div class="grid grid-cols-4 gap-2 sm:grid-cols-5 md:grid-cols-6">
        <img
            v-for="(icon, index) in paymentIcons"
            :key="index"
            :src="icon.src"
            :alt="icon.alt"
            :title="icon.alt"
            class="h-6 w-full object-cover"
        />
        </div>
    </div>
</template>
