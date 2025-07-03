<script setup lang="ts">
    import { ref, defineProps } from 'vue'

    const props = defineProps<{
        tabs: string[]
    }>()

    const activeTab = ref(props.tabs[0])
</script>

<template>
    <div class="border rounded shadow-sm bg-white">
        <div class="flex flex-wrap border-b text-sm font-semibold text-gray-600">
            <button
                v-for="tab in tabs"
                :key="tab"
                @click="activeTab = tab"
                class="py-3 px-5 transition-all"
                :class="{
                  'text-orange-500 border-b-2 border-orange-500': activeTab === tab,
                  'hover:text-orange-500': activeTab !== tab
                }"
            >
            {{ tab }}
            </button>
        </div>

        <div class="p-4 sm:p-6"> 
            <slot :active-tab="activeTab" />
        </div>
    </div>
</template>