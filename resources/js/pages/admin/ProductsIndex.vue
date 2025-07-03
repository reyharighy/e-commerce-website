<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Product, type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import ProductManagementLayout from '@/layouts/products-management/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { ChevronLeftIcon, ChevronRightIcon, ExternalLink } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: route('products.index'),
    },
];

interface Links {
    url: string;
    label: string | number;
}

interface Props {
    products: {
        total: number;
        per_page: number;
        current_page: number;
        last_page: number;
        current_page_url: string | null;
        next_page_url: string | null;
        prev_page_url: null | null;
        path: string;
        from: number;
        to: number;
        links: Links[];
        data: Product[];
    };
};

withDefaults(defineProps<Props>(), {
    products: () => ({
        total: 0,
        per_page: 0,
        current_page: 1,
        last_page: 1,
        current_page_url: null,
        first_page_url: null,
        next_page_url: null,
        prev_page_url: null,
        path: '',
        from: 1,
        to: 1,
        links: [],
        data: [],
    })
});

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

const currentPrice = (initialPrice: number, discountPercentage: number): number => {
    return initialPrice * (100 - discountPercentage)/100;
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Product Management" />

        <ProductManagementLayout class="w-full">
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="List of products" description="Browse and manage your product catalog efficiently. Use the search and filter options to quickly find specific products" />

                <div class="relative max-h-fit flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border space-y-6 p-5">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-foreground">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Initial Price (IDR)</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Current Price (IDR)</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Discount (%)</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Detail</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="product in products.data" class="hover:bg-primary-foreground">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ product.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.category?.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ priceFormat(product.price) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ priceFormat(currentPrice(product.price, product.discount_percentage)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.discount_percentage }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <Link :href="route('products.variants.index', {product: product})">
                                        <Button variant="ghost" class="hover:cursor-pointer hover:bg-green-100 bg-muted">
                                            <ExternalLink class="w-3.5 h-3.5"/>
                                        </Button>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="absolute right-0 bottom-0 w-full flex items-center justify-between border-t border-gray-200 px-4 py-4 sm:px-6">
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <p class="text-sm text-primary">
                            Showing
                            &VeryThinSpace;
                            <span class="font-medium">{{ products.from }}</span>
                            &VeryThinSpace;
                            to
                            &VeryThinSpace;
                            <span class="font-medium">{{ products.to }}</span>
                            &VeryThinSpace;
                            of
                            &VeryThinSpace;
                            <span class="font-medium">{{ products.total }}</span>
                            &VeryThinSpace;
                            results
                        </p>

                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                            <div v-for="link in products.links">
                                <Link v-if="link.label !== '...'" :href="link.url ?? '#'" aria-current="page" :preserve-scroll="true"
                                    :class="{
                                        'relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 pointer-events-none': link.label == products.current_page,
                                        'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-primary ring-1 ring-gray-300 ring-inset hover:bg-primary hover:text-primary-foreground focus:z-20 focus:outline-offset-0' : link.label != products.current_page,
                                        'hover:pointer-events-none cursor-none text-transparent' : !link.url
                                    }"
                                >
                                    <span v-if="link.label.toString().endsWith('Previous')" :class="{'hover:pointer-events-none cursor-none text-transparent' : !link.url}">
                                        <ChevronLeftIcon class="size-5" :class="{'hover:pointer-events-none cursor-none text-transparent' : !link.url}" />
                                    </span>
                                    <span v-else-if="link.label.toString().startsWith('Next')" :class="{'hover:pointer-events-none cursor-none text-transparent' : !link.url}">
                                        <ChevronRightIcon class="size-5" :class="{'hover:pointer-events-none cursor-none text-transparent' : !link.url}" />
                                    </span>
                                    <span v-else>
                                        {{ link.label }}
                                    </span>
                                </Link>

                                <div v-else class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-primary bg-primary-foreground focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 pointer-events-none ring-1 ring-gray-300 ring-inset focus:outline-offset-0">
                                    {{ link.label }}
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </ProductManagementLayout>
    </AppLayout>
</template>