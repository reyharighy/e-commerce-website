<script setup lang="ts">
import { MoveRight, Layers } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import SuccessIcon from '@/components/icon/SuccessIcon.vue';
import OrangeOutlineButton from '@/components/button/OrangeOutlineButton.vue';
import OrangeButton from '@/components/button/OrangeButton.vue';

const breadcrumbs: BreadcrumbItem[] = [
{
    title: 'CheckoutSuccess',
    href: '/checkout-success',
},
];
</script>

<template>
    <Head title="CheckoutSuccess"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col items-center justify-center text-center space-y-6 py-16">
            <SuccessIcon />

            <div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                Your order is successfully placed
            </h2>
            <p class="mt-2 text-sm text-gray-500 max-w-md">
                Pellentesque sed lectus nec tortor tristique accumsan quis dictum risus.
                Donec volutpat mollis nulla non facilisis.
            </p>
            </div>

            <div class="flex gap-4 max-sm:grid">
            <OrangeOutlineButton @click="$emit('go-home')">
                <Layers/>
                GO TO HOMEPAGE
            </OrangeOutlineButton>

            <OrangeButton @click="$emit('view-order')">
                <template #icon>
                VIEW ORDER
                <MoveRight class="ml-2 w-4 h-4" />
                </template>
            </OrangeButton>
            </div>
        </div>
    </AppLayout>
</template>