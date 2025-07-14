<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Award, Truck, Handshake, Headphones, CreditCard, ShoppingCart, Construction } from 'lucide-vue-next';
import ProductImageGallery from '@/components/product/ProductImageGallery.vue';
import ProductInfo from '@/components/product/ProductInfo.vue';
import WishListButton from '@/components/button/WishListButton.vue';
import PaymentAssurance from '@/components/product/PaymentAssurance.vue';
import ProductDetailsTabs from '@/components/product/ProductDetailsTabs.vue';
import OrangeButton from '@/components/button/OrangeButton.vue';
import OrangeOutlineButton from '@/components/button/OrangeOutlineButton.vue';
import { BreadcrumbItem, Product, ProductImage, User } from '@/types';
import { Label } from '@/components/ui/label';
import {
    SelectContent, SelectGroup, SelectItem, SelectItemIndicator, SelectItemText, SelectPortal, SelectRoot, SelectTrigger, SelectValue, SelectViewport,
} from 'radix-vue';
import { capitalize } from 'vue';
import { ref } from 'vue';

interface Props {
    product: Product;
    images: ProductImage[];
    sizeAvailability: string[];
    colorAvailability: string[];
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Details',
        href: '/product-details',
    },
];

const currentPrice = (product: Product): number => {
    return product.price * (100 - product.discount_percentage) / 100;
};

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

const cartForm = useForm({
    size: '',
    color: '',
    quantity: 1,
});

const getColorCode = (color: string): string => {
    return 'bg-' + color + '-500';
};

const quantity = ref(1);

function increment() {
    quantity.value++;
}

function decrement() {
    if (quantity.value > 1) quantity.value--;
}

const user = usePage().props.auth.user as User;

const addCart = () => {
    cartForm.post(route('carts.store', {user: user}), {
        preserveScroll: true,
    });
};
</script>

