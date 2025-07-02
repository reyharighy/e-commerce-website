<script setup lang="ts">
    import FavoriteList from '@/components/product/FavoriteList.vue';
    import AppLayout from '@/layouts/AppLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import { type BreadcrumbItem } from '@/types'

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Wishlist',
            href: '/wishlist',
        },
    ];

    const favoriteItems = [
    {
        name: 'Hollow Port',
        description: 'Awesome yellow t-shirt',
        price: 39.11,
        inStock: true,
        image: 'https://images.unsplash.com/photo-1632200004922-bc18602c79fc?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    },
    {
        name: 'Circular Sienna',
        description: 'Awesome white t-shirt',
        price: 24.89,
        inStock: true,
        image: 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    },
    {
        name: 'Realm Bone',
        description: 'Awesome black t-shirt',
        price: 22.0,
        inStock: false,
        image: 'https://images.unsplash.com/photo-1653998582106-0509104928d9?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    }
    ]

    interface FavoriteItem {
        name: string;
        description: string;
        price: number;
        inStock: boolean;
        image: string;
    }

    function removeItem(product: FavoriteItem): void {
        const index = favoriteItems.indexOf(product)
        if (index !== -1) favoriteItems.splice(index, 1)
    }
</script>

<template>
    <Head title="Wishlist"/>
    <AppLayout :breadcrumbs="breadcrumbs">
    <FavoriteList :products="favoriteItems" @remove="removeItem" />
    </AppLayout>
</template>