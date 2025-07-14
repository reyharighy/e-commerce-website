<script setup lang="ts">
import { ref } from 'vue'
import ProductCard from '@/components/product/ProductCard.vue'
import MobileFilterDialog from '@/layouts/product-filter-search/MobileFilterDialog.vue'
import ProductListHeader from '@/layouts/product-filter-search/ProductListHeader.vue'
import DesktopFilterSidebar from '@/layouts/product-filter-search/DesktopFilterSidebar.vue'
import { Product } from '@/types'

interface Props {
    products: Product[];
}

const props = defineProps<Props>();

const mobileFiltersOpen = ref(false)

const dialogComponent = ref<InstanceType<typeof MobileFilterDialog> | null>(null)

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

</script>

<template>
    <div class="bg-white">
        <div>
            <MobileFilterDialog ref="dialogComponent" :sub-categories="subCategories" :filters="filters" />
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <ProductListHeader
                    title="New Arrivals"
                    :sortOptions="sortOptions"
                    :subCategories="subCategories"
                    :filters="filters"
                    @open-mobile-filter="mobileFiltersOpen = true"
                    @view-grid="() => {}"
                />

                <section aria-labelledby="products-heading" class="pt-6 pb-24">
                    <h2 id="products-heading" class="sr-only">Products</h2>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <DesktopFilterSidebar
                            :subCategories="subCategories"
                            :filters="filters"
                        />
                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                                <ProductCard
                                    v-for="product in products"
                                    :key="product.id"
                                    :product="product"
                                />
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>