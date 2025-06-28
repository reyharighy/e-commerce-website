<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Product, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
];

interface Props {
    products?: Product[];
}

withDefaults(defineProps<Props>(), {
    products: () => [],
});

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};
</script>

<template>
    <Head title="Product Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border p-5">
                <div class="w-full mb-5 flex justify-between">
                    <div class="w-1/2">
                        <h2 class="text-xl font-bold mb-2">Products</h2>
                        <p class="text-sm text-gray-500">List of all products.</p>
                    </div>

                    <div class="flex flex-col justify-end">
                        <Link href="#">
                            <Button class="text-sm font-semibold bg-indigo-500">New Product</Button>
                        </Link>
                    </div>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Price (IDR)</th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-gray-900 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="product in products" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ product.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ product.category.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ priceFormat(product.price) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ product.stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link href="#" class="text-indigo-600 hover:text-indigo-900">Detail</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
