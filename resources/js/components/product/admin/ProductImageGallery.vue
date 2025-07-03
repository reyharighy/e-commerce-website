<script setup lang="ts">
import { ref } from 'vue'
import { Card } from '@/components/ui/card'

interface Props {
    images: Record<string, string>;
}

defineProps<Props>()

const selectedIndex = ref<string>('0')
const scrollContainer = ref<HTMLElement | null>(null)

const selectImage = (index: string) => {
    selectedIndex.value = index
}
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<template>
    <div class="w-1/2 flex flex-col justify-between gap-2">
        <div class="carousel rounded-box w-full h-full flex justify-center">
            <div class="carousel-item w-full">
                <img
                    :src="images[selectedIndex]"
                    class="w-full"
                    alt="Tailwind CSS Carousel component"
                />
            </div>
        </div>

        <div
            ref="scrollContainer"
            class="flex justify-center gap-4 overflow-x-auto scrollbar-hide w-full h-fit"
        >
            <Card
                v-for="(img, key) in images"
                :key="key"
                @click="selectImage(key)"
                class="cursor-pointer size-20 rounded-md border justify-center h-full"
                :class="{
                    'border-primary/50': selectedIndex === key,
                    'border-transparent': selectedIndex !== key
                }"
            >
                <img
                    :src="img"
                    :alt="'Thumbnail ' + (key + 1)"
                    class="object-fill rounded hover:opacity-60 transition duration-300"
                />
            </Card>
        </div>
    </div>
</template>