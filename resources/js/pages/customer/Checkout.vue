<template>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
                <div class="min-w-0 flex-1 space-y-8">
                    <BillingForm/>
                    <Card class="rounded-sm">
                        <div class="space-y-6 px-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment Option</h3>
                            <hr><PaymentMethodSelector/><hr>
                            <CreditCardForm v-model="creditCard"/>
                        </div>
                    </Card>
                    <OrderNotes v-model="orderNotes" />
                </div>

                <OrderSummary
                    :items="orderItems"
                    :summaryDetails="{
                        'sub-total': 320,
                        shipping: 'Free',
                        discount: 24,
                        tax: 61.99
                    }"
                    :total="357.99"
                />
            </div>
        </form>
    </section>
</template>

<script setup lang="ts">
    import { ref } from 'vue';
    import BillingForm from '@/components/form/BillingForm.vue';
    import CreditCardForm from '@/components/form/CreditCardForm.vue';
    import PaymentMethodSelector from '@/components/form/PaymentMethodSelector.vue';
    import Card from '@/components/ui/card/Card.vue';
    import OrderNotes from '@/components/form/OrderNotes.vue';
    import OrderSummary from '@/components/form/OrderSummary.vue';

const creditCard = ref({
    name: '',
    number: '',
    expiry: '',
    cvc: ''
});

const orderNotes = ref('');

const orderItems = [
  {
    image: 'https://images.unsplash.com/photo-1505751171710-1f6d0ace5a85?ixlib=rb-4.0.3&q=80&w=1080',
    name: 'Canon EOS 1500D DSLR Camera Body+ 18-55mm',
    quantity: 1,
    price: 70,
  },
  {
    image: 'https://images.unsplash.com/photo-1484704849700-f032a568e944?ixlib=rb-4.0.3&q=80&w=1080',
    name: 'Wired Over-Ear Gaming Headphones with USB',
    quantity: 3,
    price: 250,
  },
];
</script>