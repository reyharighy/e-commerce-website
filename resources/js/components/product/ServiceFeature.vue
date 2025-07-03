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
];
</script>

<template>
  <Card
    class="rounded-lg border mx-auto w-full max-w-7xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-primary/20"
  >
    <div
      v-for="(feature, index) in features"
      :key="index"
      class="flex items-center gap-4 px-6 py-5 dark:hover:bg-gray-800 transition-colors duration-200"
    >
      <!-- Icon -->
      <div
        class="flex items-center justify-center w-10 h-10 rounded-full bg-orange-100 text-orange-600"
      >
        <component :is="feature.icon" class="w-5 h-5" />
      </div>

      <!-- Text -->
      <div class="flex flex-col">
        <CardTitle class="text-sm font-semibold text-primary uppercase tracking-wide">
          {{ feature.title }}
        </CardTitle>
        <CardDescription class="text-xs text-primary/50">
          {{ feature.subtitle }}
        </CardDescription>
      </div>
    </div>
  </Card>
</template>
