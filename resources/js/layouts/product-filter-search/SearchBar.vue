<script setup lang="ts">
import { Search } from 'lucide-vue-next'
import { ref, watch } from 'vue';

const keyword = ref<string>('');
const emit = defineEmits(['update:search']);

let debounceTimer: ReturnType<typeof setTimeout>;

const debounce = (fn: Function, delay: number) => {
    return (...args: any[]) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
        fn(...args);
        }, delay);
    };
};

const debouncedEmit = debounce((value: string) => {
    emit('update:search', value);
}, 1000);

watch(keyword, (newValue) => {
    debouncedEmit(newValue);
});
</script>

<template>
    <label for="default-search" class="sr-only">Search</label>

    <div class="flex items-center justify-between h-full w-1/2 py-2 border border-primary/20 rounded-md">
        <Search class="size-5 mx-3 my-0 text-primary" />

        <input
            v-model="keyword"
            id="default-search"
            placeholder="Search products..."
            class="text-sm text-primary focus:outline-none w-full"
        />
    </div>
</template>
