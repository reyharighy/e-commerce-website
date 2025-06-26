<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ProductCategoryList from '@/components/product/ProductCategoryList.vue';
import FeaturedProducts from '@/components/product/FeaturedProducts.vue';
import Features from '@/components/product/Features.vue';
import ProductBanner from '@/components/product/ProductBanner.vue';
import ProductCategory from '@/components/product/ProductCategory.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Catalog',
        href: '/catalog',
    },
];

</script>

<template>
    <Head title="Catalog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        
        <ProductBanner />

        <Features />
        
        <ProductCategory />
        
        <FeaturedProducts />

        <ProductCategoryList />
      
    </AppLayout>
</template>
