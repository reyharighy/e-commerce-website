<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Award, Truck, Handshake, Headphones, CreditCard, ShoppingCart, Construction } from 'lucide-vue-next';
    import ProductImageGallery from '@/components/product/ProductImageGallery.vue';
    import ProductInfo from '@/components/product/ProductInfo.vue';
    import ProductVariants from '@/components/product/ProductVariants.vue';
    import QuantitySelector from '@/components/product/QuantitySelector.vue';
    import WishListButton from '@/components/button/WishListButton.vue';
    import PaymentAssurance from '@/components/product/PaymentAssurance.vue';
    import ProductDetailsTabs from '@/components/product/ProductDetailsTabs.vue';
    import OrangeButton from '@/components/button/OrangeButton.vue';
    import OrangeOutlineButton from '@/components/button/OrangeOutlineButton.vue';
    import { BreadcrumbItem } from '@/types';

    const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Details',
        href: '/product-details',
    },
    ];

    const images = [
    "https://images.unsplash.com/photo-1505751171710-1f6d0ace5a85?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1484704849700-f032a568e944?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1496957961599-e35b69ef5d7c?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1528148343865-51218c4a13e6?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1472289065668-ce650ac443d2?ixlib=rb-4.0.3&q=80&w=1080"
    ]
</script>

<template>
    <Head title="Product Details" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap gap-x-8 gap-y-6 mb-8">
                <ProductImageGallery :images="images" class="basis-full md:basis-1/2"/>
                <!-- Product Details -->  
                <div class="w-full md:w-1/2 flex-1">
                    <div class="flex items-center mb-4">
                        <ProductInfo
                            :rating="4.5"
                            :feedbackCount="1220"
                            title="Premium Wireless Headphones"
                            sku="WH1000XM4"
                            availability="In Stock"
                            brand="JBL"
                            category="Electronics"
                            price="$349.99"
                            oldPrice="$399.99"
                            discountTag="21% OFF"
                            />
                    </div>
                    <ProductVariants/>
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <QuantitySelector />

                        <OrangeButton class="w-full sm:flex-1 sm:min-w-[160px] hover:shadow-md hover:-translate-y-0.5 transition duration-200">
                            <template #icon>
                            <ShoppingCart class="w-5 h-5" />
                            <span class="ml-2 font-bold">Add to Cart</span>
                            </template>
                        </OrangeButton>

                        <OrangeOutlineButton class="w-full sm:flex-1 sm:min-w-[160px] hover:shadow-md hover:-translate-y-0.5 transition duration-200">
                            Buy Now
                        </OrangeOutlineButton>
                    </div>
                    <WishListButton/>
                    <PaymentAssurance/>
                </div>
            </div>
            
            <ProductDetailsTabs :tabs="['DESCRIPTION', 'ADDITIONAL INFORMATION', 'SPECIFICATION', 'REVIEW']">
                <template #default="{ activeTab }">
                    <div v-if="activeTab === 'DESCRIPTION'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    
                    <!-- Description -->
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                        Powerful MacBook Pro with M1 Pro/Max chip, blazing fast performance and excellent battery life...
                        </p>
                    </div>

                    <!-- Features -->
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Features</h3>
                        <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-2"><span class="text-[#fa8232] mt-1"><Award class="w-5 h-5" /></span>Free 1 Year Warranty</li>
                        <li class="flex items-start gap-2"><span class="text-[#fa8232] mt-1"><Truck class="w-5 h-5" /></span>Free Shipping & Fast Delivery</li>
                        <li class="flex items-start gap-2"><span class="text-[#fa8232] mt-1"><Handshake class="w-5 h-5" /></span>100% Money-back Guarantee</li>
                        <li class="flex items-start gap-2"><span class="text-[#fa8232] mt-1"><Headphones class="w-5 h-5" /></span>24/7 Customer Support</li>
                        <li class="flex items-start gap-2"><span class="text-[#fa8232] mt-1"><CreditCard class="w-5 h-5" /></span>Secure Payment Methods</li>
                        </ul>
                    </div>

                    <!-- Shipping Info -->
                    <div class="md:col-span-2 lg:col-span-1 md:border-t lg:border-l lg:border-t-0 border-gray-200 pt-4 md:pt-6 lg:pt-0 lg:pl-6">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Shipping Information</h3>
                        <ul class="text-sm text-gray-700 space-y-2">
                        <li><strong>Courier:</strong> 2–4 days – <span class="text-green-600 font-medium">Free Shipping</span></li>
                        <li><strong>Local Shipping:</strong> Up to 1 week – <span class="font-medium text-gray-900">$19.00</span></li>
                        <li><strong>UPS Ground:</strong> 4–6 days – <span class="font-medium text-gray-900">$29.00</span></li>
                        <li><strong>Unishop Export:</strong> 3–4 days – <span class="font-medium text-gray-900">$39.00</span></li>
                        </ul>
                    </div>
                    </div>

                    <!-- Coming Soon -->
                    <div v-else class="flex text-gray-500 text-center py-8 text-sm justify-center">
                        <Construction class="mr-2 text-[#fa8232]"/>This section is under construction. Stay tuned!
                    </div>
                </template>
            </ProductDetailsTabs>
        </div>
    </AppLayout>
</template>