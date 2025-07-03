<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';

interface Props {
    image: string;
    name: string
}

defineProps<Props>();
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