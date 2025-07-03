<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import TagBadge from './TagBadge.vue';

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

const variantInformation = {
    'XXS': 7, 
    'XS': 4, 
    'S': 3,
    'M': 10,
    'L': 11,
    'XL': 2,
    'XXL': 5,
};
</script>

<template>
    <div class="flex flex-col w-full gap-4 h-1/2 py-4 shrink-0 justify-evenly border border-red-500">
        <div class="flex items-center gap-4">
            <span class="text-2xl font-bold text-primary">Rp. 100,000</span>
            <span class="text-primary/50 line-through">Rp. 150,000</span>
            <TagBadge :tag="30" />
        </div>

        <div class="flex flex-col gap-2">
            <p class="text-primary font-medium">Color</p>
            
            <div class="flex gap-1.5">
                <button class="size-10 bg-black rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"></button>
                <button class="size-10 bg-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"></button>
                <button class="size-10 bg-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"></button>
            </div>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <h3 class="text-primary font-medium">Size/Stock</h3>

            <div class="flex w-full gap-2">
                <div v-for="(size, stock) in variantInformation" class="flex flex-col w-full gap-2">
                    <div class="w-full py-3 text-center rounded-lg border border-primary/25 font-semibold cursor-pointer">
                        {{ stock }} 
                    </div>
    
                    <div class="w-full text-center rounded-lg font-semibold cursor-pointer">
                        {{ size }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
