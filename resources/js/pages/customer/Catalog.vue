<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import CategoryCard from '@/components/product/CategoryCard.vue';
import ProductCard from '@/components/product/ProductCard.vue';
import ProductCategoryCard from '@/components/product/ProductCategoryCard.vue';
import ServiceFeature from '@/components/product/ServiceFeature.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Catalog',
        href: '/catalog',
    },
];

const images = [
    "https://images.unsplash.com/photo-1505751171710-1f6d0ace5a85?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1484704849700-f032a568e944?ixlib=rb-4.0.3&q=80&w=1080",
    "https://images.unsplash.com/photo-1496957961599-e35b69ef5d7c?ixlib=rb-4.0.3&q=80&w=1080"
]

const categories = [
    { name: 'Computer & Laptop', image: 'https://images.unsplash.com/photo-1484788984921-03950022c9ef?q=80&w=932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'SmartPhone', image: 'https://images.unsplash.com/photo-1603184017968-953f59cd2e37?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'Headphones', image: 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?q=80&w=688&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'Accessories', image: 'https://images.unsplash.com/photo-1535157412991-2ef801c1748b?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'Camera & Photo', image: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
    { name: 'TV & Homes', image: 'https://images.unsplash.com/photo-1567690187548-f07b1d7bf5a9?q=80&w=736&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
]

const products = [
    {
        id: 1,
        title: "TOZO T6 True Wireless Earbuds Bluetooth Headphon...",
        price: 70,
        rating: 4.5,
        reviews: 738,
        image: "https://images.unsplash.com/photo-1632200004922-bc18602c79fc?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        tag: "HOT"
    },
    {
        id: 2,
        title: "Samsung Electronics Samsung Galaxy S21 5G",
        price: 2300,
        rating: 4.5,
        reviews: 536,
        image: "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    },
    {
        id: 3,
        title: "Amazon Basics HDMI Cable (18 Gbps, 4K/60Hz)",
        price: 360,
        rating: 4.5,
        reviews: 423,
        image: "https://images.unsplash.com/photo-1653998582106-0509104928d9?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        tag: "BEST DEALS"
    },
    {
        id: 4,
        title: "Portable Washing Machine, 11lbs Model 18NMF...",
        price: 80,
        rating: 4.0,
        reviews: 816,
        image: "https://images.unsplash.com/photo-1626806819282-2c1dc01a5e0c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    },
    {
        id: 5,
        title: "Wired Over-Ear Gaming Headphones with USB",
        price: 1500,
        rating: 4.5,
        reviews: 647,
        image: "https://images.unsplash.com/photo-1619296794093-3df1ae6819a8?q=80&w=1025&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
    },
    {
        id: 6,
        title: "Polaroid 57-Inch TV + Deluxe Tripod",
        price: 1200,
        originalPrice: 1600,
        rating: 4.0,
        reviews: 877,
        image: "https://images.unsplash.com/photo-1615986200762-a1ed9610d3b1?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        tag: "25% OFF"
    },
    {
        id: 7,
        title: "Dell Optiplex 7000x7480 All-in-One Computer Monitor",
        price: 250,
        rating: 4.5,
        reviews: 426,
        image: "https://images.unsplash.com/photo-1614624532983-4ce03382d63d?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    },
    {
        id: 8,
        title: "4K UHD Smart TV with Chromecast Built-in",
        price: 220,
        rating: 4.5,
        reviews: 583,
        image: "https://images.unsplash.com/photo-1461151304267-38535e780c79?q=80&w=1633&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
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
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1645020089405-ee44c2cd7c58?q=80&w=711&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 2,
                name: 'Simple Mobile 4G LTE Prepaid Smartphone',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 3,
                name: '4K UHD LED Smart TV with Chromecast Built-in',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1701421048182-2a628d927578?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
        ],
    },
    {
        title: 'Best Sellers',
        products: [
            {
                id: 4,
                name: 'Samsung Galaxy S21 5G',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 5,
                name: 'Simple Mobile 5G Gaming Phone',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1724144542854-2091d821fd6f?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 6,
                name: 'Sony DSCHX8 Point & Shoot Camera',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
        ],
    },
    {
        title: 'Top Rated',
        products: [
            {
                id: 7,
                name: 'Washing Machine Model 18NMF',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 8,
                name: 'Sony DSCHX8 Zoom Camera',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1616088886430-ccd86fef0713?q=80&w=749&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 9,
                name: 'Dell Optiplex 7000 Monitor',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1614624532983-4ce03382d63d?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
        ],
    },
    {
        title: 'New Arrival',
        products: [
            {
                id: 10,
                name: 'TOZO T6 Wireless Earbuds',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1632200004922-bc18602c79fc?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 11,
                name: 'JBL FLIP 4 Bluetooth Speaker',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1549638767-0ccf6cb1281b?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            },
            {
                id: 12,
                name: 'Wyze Cam Pan 1080p',
                price: '1,500',
                image: 'https://images.unsplash.com/photo-1726127461372-547b9ffa4236?q=80&w=972&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
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
                    <img :src="images[0]">
                    <PlaceholderPattern />
                </div>
                <div class="flex flex-col gap-4">
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <img :src="images[1]">
                        <PlaceholderPattern />
                    </div>
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <img :src="images[2]">
                        <PlaceholderPattern />
                    </div>
                </div>
            </div>
        </div>

        <ServiceFeature />
        
        <section
            class="py-10 w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8"
            aria-labelledby="shop-categories"
        >
            <h2
            id="shop-categories"
            class="text-3xl font-bold text-gray-800 mb-8 text-center"
            >
            Shop with Categories
            </h2>

            <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5"
            >
            <CategoryCard
                v-for="(cat, index) in categories"
                :key="index"
                :image="cat.image"
                :name="cat.name"
            />
            </div>
        </section>
        
        <section class="w-full px-4 sm:px-8 lg:px-24 mx-auto">
            <!-- Heading & Filter -->
            <div
            class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
            >
            <h2 class="font-bold text-2xl text-gray-800">Featured Products</h2>

            <div class="flex items-center gap-4">
                <div class="space-x-2 text-sm md:text-base">
                <button
                    v-for="filter in filters"
                    :key="filter"
                    :class="[
                    'px-1 transition',
                    filter === 'All Product'
                        ? 'font-semibold border-b-2 border-orange-500 text-orange-600'
                        : 'hover:underline text-gray-600',
                    ]"
                >
                    {{ filter }}
                </button>
                </div>

                <a
                href="#"
                class="text-orange-500 hover:underline text-sm md:text-base whitespace-nowrap"
                >
                Browse All Product →
                </a>
            </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <ProductCard
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
            </div>
        </section>

        <section class="w-full px-4 sm:px-8 md:px-16 lg:px-24 pb-20">
            <div
            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6"
            >
            <Card
                v-for="(category, index) in tagcategories"
                :key="index"
                class="space-y-4 p-4 rounded-md border bg-white shadow-sm"
            >
                <!-- Category Title -->
                <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wide mb-2">
                {{ category.title }}
                </h3>

                <!-- Product List -->
                <div class="space-y-3">
                <ProductCategoryCard
                    v-for="product in category.products"
                    :key="product.id"
                    :product="product"
                />
                </div>
            </Card>
            </div>
        </section>
    </AppLayout>
</template>