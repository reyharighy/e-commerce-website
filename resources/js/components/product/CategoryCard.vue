<script setup lang="ts">
    import Card from '../ui/card/Card.vue';
    import CardContent from '../ui/card/CardContent.vue';

    defineProps<{
    image: string;
    name: string;
    }>();
</script>

<template>
    <Card
        class="group flex flex-col items-center justify-between rounded-sm p-4 bg-white border border-gray-200 hover:shadow-md hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer"
    >
        <img
        :src="image"
        :alt="name"
        class="w-full h-32 object-cover rounded-sm group-hover:opacity-90 transition-opacity"
        />
        <CardContent class="text-center text-sm font-semibold text-gray-700 mt-4">
        {{ name }}
        </CardContent>
    </Card>
</template>