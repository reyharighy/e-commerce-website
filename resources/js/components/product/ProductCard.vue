<script setup lang="ts">
    import Card from '../ui/card/Card.vue';
    import CardDescription from '../ui/card/CardDescription.vue';
    
    defineProps({
    product: {
        type: Object,
        required: true,
    },
    });

    // Helper to determine badge style
    const getTagClass = (tag: string | undefined): string => {
        if (!tag) return '';
        if (tag === 'HOT') return 'bg-red-500 text-white';
        if (tag === 'SALE') return 'bg-green-500 text-white';
        if (tag.includes('%')) return 'bg-yellow-400 text-black';
        if (tag === 'BEST DEALS') return 'bg-blue-500 text-white';
        return '';
    };
</script>

<template>
    <Card class="bg-white text-black rounded shadow p-4 relative flex flex-col">
        <!-- Tag Badge -->
        <div
            v-if="product.tag"
            class="absolute top-2 left-2 px-2 py-1 text-xs font-bold rounded z-10"
            :class="getTagClass(product.tag)">
            {{ product.tag }}
        </div>

        <!-- Product Image -->
        <div class="w-full h-40 overflow-hidden bg-gray-50">
        <img
            :src="product.image || 'https://via.placeholder.com/150'"
            class="h-full w-full object-cover"/>
        </div>

        <!-- Rating -->
        <p class="text-sm text-orange-500 font-semibold mb-1">
            {{ '★'.repeat(Math.floor(product.rating)) + '☆'.repeat(5 - Math.floor(product.rating)) }}
            ({{ product.reviews }})
        </p>

        <!-- Title -->
        <CardTitle
            :title="product.title"
            class="line-clamp-2 min-h-[3rem]">
            {{ product.title }}
        </CardTitle>

        <!-- Price -->
        <CardDescription>
            <span class="text-blue-600 font-bold text-base">${{ product.price }}</span>
            <span
                v-if="product.originalPrice"
                class="line-through text-gray-400 text-sm">${{ product.originalPrice }}</span>
        </CardDescription>

        <!-- Icons -->
        <div class="absolute top-2 right-2 flex flex-col gap-2">
            <button class="bg-white p-1 rounded-full shadow hover:bg-gray-100">♡</button>
            <button class="bg-white p-1 rounded-full shadow hover:bg-gray-100">🛒</button>
        </div>
    </Card>
</template>