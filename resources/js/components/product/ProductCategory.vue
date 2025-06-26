<script setup lang="ts">
    import Card from '../ui/card/Card.vue';
    import CardContent from '../ui/card/CardContent.vue';
    const categories = [
        { name: 'Computer & Laptop', image: '💻' },
        { name: 'SmartPhone', image: '📱' },
        { name: 'Headphones', image: '🎧' },
        { name: 'Accessories', image: '⌨️' },
        { name: 'Camera & Photo', image: '📷' },
        { name: 'TV & Homes', image: '📺' },
    ]
</script>

<template>
    <div class="py-8 w-full mx-auto">
        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Shop with Categories</h1>
    
        <!-- Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 mb-10">
            <Card
                v-for="(cat, index) in categories"
                :key="index"
                class="flex flex-col items-center justify-center border rounded-lg p-4 bg-white hover:shadow">
                <CardContent class="text-4xl mb-2">{{ cat.image }}</CardContent>
                <CardContent class="text-center text-sm font-medium text-gray-700">{{ cat.name }}</CardContent>
            </Card>
        </div>
    </div>
</template>