<template>
    <template hidden>
        <span class="sr-only" hidden>Load all colors availability in compile-time</span>
        <div hidden :class="[
            'bg-red-500', 'bg-orange-500', 'bg-amber-500', 'bg-yellow-500', 'bg-lime-500', 'bg-green-500',
            'bg-emerald-500', 'bg-teal-500', 'bg-cyan-500', 'bg-sky-500', 'bg-blue-500', 'bg-indigo-500',
            'bg-violet-500', 'bg-purple-500', 'bg-fuchsia-500', 'bg-pink-500', 'bg-rose-500',
        ]"></div>
    </template>

    <Head title="Product Details" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap gap-x-8 gap-y-6 mb-8">
                <ProductImageGallery :images="images" class="basis-full md:basis-1/2 h-full"/>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 flex-1">
                    <div class="flex items-center mb-4">
                        <ProductInfo
                            :rating="product.rating"
                            :feedbackCount="product.review"
                            :title="product.name"
                            availability="In Stock"
                            :category="product.category.name"
                            :price="'Rp. ' + priceFormat(currentPrice(product))"
                            :oldPrice="'Rp.' + priceFormat(product.price)"
                            :discountTag="product.discount_percentage + '% OFF'"
                            />
                    </div>

                    <!-- <ProductVariants /> -->
                    <div class="flex flex-col gap-2 mb-4">
                        <Label for="size">Size</Label>
                        <SelectRoot id="size" v-model="cartForm.size" required>
                            <SelectTrigger
                                :class="[
                                    'block w-full h-10 file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                    'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                    'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                    'flex items-center justify-between cursor-pointer'
                                ]"
                                aria-label="Size options"
                            >
                                <SelectValue :class="{'text-muted-foreground': !cartForm.size}" placeholder="Select size" />
                                <Icon icon="radix-icons:chevron-down" class="h-full w-3.5 ml-2"/>
                            </SelectTrigger>

                            <SelectPortal>
                                <SelectContent
                                    class="min-w-[160px] bg-white rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
                                    :side-offset="5"
                                >
                                    <SelectViewport class="p-2">
                                        <SelectGroup>
                                            <SelectItem
                                                v-for="size in sizeAvailability"
                                                :key="size"
                                                class="text-sm leading-none rounded flex items-center h-7 relative select-none data-[disabled]:text-muted data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-primary data-[highlighted]:text-primary-foreground"
                                                :value="size"
                                            >
                                                <div class="relative flex flex-row items-center">
                                                    <SelectItemIndicator class="absolute pl-2 h-full inline-flex items-center justify-center">
                                                        <Icon icon="radix-icons:check" />
                                                    </SelectItemIndicator>
    
                                                    <SelectItemText class="pl-8">{{ size }}</SelectItemText>
                                                </div>
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectViewport>
                                </SelectContent>
                            </SelectPortal>
                        </SelectRoot>

                        <Label for="color" class="mt-2">Color</Label>
                        <SelectRoot id="color" v-model="cartForm.color" required>
                            <SelectTrigger
                                :class="[
                                    'block w-full h-10 file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                    'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                    'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                    'flex items-center justify-between cursor-pointer'
                                ]"
                                aria-label="Color options"
                            >
                                <SelectValue :class="{'text-muted-foreground': !cartForm.color}" placeholder="Select color" />
                                <Icon icon="radix-icons:chevron-down" class="h-full w-3.5 ml-2"/>
                            </SelectTrigger>

                            <SelectPortal>
                                <SelectContent
                                    class="min-w-[160px] bg-white rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
                                    :side-offset="5"
                                >
                                    <SelectViewport class="p-2">
                                        <SelectGroup>
                                            <SelectItem
                                                v-for="color in colorAvailability"
                                                :key="color"
                                                class="text-sm leading-none rounded flex items-center h-7 relative select-none data-[disabled]:text-muted data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-primary data-[highlighted]:text-primary-foreground"
                                                :value="color"
                                            >
                                                <div class="relative flex flex-row items-center">
                                                    <SelectItemIndicator class="absolute pl-2 h-full inline-flex items-center justify-center">
                                                        <Icon icon="radix-icons:check" />
                                                    </SelectItemIndicator>

                                                    <div class="rounded-full size-3.5 ml-8" :class="getColorCode(color)" />
    
                                                    <SelectItemText class="pl-2">{{ capitalize(color) }}</SelectItemText>
                                                </div>
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectViewport>
                                </SelectContent>
                            </SelectPortal>
                        </SelectRoot>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <div class="inline-flex items-center border border-gray-300 rounded px-3 py-2 dark:border-neutral-700">
                            <button
                                type="button"
                                aria-label="Decrease quantity"
                                @click="decrement"
                                :disabled="quantity <= 1"
                                class="w-6 h-6 flex items-center justify-center text-sm rounded hover:bg-gray-100 disabled:opacity-50 dark:text-white dark:hover:bg-neutral-800 w-1/3"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 12h14" />
                                </svg>
                            </button>

                            <input
                                type="number"
                                v-model="cartForm.quantity"
                                class="w-10 text-center bg-transparent border-0 text-gray-800 dark:text-white focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                min="1"
                            />

                            <button
                                type="button"
                                aria-label="Increase quantity"
                                @click="increment"
                                class="w-6 h-6 flex items-center justify-center text-sm rounded hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-800"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                            </button>
                        </div>

                        <OrangeButton 
                            class="flex-grow min-w-[180px] hover:shadow-md hover:-translate-y-0.5 transition duration-200 md:background-color hover:cursor-pointer w-1/3"
                            @click="addCart"
                        >
                            <template #icon>
                                <ShoppingCart class="w-5 h-5" />
                                <span v-if="cartForm.recentlySuccessful" class="ml-2 font-bold">Added</span>
                                <span v-else class="ml-2 font-bold">Add to Cart</span>
                            </template>
                        </OrangeButton>

                        <OrangeOutlineButton class="flex-grow min-w-[120px] hover:shadow-md hover:-translate-y-0.5 transition duration-200 hover:cursor-pointer w-1/3">
                            Buy Now
                        </OrangeOutlineButton>
                        
                        <WishListButton />
                    </div>

                    <PaymentAssurance/>
                </div>
            </div>
            
            <ProductDetailsTabs :tabs="['DESCRIPTION', 'REVIEW']">
                <template #default="{ activeTab }">
                    <div v-if="activeTab === 'DESCRIPTION'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    
                    <!-- Description -->
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ product.description }}
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