<script lang="ts">
    import { defineComponent } from 'vue';
    import { Heart } from 'lucide-vue-next';
    
    export default defineComponent({
        components: {
            Heart
        }
    });
</script>

<template>
    <div class="flex items-center gap-2 mb-4">
        <button class="hover:bg-gray-200 cursor-pointer"><Heart></Heart></button>Add to Wishlist
    </div>
</template>