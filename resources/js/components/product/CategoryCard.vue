<script setup lang="ts">
    import Card from '../ui/card/Card.vue';
    import CardContent from '../ui/card/CardContent.vue';

    defineProps({
        image: String,
        name: String
    });
    
</script>

<template>
    <Card
        class="flex flex-col items-center justify-between border rounded-sm p-4 bg-white hover:shadow">
        <img :src="image" class="w-full h-32 object-cover" />
        <CardContent class="text-center text-sm font-medium text-gray-700 mt-4">
            {{ name }}
        </CardContent>
    </Card>
</template>