<script setup lang="ts">
import { ref, computed } from 'vue'
import ProductCard from '@/components/product/ProductCard.vue'
import { products } from '@/dummydata/products.js'
import SearchBar from '@/layouts/product-filter-search/SearchBar.vue'
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'SearchResults',
        href: '/search-results',
    },
];

const searchKeyword = ref('')

const filteredProducts = computed(() => {
  return products.filter(p =>
    p.title.toLowerCase().includes(searchKeyword.value.toLowerCase())
  )
})

function onSearch(keyword: string) {
  searchKeyword.value = keyword
}

</script>

<template>
    <Head title="SearchResults"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-white">
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
            <SearchBar @search="onSearch" />

            <div v-if="searchKeyword" class="mt-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                <p class="text-gray-500">
                {{ filteredProducts.length }} results found for "{{ searchKeyword }}"
                </p>
            </div>

            <section v-if="filteredProducts.length > 0" class="pb-24">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <ProductCard
                    v-for="product in filteredProducts"
                    :key="product.id"
                    :product="product"
                />
                </div>
            </section>

            <p v-else class="text-center text-gray-400 mt-12">No products found.</p>
            </main>
        </div>
    </AppLayout>
</template>
