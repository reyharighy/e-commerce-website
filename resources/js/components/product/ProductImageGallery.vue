<script setup lang="ts">
    import { ref } from 'vue'
    import { MoveLeft, MoveRight } from 'lucide-vue-next'
    import { Card } from '@/components/ui/card'

    defineProps<{
    images: string[]
    }>()

    const selectedIndex = ref(0)
    const scrollContainer = ref<HTMLElement | null>(null)

    function selectImage(index: number) {
    selectedIndex.value = index
    }

    function scrollLeft() {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({ left: -100, behavior: 'smooth' })
    }
    }

    function scrollRight() {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({ left: 100, behavior: 'smooth' })
    }
    }
</script>

<template>
    <div class="w-full md:w-1/2 px-4 mb-8">
        <Card class="px-12 rounded-none">
        <img
            :src="images[selectedIndex]"
            alt="Product"
            class="w-full h-auto rounded-lg shadow-md mb-4"
            id="mainImage"
        />
        </Card>

        <div class="flex justify-center items-center gap-4 py-4 px-2">
        <!-- Tombol kiri -->
        <button
            @click="scrollLeft"
            class="w-8 h-8 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-md"
        >
            <MoveLeft />
        </button>

        <!-- Container thumbnail -->
        <div
            ref="scrollContainer"
            class="flex gap-4 overflow-x-auto scrollbar-hide overflow-x-hidden"
        >
            <Card
            v-for="(img, index) in images"
            :key="index"
            @click="selectImage(index)"
            class="cursor-pointer flex-shrink-0 size-16 sm:size-20 rounded-md border-2 justify-center"
            :class="{
                'border-orange-500': selectedIndex === index,
                'border-transparent': selectedIndex !== index
            }"
            >
            <img
                :src="img"
                :alt="'Thumbnail ' + (index + 1)"
                class="h-12 mx-auto object-cover rounded hover:opacity-60 transition duration-300"
            />
            </Card>
        </div>

        <!-- Tombol kanan -->
        <button
            @click="scrollRight"
            class="w-8 h-8 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-md"
        >
            <MoveRight />
        </button>
        </div>
    </div>
</template>

<style scoped>
    .scrollbar-hide::-webkit-scrollbar {
    display: none;
    }
    .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
    }
</style>