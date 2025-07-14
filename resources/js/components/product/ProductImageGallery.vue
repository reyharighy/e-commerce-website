<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { Card } from '@/components/ui/card'
import { ProductImage } from '@/types';

interface Props {
    images: ProductImage[];
};

const props = defineProps<Props>();

console.log(props.images);

const selectedIndex = ref(0)
const scrollContainer = ref<HTMLElement | null>(null)

function selectImage(index: number) {
    selectedIndex.value = index
}

onMounted(() => {
    scrollToSelected()
})

watch(selectedIndex, () => {
    scrollToSelected()
})

function scrollToSelected() {
    const container = scrollContainer.value
    if (!container) return

    const thumbnails = container.querySelectorAll('.thumbnail')
    const selected = thumbnails[selectedIndex.value] as HTMLElement | undefined

    if (selected) {
        const offsetLeft = selected.offsetLeft
        const containerWidth = container.clientWidth
        const scrollPos = offsetLeft - containerWidth / 2 + selected.clientWidth / 2
        container.scrollTo({ left: scrollPos, behavior: 'smooth' })
    }
}
</script>

<template>
    <div class="w-full md:w-1/2 px-4 mb-8">
        <Card class="px-4 sm:px-12 py-4 rounded-none">
            <img
                :src="route('storage.local', {path: images[selectedIndex]})"
                alt="Selected Product"
                class="rounded-lg shadow-lg transition duration-300 object-contain h-96"
                id="mainImage"
            />
        </Card>

        <div class="flex justify-center items-center gap-3 py-4">
        <!-- Thumbnail gallery -->
        <div
            ref="scrollContainer"
            class="flex gap-3 overflow-x-auto scrollbar-hide px-1"
            tabindex="0"
        >
            <Card
                v-for="(image, index) in images"
                :key="index"
                @click="selectImage(index)"
                class="thumbnail cursor-pointer flex-shrink-0 size-16 sm:size-20 rounded-md border-2 flex items-center justify-center transition duration-200"
                :class="{
                    'border-orange-500 shadow-md': selectedIndex === index,
                    'border-gray-200 hover:border-orange-300': selectedIndex !== index
                }"
            >
            <img
                :src="route('storage.local', {path: image ?? '#'})"
                :alt="'Thumbnail ' + (index + 1)"
                class="h-12 w-12 object-cover rounded pointer-events-none"
            />
            </Card>
        </div>
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
