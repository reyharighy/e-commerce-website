<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Product, ProductVariant } from '@/types';
import VariantLayout from '@/layouts/products-management/VariantLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { SquarePen, Trash, ChevronLeftIcon, ChevronRightIcon } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Icon } from '@iconify/vue';
import {
    DialogClose, DialogContent, DialogDescription, DialogOverlay, DialogPortal, DialogRoot, DialogTitle, DialogTrigger,
} from 'radix-vue';
import { capitalize } from 'vue';

interface Links {
    url: string;
    label: string | number;
}

interface Props {
    product: Product;
    productVariants?: {
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
        data: ProductVariant[];
    };
};

const props = withDefaults(defineProps<Props>(), {
    productVariants: () => ({
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

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: route('products.index'),
    },
    {
        title: props.product.name,
        href: route('products.variants.index', {product: props.product}),
    },
];

const priceFormat = (value: number): string => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

const currentPrice = (initialPrice: number, discountPercentage: number): number => {
    return initialPrice * (100 - discountPercentage)/100;
};

const deleteProduct = (product: Product) => {
    router.delete(route('products.destroy', {product: product}), {
        preserveScroll: true,
    });
};

const deleteVariant = (product: Product, variant: ProductVariant) => {
    router.delete(route('products.variants.destroy', {product: product, variant: variant}), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="product.name" />

        <VariantLayout class="w-full" :product="product">
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Product and list of variants" description="Browse and manage the product and its variants efficiently. Use the search and filter options to quickly find specific variants" />

                <div class="relative max-h-fit flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border space-y-6 p-5">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-foreground">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Initial Price (IDR)</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Current Price (IDR)</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Discount (%)</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Delete</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-primary-foreground">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ product.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.category?.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ priceFormat(product.price) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ priceFormat(currentPrice(product.price, product.discount_percentage)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ product.discount_percentage }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('products.edit', {product: product})">
                                        <Button variant="ghost" class="hover:cursor-pointer hover:bg-blue-100 bg-muted">
                                            <SquarePen class="w-3.5 h-3.5"/>
                                        </Button>
                                    </Link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <DialogRoot>
                                        <DialogTrigger>
                                            <Button variant="ghost" class="hover:cursor-pointer hover:bg-red-100 bg-muted">
                                                <Trash class="w-3.5 h-3.5" />
                                            </Button>
                                        </DialogTrigger>

                                        <DialogPortal>
                                            <DialogOverlay class="bg-gray-500/50 fixed inset-0 z-30" />
                                            <DialogContent
                                                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                                            >
                                                <DialogTitle class="text-primary m-0 text-lg font-semibold">
                                                    Delete product
                                                </DialogTitle>
                                                
                                                <DialogDescription class="text-primary mt-2.5 mb-5 text-sm flex flex-col gap-3">
                                                    <p>
                                                        Deleting a product will also remove any associated variants, effectively deleting them as well.
                                                    </p>
                                                    <p>
                                                        Are you sure want to delete this product?
                                                    </p>
                                                </DialogDescription>

                                                <div class="grid gap-2 w-full mb-7 font-semibold text-center py-1 px-3 rounded-lg border border-primary-foreground bg-primary-foreground">
                                                    &quot;{{ product.name }}&quot;
                                                </div>

                                                <div class="flex gap-2 w-full justify-end">
                                                    <DialogClose aria-label="No">
                                                        <Button class="cursor-pointer">No</Button>
                                                    </DialogClose>

                                                    <DialogClose aria-label="Yes">
                                                        <Button @click="deleteProduct(product)" variant="destructive" class="cursor-pointer">Delete</Button>
                                                    </DialogClose>
                                                </div>
                                                
                                                <DialogClose
                                                    class="text-primary hover:bg-gray-100 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none cursor-pointer"
                                                    aria-label="Close"
                                                >
                                                    <Icon icon="lucide:x" />
                                                </DialogClose>
                                            </DialogContent>
                                        </DialogPortal>
                                    </DialogRoot>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table v-if="productVariants.data" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-foreground">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">SKU</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Size</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Color</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Stock</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Delete</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="variant in productVariants.data" class="hover:bg-primary-foreground">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ variant.sku }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ variant.size }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ capitalize(variant.color) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ variant.stock }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('products.variants.edit', {product: product, variant: variant})">
                                        <Button variant="ghost" class="hover:cursor-pointer hover:bg-blue-100 bg-muted">
                                            <SquarePen class="w-3.5 h-3.5"/>
                                        </Button>
                                    </Link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <DialogRoot>
                                        <DialogTrigger>
                                            <Button variant="ghost" class="hover:cursor-pointer hover:bg-red-100 bg-muted">
                                                <Trash class="w-3.5 h-3.5" />
                                            </Button>
                                        </DialogTrigger>

                                        <DialogPortal>
                                            <DialogOverlay class="bg-gray-500/50 fixed inset-0 z-30" />
                                            <DialogContent
                                                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                                            >
                                                <DialogTitle class="text-primary m-0 text-lg font-semibold">
                                                    Delete variant
                                                </DialogTitle>
                                                
                                                <DialogDescription class="text-primary mt-2.5 mb-5 text-sm flex flex-col gap-3">
                                                    <p>
                                                        Are you sure want to delete this variant?
                                                    </p>
                                                </DialogDescription>

                                                <div class="grid gap-2 w-full mb-7 font-semibold text-center py-1 px-3 rounded-lg border border-primary-foreground bg-primary-foreground">
                                                    &quot;{{ variant.sku }}&quot;
                                                </div>

                                                <div class="flex gap-2 w-full justify-end">
                                                    <DialogClose aria-label="No">
                                                        <Button class="cursor-pointer">No</Button>
                                                    </DialogClose>

                                                    <DialogClose aria-label="Yes">
                                                        <Button @click="deleteVariant(product, variant)" variant="destructive" class="cursor-pointer">Delete</Button>
                                                    </DialogClose>
                                                </div>
                                                
                                                <DialogClose
                                                    class="text-primary hover:bg-gray-100 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none cursor-pointer"
                                                    aria-label="Close"
                                                >
                                                    <Icon icon="lucide:x" />
                                                </DialogClose>
                                            </DialogContent>
                                        </DialogPortal>
                                    </DialogRoot>
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
                            <span class="font-medium">{{ productVariants.from }}</span>
                            &VeryThinSpace;
                            to
                            &VeryThinSpace;
                            <span class="font-medium">{{ productVariants.to }}</span>
                            &VeryThinSpace;
                            of
                            &VeryThinSpace;
                            <span class="font-medium">{{ productVariants.total }}</span>
                            &VeryThinSpace;
                            results
                        </p>

                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                            <div v-for="link in productVariants.links">
                                <Link v-if="link.label !== '...'" :href="link.url ?? '#'" aria-current="page" :preserve-scroll="true"
                                    :class="{
                                        'relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 pointer-events-none': link.label == productVariants.current_page,
                                        'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-primary ring-1 ring-gray-300 ring-inset hover:bg-primary hover:text-primary-foreground focus:z-20 focus:outline-offset-0' : link.label != productVariants.current_page,
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
        </VariantLayout>
    </AppLayout>
</template>