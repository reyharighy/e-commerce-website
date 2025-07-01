<script setup lang="ts">
    import OrderPreview from '@/components/order/OrderPreview.vue';
    import Card from '@/components/ui/card/Card.vue';
    import { MoveLeft, CheckCheck, UserRound, MapPin, Map, CircleCheck, NotepadText } from 'lucide-vue-next';
    import OrderStatus from '@/components/order/OrderStatus.vue';
    import OrderActivity from '@/components/order/OrderActivity.vue';
    import ProductTable from '@/components/product/ProductTable.vue';
    import AddressSummary from '@/components/order/AddressSummary.vue';

    const activityLog = [
    {
        icon: CheckCheck,
        message: 'Your order has been delivered. Thank you for shopping at Milo & Mixy.',
        timestamp: 'Jan 23, 2021 at 7:32 PM',
        bg: 'bg-[#EAF7E9]',
        color: 'text-green-500'
    },
    {
        icon: UserRound,
        message: 'Our delivery man (John Wick) has picked-up your order for delivery.',
        timestamp: 'Jan 23, 2021 at 2:00 PM'
    },
    {
        icon: MapPin,
        message: 'Your order has reached at last mile hub.',
        timestamp: 'Jan 22, 2021 at 8:00 AM'
    },
    {
        icon: Map,
        message: 'Your order on the way to (last mile) hub.',
        timestamp: 'Jan 21, 2021 at 5:32 AM'
    },
    {
        icon: CircleCheck,
        message: 'Your order is successfully verified.',
        timestamp: 'Jan 20, 2021 at 7:32 PM',
        bg: 'bg-[#EAF7E9]',
        color: 'text-green-500'
    },
    {
        icon: NotepadText,
        message: 'Your order has been confirmed',
        timestamp: 'Jan 19, 2021 at 2:32 PM'
    }
    ]

    const orderProducts = [
    {
        name: 'Smartphone',
        description: 'Unlocked Smartphone with Android 10',
        price: 899,
        quantity: 1,
        image: 'https://images.unsplash.com/photo-1600087626120-062700394a01?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    },
    {
        name: 'Crystal Clear Case',
        description: 'For Google Pixel 6 Pro',
        price: 299,
        quantity: 1,
        image: 'https://images.unsplash.com/photo-1623393945964-8f5d573f9358?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    }
    ]

    const billingAddress = {
        name: 'Kevin Gilbert',
        address: '45 Dreamland St., NY',
        email: 'kevin@email.com',
        phone: '111'
    }

    const shippingAddress = {
        name: 'Kevin Gilbert',
        address: '78A Techtitans Road, IL',
        email: 'kevin@email.com',
        phone: '+1 555-656-9999'
    }

    const orderNotes = 'Deliver before 5 PM. Handle with care. Leave at the door if not home.'
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <Card class="px-10">
            <div class="flex gap-4 font-medium">
                <a href=""><MoveLeft/></a>
                ORDER DETAILS
            </div>
            <hr>

            <OrderPreview
                orderId="96459761"
                :productCount="4"
                orderDate="17th Jan 2021"
                orderTime="7:52 PM"
                totalAmount="1199.00"
                />
            <OrderStatus :activeStep="1" />

            <hr>
            <OrderActivity :activities="activityLog" />
            <hr>

            <ProductTable :products="orderProducts" />
            
            <hr>
            <AddressSummary
                :billing="billingAddress"
                :shipping="shippingAddress"
                :notes="orderNotes"
            />
        </Card>
    </div>
</template>


