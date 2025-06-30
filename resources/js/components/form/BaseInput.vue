<script setup lang="ts">
    import { defineProps, defineEmits, computed } from 'vue';

    const props = defineProps({
    id: String,
    label: String,
    placeholder: String,
    type: {
        type: String,
        default: 'text',
    },
    optional: {
        type: Boolean,
        default: false,
    },
    modelValue: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const inputValue = computed({
    get: () => props.modelValue,
    set: (val: string) => emit('update:modelValue', val),
    });
</script>

<template>
    <div class="w-full">
        <label :for="id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
        {{ label }} <span v-if="optional" class="opacity-50">(Optional)</span>
        </label>
        <input
        :type="type"
        :id="id"
        :placeholder="placeholder"
        v-bind="$attrs"
        v-model="inputValue"
        class="block w-full rounded-sm border border-gray-300 p-2.5 text-sm text-gray-900
                focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600
                dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400
                dark:focus:border-primary-500 dark:focus:ring-primary-500"
        />
    </div>
</template>