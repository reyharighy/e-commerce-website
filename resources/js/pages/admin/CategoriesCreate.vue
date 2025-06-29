<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import ProductManagementLayout from '@/layouts/products-management/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
];

const form = useForm({
    name: undefined,
});

const submit = () => {
    form.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: () => {
            if (form.recentlySuccessful) {
                setTimeout(() => {
                    form.reset();
                    router.get(route('categories.index'));
                }, 1000);
            }
        },
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Product Management" />

        <ProductManagementLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Create new category" description="Fill out the form below to add a new category to your catalog" />

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" class="mt-1 block w-full" v-model="form.name" required placeholder="Category name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button class="cursor-pointer" :disabled="form.processing">Create</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Created.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </ProductManagementLayout>
    </AppLayout>
</template>
