<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Category, type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import ProductManagementLayout from '@/layouts/products-management/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Icon } from '@iconify/vue'
import { Plus } from 'lucide-vue-next';
import { 
    SelectContent, SelectGroup, SelectItem, SelectItemIndicator, SelectItemText, SelectPortal, SelectRoot, SelectTrigger, SelectValue, SelectViewport,
    DialogClose, DialogContent, DialogDescription, DialogOverlay, DialogPortal, DialogRoot, DialogTitle, DialogTrigger,
} from 'radix-vue'

interface Props {
    categories?: Category[];
};

withDefaults(defineProps<Props>(), {
    categories: () => [],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
];

const productForm = useForm({
    name: undefined,
    description: undefined,
    category_id: undefined,
    price: undefined,
    stock: undefined,
});

const submitProductForm = () => {
    productForm.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => {
            if (productForm.recentlySuccessful) {
                setTimeout(() => {
                    productForm.reset();
                    router.get(route('products.index'));
                }, 1000);
            }
        }
    });
};

const categoryForm = useForm({
    name: undefined,
});

const submitCategoryForm = () => {
    categoryForm.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: () => categoryForm.reset(),
    });
};

const initialState = () => {
    categoryForm.reset();
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Product Management" />

        <ProductManagementLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Create new product" description="Fill out the form below to add a new product to your catalog. Make sure to provide accurate details to help customers find and purchase your product" />

                <form @submit.prevent="submitProductForm" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" class="mt-1 block w-full" v-model="productForm.name" required placeholder="Product name" />
                        <InputError class="mt-2" :message="productForm.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="description">Description</Label>
                        <textarea id="description" v-model="productForm.description" placeholder="Product description"
                            rows="5"
                            :class="[
                                'mt-1 block w-full file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                            ]">
                        </textarea>
                        <InputError class="mt-2" :message="productForm.errors.description" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="category">Category</Label>
                        <div class="flex mt-1 w-full h-full gap-2.5 justify-between items-center">
                            <SelectRoot id="category" v-model="productForm.category_id" required>
                                <SelectTrigger
                                    :class="[
                                        'block w-full h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                        'flex items-center justify-between cursor-pointer'
                                    ]"
                                    aria-label="Category options"
                                >
                                    <SelectValue :class="{'text-muted-foreground': !productForm.category_id}" placeholder="Select category" />
                                    <Icon icon="radix-icons:chevron-down" class="h-full w-3.5 ml-2"/>
                                </SelectTrigger>
    
                                <SelectPortal>
                                    <SelectContent
                                        class="min-w-[160px] bg-white rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade z-[100]"
                                        :side-offset="5"
                                    >
                                        <SelectViewport class="p-2">
                                            <SelectGroup>
                                                <SelectItem
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    class="text-sm leading-none rounded flex items-center h-7 relative select-none data-[disabled]:text-muted data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-primary data-[highlighted]:text-primary-foreground"
                                                    :value="category.id"
                                                >
                                                    <div class="relative flex flex-row items-center">
                                                        <SelectItemIndicator class="absolute pl-2 h-full inline-flex items-center justify-center">
                                                            <Icon icon="radix-icons:check" />
                                                        </SelectItemIndicator>
        
                                                        <SelectItemText class="pl-8">{{ category.name }}</SelectItemText>
                                                    </div>
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectViewport>
                                    </SelectContent>
                                </SelectPortal>
                            </SelectRoot>

                            <DialogRoot @update:open="initialState">
                                <DialogTrigger
                                    :class="[
                                        'block w-fit h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                        'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                        'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                        'flex items-center justify-between cursor-pointer'
                                    ]"
                                >
                                    <Plus class="h-3.5 w-3.5" />
                                </DialogTrigger>

                                <DialogPortal>
                                    <DialogOverlay class="bg-gray-500/50 fixed inset-0 z-30" />
                                    <DialogContent
                                        class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                                    >
                                        <DialogTitle class="text-primary m-0 text-lg font-semibold">
                                            Create new category
                                        </DialogTitle>
                                        
                                        <DialogDescription class="text-primary mt-2.5 mb-5 text-sm">
                                            Please make sure the new category names should be unique
                                        </DialogDescription>

                                        <form @submit.prevent="submitCategoryForm" class="flex flex-col items-end space-y-6">
                                            <div class="grid gap-2 w-full">
                                                <Input id="category" class="mt-1 block w-full" v-model="categoryForm.name" required placeholder="Category name" />
                                                <InputError class="mt-2" :message="categoryForm.errors.name" />
                                            </div>
    
                                            <div class="flex items-center gap-4">
                                                <Transition
                                                    enter-active-class="transition ease-in-out"
                                                    enter-from-class="opacity-0"
                                                    leave-active-class="transition ease-in-out"
                                                    leave-to-class="opacity-0"
                                                >
                                                    <p v-show="categoryForm.recentlySuccessful" class="text-sm text-neutral-600">Created.</p>
                                                </Transition>

                                                <Button class="cursor-pointer" :disabled="categoryForm.processing">Create</Button>
                                            </div>
                                        </form>
                                        
                                        <DialogClose
                                            class="text-primary hover:bg-gray-100 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none cursor-pointer"
                                            aria-label="Close"
                                        >
                                            <Icon icon="lucide:x" />
                                        </DialogClose>
                                    </DialogContent>
                                </DialogPortal>
                            </DialogRoot>
                        </div>
                        <InputError class="mt-2" :message="productForm.errors.category_id" />
                    </div>

                    <div class="grid gap-2">
                        <Label class="mb-1" for="price">Price</Label>
                        <div class="relative flex flex-col justify-center">
                            <span class="text-sm absolute pl-3">Rp.</span>
                            <Input id="price" class="block w-full pl-9" v-model="productForm.price" required placeholder="100000" />
                        </div>
                        <InputError class="mt-2" :message="productForm.errors.price" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="stock">Stock</Label>
                        <Input id="stock" class="mt-1 block w-full" v-model="productForm.stock" required placeholder="Stock Available" />
                        <InputError class="mt-2" :message="productForm.errors.stock" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button class="cursor-pointer" :disabled="productForm.processing">Create</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="productForm.recentlySuccessful" class="text-sm text-neutral-600">Created.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </ProductManagementLayout>
    </AppLayout>
</template>
