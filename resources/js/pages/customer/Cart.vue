<script setup lang="ts">
    import { ref} from 'vue'
    import AppLayout from '@/layouts/AppLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import { type BreadcrumbItem } from '@/types'
    import CartLayout from '@/components/product/CartLayout.vue'

    const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cart',
        href: '/cart',
    },
    ]

    const products = ref([
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc:
        'https://tailwindcss.com/plus-assets/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt:
        'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc:
        'https://tailwindcss.com/plus-assets/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
        'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
    ])

    const removeFromCart = (product: any) => {
    products.value = products.value.filter((p) => p.id !== product.id)
    }
</script>

<template>
    <Head title="Cart" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <CartLayout :products="products" @remove="removeFromCart" />
    </AppLayout>
</template>


