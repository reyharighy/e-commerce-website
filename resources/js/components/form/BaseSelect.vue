<script setup lang="ts">
    interface Option {
    value: string | number
    label: string
    }

    defineProps<{
    id?: string
    label?: string
    placeholder?: string
    options: Option[]
    modelValue?: string | number
    }>()

    defineEmits(['update:modelValue'])
</script>

<template>
    <div>
        <label :for="id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
        {{ label }}
        </label>
        <select
        :id="id"
        :value="modelValue"
        @change="$emit('update:modelValue', ($event.target as HTMLSelectElement)?.value ?? '')"
        class="block w-full rounded-sm border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
        >
        <option :value="''" disabled hidden>{{ placeholder }}</option>
        <option
            v-for="option in options"
            :key="option.value"
            :value="option.value"
        >
            {{ option.label }}
        </option>
        </select>
    </div>
</template>
