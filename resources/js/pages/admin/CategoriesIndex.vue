<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Category, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import ProductManagementLayout from '@/layouts/products-management/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { ChevronLeftIcon, ChevronRightIcon, Trash, SquarePen } from 'lucide-vue-next';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Icon } from '@iconify/vue';
import {
    DialogClose, DialogContent, DialogDescription, DialogOverlay, DialogPortal, DialogRoot, DialogTitle, DialogTrigger,
} from 'radix-vue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Management',
        href: '/products',
    },
];

interface Links {
    url: string;
}

interface Props {
    categories?: {
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
        data: Category[];
    };
};

withDefaults(defineProps<Props>(), {
    categories: () => ({
        total: 0,
        per_page: 0,
        current_page: 1,
        last_page: 1,
        current_page_url: null,
        first_page_url: null,
        next_page_url: null,
        prev_page_url: null,
        path: 'http://localhost/categories',
        from: 1,
        to: 1,
        links: [],
        data: [],
    })
});

const prettyDate = (date: string) => {
    let dateObj = new Date(date);
    return new Intl.DateTimeFormat('en-US', { dateStyle: 'full', timeStyle: 'short' }).format(dateObj)
}

const updateDate = (createdDate: string, updatedDate: string): string | Date => {
    if (createdDate === updatedDate) return 'Never been updated.';
    
    return prettyDate(updatedDate);
}

const editCategoryForm = useForm({
    name: '',
});

const categoryChosen = ref<Category>();

const submit = () => {
    editCategoryForm.patch(route('categories.update', {category: categoryChosen.value}), {
        preserveScroll: true,
    });
};

watch(categoryChosen, (newValue) => {
    editCategoryForm.name = newValue?.name ?? '';
});

const setCategoryChosen = (category: Category) => {
    categoryChosen.value = category;
};

const initialState = () => {
    editCategoryForm.name = categoryChosen.value?.name ?? '';
    editCategoryForm.errors.name = undefined;
};

