<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Product, type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import CategoryCard from '@/components/product/CategoryCard.vue';
import ProductCard from '@/components/product/ProductCard.vue';
import ProductCategoryCard from '@/components/product/ProductCategoryCard.vue';
import Card from '@/components/ui/card/Card.vue';
import ServiceFeature from '@/components/product/ServiceFeature.vue';
import SearchBar from '@/layouts/product-filter-search/SearchBar.vue';
import { computed, ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Catalog',
        href: '/catalog',
    },
];

interface Props {
    products: Product[];
}

const props = defineProps<Props>();

const images = [
    route('storage.local', {path: 'Featured/1.jpg'}),
    route('storage.local', {path: 'Featured/2.jpeg'}),
    route('storage.local', {path: 'Featured/3.jpg'}),
];

const categories = [
    { name: 'Hat', image: route('storage.local', {path: 'Featured/Hat.jpeg'}) },
    { name: 'Hoodie', image: route('storage.local', {path: 'Featured/Hoodie.jpg'}) },
    { name: 'Outer', image:  route('storage.local', {path: 'Featured/Outer.jpeg'}) },
    { name: 'Pants', image: route('storage.local', {path: 'Featured/Pants.jpg'}) },
    { name: 'Shirt', image: route('storage.local', {path: 'Featured/Shirt.jpeg'}) },
    { name: 'Sweater', image: route('storage.local', {path: 'Featured/Sweater.jpeg'}) },
    { name: 'T-shirt', image: route('storage.local', {path: 'Featured/T-Shirt.jpeg'}) },
];

const featuringProducts = ['Flash Sale Today', 'Best Sellers', 'Top Rated', 'New Arrival'];

const searchKeyWords = ref<string>('');

const handleSearch = (keyword: string) => {
    searchKeyWords.value = keyword;
};

const filteredProducts = computed(() => {
    if (!searchKeyWords.value?.trim()) {
        return props.products;
    }

    const keyWords = searchKeyWords.value.toLowerCase();

    return props.products.filter(product => {
        if (product.name.toLowerCase().includes(keyWords)) return true;

        if (product.category.name.toLowerCase().includes(keyWords)) return true;

        return false;
    });
});

const getThreeRandomProducts = (products: Product[]) => {
    const shuffled = [...products].sort(() => 0.5 - Math.random());
    return shuffled.slice(0, 3);
};

const featuredProductsData = computed(() => {
    return featuringProducts.map(title => ({
        title,
        products: getThreeRandomProducts(props.products)
    }));
});
</script>

<template>
    <Head title="Catalog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 grid-rows-3 gap-4 auto-rows-min">
                <div class="h-full w-full md:col-span-2 md:row-span-3 aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                    <img :src="images[0]" class="object-cover h-full w-full">
                </div>
                <div class="flex flex-col gap-4 md:row-span-3">
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <img :src="images[1]" class="object-cover h-full w-full">
                    </div>
                    <div class="aspect-video relative overflow-hidden rounded-sm border border-sidebar-border/70 dark:border-sidebar-border">
                        <img :src="images[2]" class="object-cover h-full w-full">
                    </div>
                </div>
            </div>
        </div>

        <ServiceFeature />
        
        <section
            class="py-10 w-full max-w-screen-xl mx-auto"
            aria-labelledby="shop-categories"
        >
            <h2
                id="shop-categories"
                class="text-3xl font-semibold text-primary mb-8 text-center"
            >
                Shop with Categories
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-5">
                <CategoryCard
                    v-for="(category, index) in categories"
                    :key="index"
                    :image="category.image"
                    :name="category.name"
                />
            </div>
        </section>

        <section class="w-full pb-20 flex flex-col gap-7 mt-7 items-center">
            <h2 class="font-bold text-3xl text-primary">Featured Products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 w-full">
                <Card
                    v-for="(feature, index) in featuredProductsData"
                    :key="index"
                    class="space-y-4 p-4 rounded-md border bg-primary-foreground shadow-sm"
                >
                    <!-- Feature Title -->
                    <h3 class="text-sm font-semibold text-primary uppercase tracking-wide mb-2">
                        {{ feature.title }}
                    </h3>

                    <!-- Top-3 Products -->
                    <div class="space-y-3">
                        <ProductCategoryCard
                            v-for="product in feature.products"
                            :key="product.id"
                            :product="product"
                            class="hover:cursor-pointer"
                        />
                    </div>
                </Card>
            </div>
        </section>
        
        <section class="w-full">
            <div class="flex items-center justify-between mb-7 w-full h-full">
                <SearchBar @update:search="handleSearch" />

                <Link
                    href="#"
                    class="text-[#fa8232] hover:underline hover:cursor-pointer text-sm h-fit"
                >
                    Browse All Product →
                </Link>
            </div>

             <div v-if="searchKeyWords" class="mb-4 text-sm text-gray-600">
                Found {{ filteredProducts.length }} product{{ filteredProducts.length !== 1 ? 's' : '' }}
                <span v-if="searchKeyWords"> for "{{ searchKeyWords }}"</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <ProductCard
                    v-for="product in filteredProducts"
                    :key="product.id"
                    :product="product"
                    class="hover:cursor-pointer"
                />
            </div>

            <div v-if="searchKeyWords && filteredProducts.length === 0" class="text-center py-12">
                <p class="text-gray-500">No products found for "{{ searchKeyWords }}"</p>
            </div>
        </section>
    </AppLayout>
</template>