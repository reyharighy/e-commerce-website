<script setup lang="ts">
    import { computed } from 'vue';

    const props = defineProps<{
    modelValue: string;
    }>();

    const emit = defineEmits<{
    (e: 'update:modelValue', val: string): void;
    }>();

    const localNotes = computed({
    get: () => props.modelValue,
    set: (val: string) => emit('update:modelValue', val),
    });
</script>

<template>
    <div class="space-y-6 max-w-4xl">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Additional Information</h3>

        <label for="order-notes" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
        Order Notes <span class="opacity-50">(Optional)</span>
        </label>

        <textarea
        id="order-notes"
        name="order_notes"
        rows="4"
        cols="20"
        v-model="localNotes"
        class="mb-4 resize-none block w-full rounded-md border border-gray-300 p-3 text-sm text-gray-900 placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        placeholder="Notes about your order, e.g. special notes for delivery"
        ></textarea>
    </div>
</template>