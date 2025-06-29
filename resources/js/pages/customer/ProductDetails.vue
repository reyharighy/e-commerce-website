<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Award, Truck, Handshake, Headphones, CreditCard, ShoppingCart } from 'lucide-vue-next';
    import ProductImageGallery from '@/components/product/ProductImageGallery.vue';
    import ProductInfo from '@/components/product/ProductInfo.vue';
    import ProductVariants from '@/components/product/ProductVariants.vue';
    import QuantitySelector from '@/components/product/QuantitySelector.vue';
    import BuyNowButton from '@/components/button/BuyNowButton.vue';
    import WishListButton from '@/components/button/WishListButton.vue';
    import PaymentAssurance from '@/components/product/PaymentAssurance.vue';
    import ProductDetailsTabs from '@/components/product/ProductDetailsTabs.vue';
    import OrangeButton from '@/components/button/OrangeButton.vue';

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
    <AppLayout :breadcrumbs="[{ title: 'Product Details', href: '/product-details' }]">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4 mb-8">
                <ProductImageGallery :images="images"/>
                <!-- Product Details -->  
                <div class="w-full md:w-1/2 px-4">
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
                    <div class="flex space-x-4 mb-6 flex-wrap gap-2">
                        <QuantitySelector/>
                        <OrangeButton class="w-1/3 flex items-center justify-center font-bold">
                            <template #icon>
                            ADD TO CART
                            <ShoppingCart />
                            </template>
                        </OrangeButton>
                        <BuyNowButton/>
                    </div>
                    <WishListButton/>
                    <PaymentAssurance/>
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