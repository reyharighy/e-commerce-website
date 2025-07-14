<script setup lang="ts">
import { ref, computed } from 'vue'
import ProductCard from '@/components/product/ProductCard.vue'
import MobileFilterDialog from '@/layouts/product-filter-search/MobileFilterDialog.vue'
import ProductListHeader from '@/layouts/product-filter-search/ProductListHeader.vue'
import DesktopFilterSidebar from '@/layouts/product-filter-search/DesktopFilterSidebar.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { Product, type BreadcrumbItem } from '@/types'

interface Props {
    products: Product[];
}

const props = defineProps<Props>();

// --- BREADCRUMBS ---
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Search Results',
        href: '/search-results',
    },
];

// --- STATE MANAGEMENT ---
const mobileFiltersOpen = ref(false)
// In a real app, the search query would come from the URL or page props
const searchQuery = ref('Smart') // Example search query

// --- FILTER & SORT DATA (same as ProductFilter.vue) ---
const sortOptions = [
    { name: 'Most Popular', href: '#', current: true },
    { name: 'Best Rating', href: '#', current: false },
    { name: 'Newest', href: '#', current: false },
    { name: 'Price: Low to High', href: '#', current: false },
    { name: 'Price: High to Low', href: '#', current: false },
]
const subCategories = [
    { name: 'Flash Sale', href: '#' },
    { name: 'Best Sellers', href: '#' },
    { name: 'Top Rated', href: '#' },
    { name: 'New Arrivals', href: '#' }
]
const filters = [
    {
        id: 'size',
        name: 'Size',
        options: [
            { value: 'S', label: 'S', checked: false },
            { value: 'M', label: 'M', checked: false },
            { value: 'L', label: 'L', checked: false },
        ],
    },
]

// --- COMPUTED PROPERTIES ---
// Products are first filtered by the search query
const filteredProducts = computed(() => {
  if (!searchQuery.value) {
    return props.products;
  }
  return props.products.filter(p =>
    p.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

// Dynamic title for the header
const pageTitle = computed(() => {
    return `Results for "${searchQuery.value}"`
})
</script>

<template>
    <Head title="SearchResults"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-white">
            <div>
                <MobileFilterDialog :sub-categories="subCategories" :filters="filters" />

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <ProductListHeader
                        :title="pageTitle"
                        :sortOptions="sortOptions"
                        :subCategories="subCategories"
                        :filters="filters"
                        :resultCount="filteredProducts.length"
                        @open-mobile-filter="mobileFiltersOpen = true"
                    />

                    <section v-if="filteredProducts.length > 0" aria-labelledby="products-heading" class="pt-6 pb-24">
                        <h2 id="products-heading" class="sr-only">Products</h2>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                            <DesktopFilterSidebar
                                :subCategories="subCategories"
                                :filters="filters"
                            />

                            <div class="lg:col-span-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                                    <ProductCard
                                        v-for="product in filteredProducts"
                                        :key="product.id"
                                        :product="product"
                                    />
                                </div>
                            </div>
                        </div>
                    </section>

                    <div v-else class="text-center py-24">
                        <h2 class="text-xl font-semibold mb-2">No products found for "{{ searchQuery }}"</h2>
                        <p class="text-gray-500">Try a different search term or check your filters.</p>
                    </div>
                </main>
            </div>
        </div>
    </AppLayout>
</template>
