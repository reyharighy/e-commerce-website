<script setup lang="ts">
    import { ref, onMounted, onBeforeUnmount } from 'vue'

    const isOpen = ref(false)
    const dropdownRef = ref<HTMLElement | null>(null)

    const toggleDropdown = () => {
    isOpen.value = !isOpen.value
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
    <div class="grid grid-cols-2 mb-6">
        <!-- Color Selection -->
        <div>
        <h3 class="text-lg font-semibold mb-2">Color:</h3>
        <div class="flex space-x-2">
            <button class="w-8 h-8 bg-black rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"></button>
            <button class="w-8 h-8 bg-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"></button>
            <button class="w-8 h-8 bg-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"></button>
        </div>
        </div>

        <!-- Size Dropdown -->
        <div>
        <h3 class="text-lg font-semibold mb-2">Size</h3>
        <div class="relative inline-block text-left" ref="dropdownRef">
            <button
            type="button"
            @click="toggleDropdown"
            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
            :aria-expanded="isOpen"
            aria-haspopup="true"
            >
            Options
            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path
                fill-rule="evenodd"
                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                clip-rule="evenodd"
                />
            </svg>
            </button>

            <div
            v-if="isOpen"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none transition ease-out duration-100"
            role="menu"
            aria-orientation="vertical"
            >
            <div class="py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">S</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">M</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">L</a>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
