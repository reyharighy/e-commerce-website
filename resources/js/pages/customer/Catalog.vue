<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Features from '@/components/product/Features.vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import CategoryCard from '@/components/product/CategoryCard.vue';
import ProductCard from '@/components/product/ProductCard.vue';
import ProductCategoryCard from '@/components/product/ProductCategoryCard.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Catalog',
        href: '/catalog',
    },
];

const categories = [
    { name: 'Computer & Laptop', image: 'https://picsum.photos/seed/laptop/200' },
    { name: 'SmartPhone', image: 'https://picsum.photos/seed/phone/200' },
    { name: 'Headphones', image: 'https://picsum.photos/seed/headphones/200' },
    { name: 'Accessories', image: 'https://picsum.photos/seed/accessories/200' },
    { name: 'Camera & Photo', image: 'https://picsum.photos/seed/camera/200' },
    { name: 'TV & Homes', image: 'https://picsum.photos/seed/tv/200' },
]

const products = [
    {
        id: 1,
        title: "TOZO T6 True Wireless Earbuds Bluetooth Headphon...",
        price: 70,
        rating: 4.5,
        reviews: 738,
        image: "https://picsum.photos/200/300",
        tag: "HOT"
    },
    {
        id: 2,
        title: "Samsung Electronics Samsung Galaxy S21 5G",
        price: 2300,
        rating: 4.5,
        reviews: 536,
        image: "https://picsum.photos/200/300",
    },
    {
        id: 3,
        title: "Amazon Basics HDMI Cable (18 Gbps, 4K/60Hz)",
        price: 360,
        rating: 4.5,
        reviews: 423,
        image: "https://picsum.photos/200/300",
        tag: "BEST DEALS"
    },
    {
        id: 4,
        title: "Portable Washing Machine, 11lbs Model 18NMF...",
        price: 80,
        rating: 4.0,
        reviews: 816,
        image: "https://picsum.photos/200/300",
    },
    {
        id: 5,
        title: "Wired Over-Ear Gaming Headphones with USB",
        price: 1500,
        rating: 4.5,
        reviews: 647
    },
    {
        id: 6,
        title: "Polaroid 57-Inch TV + Deluxe Tripod",
        price: 1200,
        originalPrice: 1600,
        rating: 4.0,
        reviews: 877,
        tag: "25% OFF"
    },
    {
        id: 7,
        title: "Dell Optiplex 7000x7480 All-in-One Computer Monitor",
        price: 250,
        rating: 4.5,
        reviews: 426
    },
    {
        id: 8,
        title: "4K UHD Smart TV with Chromecast Built-in",
        price: 220,
        rating: 4.5,
        reviews: 583,
        tag: "SALE"
    },
]

const filters = ["All Product", "Smart Phone", "Laptop", "Headphone", "TV"];

const tagcategories = [
    {
        title: 'Flash Sale Today',
        products: [ 
            {
                id: 1,
                name: 'Bose Sport Earbuds - Wireless',
                price: '$1,500',
                image: 'https://picsum.photos/seed/tv/600',
            },
            {
                id: 2,
                name: 'Simple Mobile 4G LTE Prepaid Smartphone',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Phone',
            },
            {
                id: 3,
                name: '4K UHD LED Smart TV with Chromecast Built-in',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=TV',
            },
        ],
    },
    {
        title: 'Best Sellers',
        products: [
            {
                id: 4,
                name: 'Samsung Galaxy S21 5G',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=S21',
            },
            {
                id: 5,
                name: 'Simple Mobile 5G Gaming Phone',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Phone',
            },
            {
                id: 6,
                name: 'Sony DSCHX8 Point & Shoot Camera',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Camera',
            },
        ],
    },
    {
        title: 'Top Rated',
        products: [
            {
                id: 7,
                name: 'Washing Machine Model 18NMF',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Washer',
            },
            {
                id: 8,
                name: 'Sony DSCHX8 Zoom Camera',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Zoom',
            },
            {
                id: 9,
                name: 'Dell Optiplex 7000 Monitor',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Dell',
            },
        ],
    },
    {
        title: 'New Arrival',
        products: [
            {
                id: 10,
                name: 'TOZO T6 Wireless Earbuds',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=TOZO',
            },
            {
                id: 11,
                name: 'JBL FLIP 4 Bluetooth Speaker',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=JBL',
            },
            {
                id: 12,
                name: 'Wyze Cam Pan 1080p',
                price: '$1,500',
                image: 'https://via.placeholder.com/60?text=Wyze',
            },
        ],
    },
]
</script>

<template>
    <Head title="Catalog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        
        
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl py-6 mx-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 auto-rows-min">
                <div class="h-full w-full md:col-span-2 aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="flex flex-col gap-4">
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern />
                    </div>
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern />
                    </div>
                </div>
            </div>
        </div>

        <Features />
        
        <div class="py-8 w-full mx-auto px-4 sm:px-6 lg:px-8 xl:px-24">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Shop with Categories</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
            <CategoryCard
                v-for="(cat, index) in categories"
                :key="index"
                :image="cat.image"
                :name="cat.name"/>
            </div>
        </div>
        
        <div class="w-full px-4 sm:px-8 lg:px-24 mx-auto">
            <div class="mb-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 sm:gap-0">
            <div class="font-bold text-2xl">Featured Products</div>

            <div class="flex items-center gap-4">
                <div class="space-x-2 text-sm md:text-base">
                <button
                    v-for="filter in filters"
                    :key="filter"
                    :class="filter === 'All Product' ? 'font-semibold border-b-2 border-white' : 'hover:underline'">
                    {{ filter }}
                </button>
                </div>
                <a href="#" class="text-orange-500 hover:underline text-sm md:text-base whitespace-nowrap">
                Browse All Product →
                </a>
            </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <ProductCard
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 sm:px-8 md:px-16 lg:px-24 pb-20">
            <Card
            v-for="(category, index) in tagcategories"
            :key="index"
            class="space-y-4">
            <h3 class="font-semibold text-gray-800 uppercase text-sm">
                {{ category.title }}
            </h3>

            <ProductCategoryCard
                v-for="product in category.products"
                :key="product.id"
                :product="product"
            />
            </Card>
        </div>
    </AppLayout>
</template>