<script setup lang="ts">
import { computed } from 'vue';
import BaseInput from './BaseInput.vue';

const props = defineProps<{
  modelValue: {
    name: string;
    number: string;
    expiry: string;
    cvc: string;
  };
}>();

const emit = defineEmits(['update:modelValue']);

// Bind langsung ke modelValue agar sinkron dengan parent
const name = computed({
  get: () => props.modelValue.name,
  set: (val) => emit('update:modelValue', { ...props.modelValue, name: val })
});

const number = computed({
  get: () => props.modelValue.number,
  set: (val) => emit('update:modelValue', { ...props.modelValue, number: val })
});

const expiry = computed({
  get: () => props.modelValue.expiry,
  set: (val) => emit('update:modelValue', { ...props.modelValue, expiry: val })
});

const cvc = computed({
  get: () => props.modelValue.cvc,
  set: (val) => emit('update:modelValue', { ...props.modelValue, cvc: val })
});
</script>

<template>
    <div class="grid grid-cols-1 gap-4 mt-6">
        <BaseInput id="card-name" label="Name on Card" placeholder="Full Name" v-model="name" />
        <BaseInput id="card-number" label="Card Number" placeholder="1234 5678 9012 3456" v-model="number" />

        <div class="grid grid-cols-2 gap-4">
        <BaseInput id="card-expiry" label="Expire Date" placeholder="MM/YY" v-model="expiry" />
        <BaseInput id="card-cvc" label="CVC" placeholder="123" v-model="cvc" />
        </div>
    </div>
</template>
