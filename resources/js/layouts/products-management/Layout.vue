<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { HTMLAttributes } from 'vue';

interface Props {
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    class: 'md:max-w-2xl'
});

const productNavItems: NavItem[] = [
    {
        title: 'Product',
        href: '/products',
    },
    {
        title: 'New product',
        href: '/products/create',
    },
];

const categoryNavItems: NavItem[] = [
    {
        title: 'Category',
        href: '/categories',
    },
    {
        title: 'New category',
        href: '/categories/create',
    },
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="px-4 py-6">
        <Heading title="Product Management" description="Manage all of your products in one place" />

        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <aside class="w-full max-w-xl h-fit lg:w-48">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button
                        v-for="item in productNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]"
                        as-child
                    >
                        <Link :href="item.href">
                            {{ item.title }}
                        </Link>
                    </Button>
                    
                    <Separator class="my-2" />

                    <Button
                        v-for="item in categoryNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]"
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
