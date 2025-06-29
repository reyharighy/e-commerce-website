<script setup lang="ts">
    import { ref, computed } from 'vue'
    import OrderSummary from './OrderSummary.vue'

    // Define orderItems as a reactive array of OrderItem objects
    type OrderItem = { price: number; quantity: number; name: string; image: string }
    const orderItems = ref<OrderItem[]>([])

    const shipping = ref<'Free' | number>('Free')
    const discount = ref(24)
    const taxRate = ref(0.1) // 10%

    const subTotal = computed(() =>
    orderItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
    )

    const tax = computed(() => subTotal.value * taxRate.value)

    const summaryDetails = computed(() => ({
    'sub-total': subTotal.value,
    shipping: shipping.value,
    discount: discount.value,
    tax: Number(tax.value.toFixed(2)),
    }))

    const total = computed(() => {
    const shippingCost = typeof shipping.value === 'number' ? shipping.value : 0
    return Number((subTotal.value + tax.value + shippingCost - discount.value).toFixed(2))
    })
</script>

<template>
    <OrderSummary
        :items="orderItems"
        :summaryDetails="summaryDetails"
        :total="total"
    />
</template>