const deleteCategory = (category: Category) => {
    router.delete(route('categories.destroy', {category: category}), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Product Management" />

        <ProductManagementLayout class="w-full">
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="List of categories" description="Browse and manage your product category efficiently. Use the search and filter options to quickly find specific categories" />

                <div class="relative max-h-fit flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border space-y-6 p-5">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-foreground">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Created</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-bold text-primary uppercase tracking-wider">Last Updated</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Delete</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="category in categories.data" :key="category.id" class="hover:bg-primary-foreground">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ category.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ prettyDate(category.created_at) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ updateDate(category.created_at, category.updated_at) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <DialogRoot @update:open="initialState">
                                        <DialogTrigger
                                            :class="[
                                                'block w-fit h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                                'flex items-center justify-between cursor-pointer hover:bg-blue-100'
                                            ]"
                                            @click="setCategoryChosen(category)"
                                        >
                                            <SquarePen class="w-3.5 h-3.5" />
                                        </DialogTrigger>

                                        <DialogPortal>
                                            <DialogOverlay class="bg-gray-500/50 fixed inset-0 z-30" />
                                            <DialogContent
                                                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                                            >
                                                <DialogTitle class="text-primary m-0 text-lg font-semibold">
                                                    Edit category
                                                </DialogTitle>
                                                
                                                <DialogDescription class="text-primary mt-2.5 mb-5 text-sm">
                                                    Please make sure the new category names should be unique
                                                </DialogDescription>

                                                <form @submit.prevent="submit" class="flex flex-col items-end space-y-6">
                                                    <div class="grid gap-2 w-full">
                                                        <Input id="category" class="mt-1 block w-full" v-model="editCategoryForm.name" required placeholder="Category name" />
                                                        <InputError class="mt-2" :message="editCategoryForm.errors.name" />
                                                    </div>
            
                                                    <div class="flex items-center gap-4">
                                                        <Transition
                                                            enter-active-class="transition ease-in-out"
                                                            enter-from-class="opacity-0"
                                                            leave-active-class="transition ease-in-out"
                                                            leave-to-class="opacity-0"
                                                        >
                                                            <p v-show="editCategoryForm.recentlySuccessful" class="text-sm text-neutral-600">Edited.</p>
                                                        </Transition>

                                                        <Button class="cursor-pointer" :disabled="editCategoryForm.processing">Edit</Button>
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <DialogRoot @update:open="initialState">
                                        <DialogTrigger
                                            :class="[
                                                'block w-fit h-full file:text-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input min-w-0 rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
                                                'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
                                                'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
                                                'flex items-center justify-between cursor-pointer hover:bg-red-100'
                                            ]"
                                            @click="setCategoryChosen(category)"
                                        >
                                            <Trash class="w-3.5 h-3.5" />
                                        </DialogTrigger>

                                        <DialogPortal>
                                            <DialogOverlay class="bg-gray-500/50 fixed inset-0 z-30" />
                                            <DialogContent
                                                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none z-[100]"
                                            >
                                                <DialogTitle class="text-primary m-0 text-lg font-semibold">
                                                    Delete category
                                                </DialogTitle>
                                                
                                                <DialogDescription class="text-primary mt-2.5 mb-5 text-sm flex flex-col gap-3">
                                                    <p>
                                                        Deleting a category will also remove any associated products, effectively deleting them as well.
                                                    </p>
                                                    <p>
                                                        Are you sure want to delete this category?
                                                    </p>
                                                </DialogDescription>

                                                <div class="grid gap-2 w-full mb-7 font-semibold text-center py-1 px-3 rounded-lg border border-primary-foreground bg-primary-foreground">
                                                    &quot;{{ category.name }}&quot;
                                                </div>

                                                <div class="flex gap-2 w-full justify-end">
                                                    <DialogClose aria-label="No">
                                                        <Button class="cursor-pointer">No</Button>
                                                    </DialogClose>

                                                    <DialogClose aria-label="Yes">
                                                        <Button @click="deleteCategory(category)" variant="destructive" class="cursor-pointer">Delete</Button>
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
                    <div class="flex flex-1 justify-between sm:hidden">
                        <Link :href="categories.prev_page_url ? categories.prev_page_url : '#'" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</Link>
                        <Link :href="categories.next_page_url ? categories.next_page_url : '#'" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</Link>
                    </div>

                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-primary">
                                Showing 
                                &VeryThinSpace;
                                <span class="font-medium">{{ categories.from }}</span>
                                &VeryThinSpace;
                                to
                                &VeryThinSpace;
                                <span class="font-medium">{{ categories.to }}</span>
                                &VeryThinSpace;
                                of
                                &VeryThinSpace;
                                <span class="font-medium">{{ categories.total }}</span>
                                &VeryThinSpace;
                                results
                            </p>
                        </div>

                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs" aria-label="Pagination">
                                <Link :href="categories.prev_page_url ? categories.prev_page_url : ''" :preserve-scroll="true"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-primary ring-1 ring-gray-300 ring-inset hover:bg-gray-900 focus:z-20 focus:outline-offset-0"
                                    :class="{
                                        'pointer-events-none text-transparent': !categories.prev_page_url,
                                        'cursor-pointer': categories.prev_page_url
                                    }"
                                    :aria-disabled="!categories.prev_page_url"
                                >
                                    <span class="sr-only">Previous</span>
                                    <ChevronLeftIcon class="size-5 text-primary-foreground" :aria-hidden="!categories.prev_page_url" />
                                </Link>

                                <div v-for="index in Math.ceil(categories.total/categories.per_page)">
                                    <Link :href="categories.links[index].url" aria-current="page" :preserve-scroll="true"
                                        :class="{
                                            'relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 pointer-events-none': index === categories.current_page,
                                            'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-primary ring-1 ring-gray-300 ring-inset hover:bg-primary hover:text-primary-foreground focus:z-20 focus:outline-offset-0' : index !== categories.current_page,
                                        }"
                                    >
                                        {{ index }}
                                    </Link>
                                </div>
                                
                                <Link :href="categories.next_page_url ? categories.next_page_url : ''" :preserve-scroll="true"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-primary ring-1 ring-gray-300 ring-inset hover:bg-gray-900 focus:z-20 focus:outline-offset-0"
                                    :class="{
                                        'pointer-events-none text-transparent': !categories.next_page_url,
                                        'cursor-pointer': categories.next_page_url
                                    }"
                                    :aria-disabled="!categories.next_page_url"
                                >
                                    <span class="sr-only">Next</span>
                                    <ChevronRightIcon class="size-5 text-primary-foreground" :aria-hidden="!categories.next_page_url" />
                                </Link>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </ProductManagementLayout>
    </AppLayout>
</template>