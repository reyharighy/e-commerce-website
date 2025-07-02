<script setup lang="ts">
interface Activity {
    bg?: string;
    color?: string;
    icon: any;
    message: string;
    timestamp: string;
}

defineProps<{
    activities: Activity[];
}>();
</script>

<template>
    <div>
        <h2 class="text-lg font-semibold mb-2">Order Activity</h2>
        <div class="space-y-5 text-sm text-gray-700">
        <div v-for="(activity, index) in activities" :key="index" class="flex gap-5">
            <!-- Icon -->
            <div
            class="flex items-center justify-center w-10 h-10 rounded"
            :class="[
                activity.bg || 'bg-[#EAF6FE]',
                activity.color || 'text-blue-500',
                'dark:bg-orange-950 dark:text-orange-400'
            ]"
            >
            <component :is="activity.icon" class="w-5 h-5" />
            </div>

            <!-- Content -->
            <div class="grid">
            <p class="font-bold">{{ activity.message }}</p>
            <p class="text-gray-400">{{ activity.timestamp }}</p>
            </div>
        </div>
        </div>
    </div>
</template>


