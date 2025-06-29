<script setup lang="ts">
    import { DollarSign, CreditCard } from 'lucide-vue-next'

    interface PaymentMethod {
    label: string
    value: string
    icon?: any
    iconClass?: string
    image?: string
    }

    defineProps({
    modelValue: String,
    name: {
        type: String,
        default: 'payment-method',
    },
    paymentMethods: {
        type: Array as () => PaymentMethod[],
        default: () => [
        { label: 'Cash on Delivery', value: 'cod', icon: DollarSign, iconClass: 'text-[#fa8232]' },
        { label: 'Venmo', value: 'venmo', image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Venmo_logo.png/640px-Venmo_logo.png' },
        { label: 'Paypal', value: 'paypal', image: 'https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg' },
        { label: 'Amazon Pay', value: 'amazon', image: 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg' },
        { label: 'Debit/Credit Card', value: 'card', icon: CreditCard, iconClass: 'text-[#fa8232]' },
        ]
    }
    })

    const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="grid grid-cols-2 sm:grid-cols-3 2xl:grid-cols-5 gap-4">
        <label
        v-for="(method, index) in paymentMethods"
        :key="index"
        class="relative flex flex-col items-center p-3 border rounded text-center cursor-pointer"
        >
        <component
            :is="method.icon ? method.icon : 'img'"
            v-bind="method.icon ? {} : { src: method.image, alt: method.label }"
            class="h-6"
            :class="method.icon ? method.iconClass : ''"
        />
        <span class="my-2 text-sm line-clamp-3 max-sm:min-h-[2rem] whitespace-normal break-words">
            {{ method.label }}
        </span>
        <input
            type="radio"
            :name="name"
            :value="method.value"
            :checked="modelValue === method.value"
            @change="emit('update:modelValue', method.value)"
            class="h-4 w-4"
        />
        </label>
    </div>
</template>
