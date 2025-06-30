<script setup lang="ts">
    import { ref } from 'vue';

    const quantity = ref(1);

    function increment() {
    quantity.value++;
    }

    function decrement() {
    if (quantity.value > 1) quantity.value--;
    }
</script>

<template>
    <div class="inline-flex items-center border border-gray-300 rounded px-3 py-2 dark:border-neutral-700">
        <button
        type="button"
        aria-label="Decrease quantity"
        @click="decrement"
        :disabled="quantity <= 1"
        class="w-6 h-6 flex items-center justify-center text-sm rounded hover:bg-gray-100 disabled:opacity-50 dark:text-white dark:hover:bg-neutral-800"
        >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 12h14" />
        </svg>
        </button>

        <input
        type="number"
        v-model="quantity"
        class="w-10 text-center bg-transparent border-0 text-gray-800 dark:text-white focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
        min="1"
        />

        <button
        type="button"
        aria-label="Increase quantity"
        @click="increment"
        class="w-6 h-6 flex items-center justify-center text-sm rounded hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-800"
        >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
        </button>
    </div>
</template>
