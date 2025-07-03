<script setup lang="ts">
import { BreadcrumbItem, Product } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    Award, Truck, Handshake, Headphones, CreditCard
} from 'lucide-vue-next'

import {
    ProductImageGallery, ProductInfo, ProductVariants, ProductDetailsTabs,
} from '@/components/product/admin';
import { Separator } from '@/components/ui/separator';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
    {
        title: 'Backup',
        href: '/backup',
    },
];

const images = {
    '0': "https://images.unsplash.com/photo-1505751171710-1f6d0ace5a85?ixlib=rb-4.0.3&q=80&w=1080",
    '1': "https://images.unsplash.com/photo-1484704849700-f032a568e944?ixlib=rb-4.0.3&q=80&w=1080",
    '2': "https://images.unsplash.com/photo-1496957961599-e35b69ef5d7c?ixlib=rb-4.0.3&q=80&w=1080",
    '3': "https://images.unsplash.com/photo-1528148343865-51218c4a13e6?ixlib=rb-4.0.3&q=80&w=1080",
    '4': "https://images.unsplash.com/photo-1472289065668-ce650ac443d2?ixlib=rb-4.0.3&q=80&w=1080",
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Backup" />
        <div class="px-4 py-6 flex flex-col gap-4">
            <div class="flex flex-row gap-4 h-full border border-black">
                <ProductImageGallery :images="images" class="border border-red-500" />

                <div class="w-1/2 border border-blue-500">
                    <ProductInfo
                        :rating="4.5"
                        :feedbackCount="1220"
                        name="Premium Wireless Headphones"
                        category="Electronics"
                    />

                    <Separator class="border border-primary/50" />

                    <ProductVariants/>
                </div>
            </div>

            <ProductDetailsTabs :tabs="['DESCRIPTION', 'ADDITIONAL INFORMATION', 'SPECIFICATION', 'REVIEW']">
                <template #default="{ activeTab }">
                    <div v-if="activeTab === 'DESCRIPTION'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                        <div class="order-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">Description</h3>
                            <p class="text-gray-600 text-sm">
                                Powerful MacBook Pro with M1 Pro/Max chip, blazing fast performance and excellent battery life...
                            </p>
                        </div>

                        <div class="order-2">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">Feature</h3>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start gap-2"><span class="text-orange-500 mt-1"><Award/></span> Free 1 Year Warranty</li>
                                <li class="flex items-start gap-2"><span class="text-orange-500 mt-1"><Truck/></span> Free Shipping & Fasted Delivery</li>
                                <li class="flex items-start gap-2"><span class="text-orange-500 mt-1"><Handshake/></span> 100% Money-back guarantee</li>
                                <li class="flex items-start gap-2"><span class="text-orange-500 mt-1"><Headphones/></span> 24/7 Customer support</li>
                                <li class="flex items-start gap-2"><span class="text-orange-500 mt-1"><CreditCard/></span> Secure payment method</li>
                            </ul>
                        </div>

                        <div class="order-3 md:col-span-2 lg:col-span-1 md:border-t lg:border-l lg:border-t-0 border-gray-200 pt-4 md:pt-6 lg:pt-0 lg:pl-6">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">Shipping Information</h3>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li><strong>Courier:</strong> 2–4 days, <span class="text-green-600">free shipping</span></li>
                                <li><strong>Local Shipping:</strong> up to one week, <span>$19.00</span></li>
                                <li><strong>UPS Ground Shipping:</strong> 4–6 days, <span>$29.00</span></li>
                                <li><strong>Unishop Global Export:</strong> 3–4 days, <span>$39.00</span></li>
                            </ul>
                        </div>
                    </div>

                    <div v-else-if="activeTab === 'ADDITIONAL INFORMATION' || activeTab === 'SPECIFICATION' || activeTab === 'REVIEW'" class="text-gray-700 text-sm">
                        Coming soon...
                    </div>
                </template>
            </ProductDetailsTabs>
        </div>
    </AppLayout>
</template>