<script setup lang="ts">
    import QuantitySelector from '@/components/product/QuantitySelector.vue'
    import { MoveLeft, ShoppingCart } from 'lucide-vue-next'
    import OrangeButton from '@/components/button/OrangeButton.vue'
    import { computed } from 'vue'
    import Card from '../ui/card/Card.vue'

    interface Product {
    id: number
    name: string
    price: string
    quantity: number
    href: string
    imageSrc: string
    imageAlt: string
    }

    const props = defineProps<{
    products: Product[]
    }>()

    const products = props.products

    const emit = defineEmits(['remove'])

    const totalPrice = computed(() => {
    return products.reduce((sum, p) => {
        const price = parseFloat(p.price.replace('$', ''))
        return sum + price * p.quantity
    }, 0).toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
    })
    })
</script>

<template>
    <Card class="w-full px-4 sm:px-6 lg:px-8 overflow-x-hidden mt-4">
        <div class="flex flex-col bg-white">
        <!-- Header -->
        <div class="border-b border-gray-200 px-4 py-6 sm:px-6">
            <div class="flex items-center gap-4">
            <MoveLeft />
            <h2 class="text-2xl font-semibold text-gray-900">Shopping cart</h2>
            </div>
        </div>

        <!-- Product List -->
        <div class="px-4 sm:px-6 lg:px-8">
            <ul v-if="products.length > 0" role="list" class="divide-y divide-gray-200">
            <li
                v-for="product in products"
                :key="product.id"
                class="flex flex-col md:flex-row items-start gap-6 py-6"
            >
                <div class="w-32 h-32 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                <img
                    :src="product.imageSrc"
                    :alt="product.imageAlt"
                    class="w-full h-full object-cover"
                />
                </div>

                <div class="flex-1 w-full">
                <div class="flex justify-between items-start text-base font-medium text-gray-900">
                    <h3 class="text-lg">
                    <a :href="product.href">{{ product.name }}</a>
                    </h3>
                    <p class="text-right whitespace-nowrap">{{ product.price }}</p>
                </div>

                <div class="mt-3 flex items-center justify-between text-sm">
                    <QuantitySelector />
                    <button
                    type="button"
                    class="font-medium text-indigo-600 hover:text-indigo-500"
                    @click="emit('remove', product)"
                    >
                    Remove
                    </button>
                </div>
                </div>
            </li>
            </ul>

            <!-- Empty State -->
            <div v-else class="py-12 text-center text-gray-500">
            <div class="flex justify-center gap-2 text-lg font-medium">Your cart is empty <ShoppingCart class="size-6"/></div>
            <p class="mt-2 text-sm">Browse products and add some items to your cart.</p>
            </div>
        </div>

        <!-- Summary & Checkout -->
        <div
            v-if="products.length > 0"
            class="border-t border-gray-200 px-4 py-6 sm:px-6 lg:px-8"
        >
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-base font-medium text-gray-900 w-full md:w-auto">
                <p class="flex justify-between md:block">
                <span>Subtotal</span>
                <span class="md:ml-4 text-blue-500">{{ totalPrice }}</span>
                </p>
                <p class="mt-1 text-sm text-gray-500">
                Shipping and taxes calculated at checkout.
                </p>
            </div>

            <OrangeButton class="w-full md:w-auto">
                <a href="#">Checkout</a>
            </OrangeButton>
            </div>
        </div>
        </div>
    </Card>
</template>
