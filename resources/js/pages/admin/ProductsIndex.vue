<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Product, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import ProductManagementLayout from '@/layouts/products-management/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { ChevronLeftIcon, ChevronRightIcon } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
];

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

interface Links {
    url: string;
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
        path: 'http://localhost/products',
        from: 1,
        to: 1,
        links: [],
        data: [],
    })
});
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
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Price (IDR)</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Stock</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Detail</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="product in products.data" class="hover:bg-primary-foreground">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ product.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.category.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ priceFormat(product.price) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.stock }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link href="#" class="text-indigo-600 hover:text-indigo-400">Detail</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="absolute right-0 bottom-0 w-full flex items-center justify-between border-t border-gray-200 px-4 py-4 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">
                        <Link :href="products.prev_page_url ? products.prev_page_url : '#'" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</Link>
                        <Link :href="products.next_page_url ? products.next_page_url : '#'" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</Link>
                    </div>

                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
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
                        </div>

                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                                <Link :href="products.prev_page_url ? products.prev_page_url : ''" :preserve-scroll="true"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-primary ring-1 ring-gray-300 ring-inset hover:bg-gray-900 focus:z-20 focus:outline-offset-0"
                                    :class="{
                                        'pointer-events-none text-transparent': !products.prev_page_url,
                                        'cursor-pointer': products.prev_page_url
                                    }"
                                    :aria-disabled="!products.prev_page_url"
                                >
                                    <span class="sr-only">Previous</span>
                                    <ChevronLeftIcon class="size-5 text-primary-foreground" :aria-hidden="!products.prev_page_url" />
                                </Link>

                                <div v-for="index in Math.ceil(products.total/products.per_page)">
                                    <Link :href="products.links[index].url" aria-current="page" :preserve-scroll="true"
                                        :class="{
                                            'relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 pointer-events-none': index === products.current_page,
                                            'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-primary ring-1 ring-gray-300 ring-inset hover:bg-primary hover:text-primary-foreground focus:z-20 focus:outline-offset-0' : index !== products.current_page,
                                        }"
                                    >
                                        {{ index }}
                                    </Link>
                                </div>
                                
                                <Link :href="products.next_page_url ? products.next_page_url : ''" :preserve-scroll="true"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-primary ring-1 ring-gray-300 ring-inset hover:bg-gray-900 focus:z-20 focus:outline-offset-0"
                                    :class="{
                                        'pointer-events-none text-transparent': !products.next_page_url,
                                        'cursor-pointer': products.next_page_url
                                    }"
                                    :aria-disabled="!products.next_page_url"
                                >
                                    <span class="sr-only">Next</span>
                                    <ChevronRightIcon class="size-5 text-primary-foreground" :aria-hidden="!products.next_page_url" />
                                </Link>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </ProductManagementLayout>
    </AppLayout>
</template>