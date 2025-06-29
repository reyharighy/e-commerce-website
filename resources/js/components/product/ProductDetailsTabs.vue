<script setup lang="ts">
    import { ref, defineProps } from 'vue'

    const props = defineProps<{
    tabs: string[]
    }>()

    const activeTab = ref(props.tabs[0])
</script>

<template>
    <div class="border rounded shadow-sm bg-white">
        <!-- Tabs -->
        <div class="flex flex-wrap overflow-x-auto border-b text-sm font-semibold text-gray-600">
        <button
            v-for="tab in tabs"
            :key="tab"
            @click="activeTab = tab"
            class="py-3 px-5 whitespace-nowrap transition-all duration-200"
            :class="{
            'text-[#fa8232] border-b-2 border-[#fa8232]': activeTab === tab,
            'hover:text-[#fa8232]': activeTab !== tab
            }"
        >
            {{ tab }}
        </button>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6">
        <slot :active-tab="activeTab" />
        </div>
    </div>
</template>
