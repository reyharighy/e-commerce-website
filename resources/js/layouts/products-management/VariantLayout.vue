<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { NavItem, Product } from '@/types';
import { usePage, Link } from '@inertiajs/vue3';
import { HTMLAttributes } from 'vue';
import Separator from '@/components/ui/separator/Separator.vue';

interface Props {
    class?: HTMLAttributes['class'];
    product: Product;
};

const props = withDefaults(defineProps<Props>(), {
    class: 'md:max-w-2xl'
});

const productNavItems: NavItem[] = [
    {
        title: 'Variant',
        href: route('products.variants.index', {product: props.product}),
    },
    {
        title: 'New variant',
        href: route('products.variants.create', {product: props.product}),
    },
];

const page = usePage();

const currentPath = page.props.ziggy?.location;
</script>

<template>
    <div class="px-4 py-6">
        <Heading title="Variant Management" description="Manage the product and its variants in one place" />

        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <aside class="w-full max-w-xl h-fit lg:w-48">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button
                        v-for="item in productNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href || (currentPath.endsWith('/edit') && item.href.endsWith('/variants')) }]"
                        as-child
                    >
                        <Link :href="item.href">
                            {{ item.title }} 
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 md:hidden" />

            <div class="flex-1" :class="props.class">
                <section class="max-w-full space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>