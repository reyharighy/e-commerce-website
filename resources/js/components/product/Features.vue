<script setup lang="ts">
    import { Trophy, CreditCard, Headphones, Package } from 'lucide-vue-next';
    import Card from '../ui/card/Card.vue';
    import CardTitle from '../ui/card/CardTitle.vue';
    import CardDescription from '../ui/card/CardDescription.vue';
    const features = [
        {
            title: 'Fasted Delivery',
            subtitle: 'Delivery in 24/H',
            icon: Package,
        },
        {
            title: '24 Hours Return',
            subtitle: '100% money-back guarantee',
            icon: Trophy,
        },
        {
            title: 'Secure Payment',
            subtitle: 'Your money is safe',
            icon: CreditCard,
        },
        {
            title: 'Support 24/7',
            subtitle: 'Live contact/message',
            icon: Headphones,
        },
        ]
</script>

<template>
    <Card class="bg-white rounded-lg border mx-4 md:p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-gray-200">
        <div
        v-for="(feature, index) in features"
        :key="index"
        class="flex items-center gap-4 px-4 py-2">
        <!-- Icon -->
        <div class="text-2xl text-gray-700">
            <component :is="feature.icon" class="w-6 h-6" />
        </div>
        <!-- Text -->
        <div>
            <CardTitle class="text-sm font-semibold text-gray-900 uppercase">
            {{ feature.title }}
            </CardTitle>
            <CardDescription class="text-xs text-gray-500">
            {{ feature.subtitle }}
            </CardDescription>
        </div>
        </div>
    </Card>
</template>