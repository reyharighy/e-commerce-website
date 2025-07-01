<script setup lang="ts">
    import OrangeButton from '@/components/button/OrangeButton.vue'
    import { ref } from 'vue'

    const emit = defineEmits(['search'])
    const keyword = ref('')

    function handleSubmit(e: Event) {
    e.preventDefault()
    emit('search', keyword.value)
    }
</script>

<template>
    <form @submit="handleSubmit" class="max-w-md mx-auto mb-4">
        <label for="default-search" class="sr-only">Search</label>
        <div class="flex border border-gray-300 rounded-lg overflow-hidden">
        <div class="flex items-center px-3 text-gray-500">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input
            v-model="keyword"
            type="search"
            id="default-search"
            placeholder="Search products..."
            class="flex-1 py-2 px-2 text-sm text-gray-900 focus:outline-none"
            required
        />
        <OrangeButton
            type="submit"
            placeholder="Search Products..."
            class="px-4 py-2 rounded-none my-auto">
            Search
        </OrangeButton>
        </div>
    </form>
</template>
