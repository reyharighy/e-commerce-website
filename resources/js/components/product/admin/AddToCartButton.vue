<script setup lang="ts">
import { Button } from '@/components/ui/button';
</script>

<script lang="ts">
import { defineComponent } from 'vue';
import { ShoppingCart } from 'lucide-vue-next';

export default defineComponent({
    components: {
        ShoppingCart
    }
});
</script>

<template>
    <Button class="h-[44px] bg-orange-500 flex gap-2 items-center text-white px-12 rounded-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to Cart
        <ShoppingCart/>
    </Button>
</template>