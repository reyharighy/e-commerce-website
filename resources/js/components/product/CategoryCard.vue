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
        class="group flex flex-col items-center rounded-sm bg-primary-foreground border border-primary/20 hover:shadow-md hover:scale-105 transition-all duration-200 ease-in-out cursor-pointer py-0 pb-6"
    >
        <img
            :src="image"
            :alt="name"
            class="w-full h-32 object-cover rounded-t-sm group-hover:opacity-90 transition-opacity"
        />
        <CardContent class="text-center text-sm font-semibold text-primary">
            {{ name }}
        </CardContent>
    </Card>
</template>