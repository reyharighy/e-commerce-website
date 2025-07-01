<script setup lang="ts">
    import { ref, onMounted, onBeforeUnmount } from 'vue'

    const isOpen = ref(false)
    const dropdownRef = ref<HTMLElement | null>(null)
    const selectedSize = ref<string | null>(null)

    const sizes = ['S', 'M', 'L']

    const toggleDropdown = () => {
    isOpen.value = !isOpen.value
    }

    const selectSize = (size: string) => {
    selectedSize.value = size
    isOpen.value = false
    }

    const handleClickOutside = (event: MouseEvent) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target as Node)) {
        isOpen.value = false
    }
    }

    onMounted(() => {
    document.addEventListener('click', handleClickOutside)
    })

    onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
    })
</script>

<template>
    <!-- Size Dropdown -->
    <div class="mb-2">
    <h3 class="text-lg font-semibold mb-2">Size:</h3>
    <div class="relative inline-block text-left w-full" ref="dropdownRef">
        <button
        type="button"
        @click="toggleDropdown"
        class="inline-flex w-full justify-between items-center rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-800 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 transition"
        :aria-expanded="isOpen"
        aria-haspopup="true"
        >
        {{ selectedSize || 'Select Size' }}
        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
            <path
            fill-rule="evenodd"
            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
            clip-rule="evenodd"
            />
        </svg>
        </button>

        <div
        v-if="isOpen"
        class="absolute right-0 z-10 mt-2 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none transition ease-out duration-100"
        role="menu"
        >
        <ul class="py-1">
            <li
            v-for="size in sizes"
            :key="size"
            @click="selectSize(size)"
            class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
            role="menuitem"
            >
            {{ size }}
            </li>
        </ul>
        </div>
    </div>
    </div>
</template>
