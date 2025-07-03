<script setup lang="ts">
import { computed, defineProps } from 'vue';

const props = defineProps<{ rating: number }>();
const fullStars = computed(() => Math.floor(props.rating));
const hasHalfStar = computed(() => props.rating % 1 >= 0.5);
</script>

<template>
    <div class="flex items-center">
        <span class="text-primary mr-2 font-semibold text-lg">{{ rating }}</span>
        <div v-for="i in 5" :key="i">
            <svg
                v-if="i <= fullStars"
                class="w-6 h-6 text-orange-500"
                fill="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 
                    5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 
                    1.257 5.273c.271 1.136-.964 2.033-1.96 
                    1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273 
                    -4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 
                    2.082-5.005Z"
                />
            </svg>

            <svg
                v-else-if="i === fullStars + 1 && hasHalfStar"
                class="w-6 h-6 text-orange-500"
                fill="currentColor"
                viewBox="0 0 24 24"
            >
                <defs>
                    <linearGradient id="half-grad">
                        <stop offset="50%" stop-color="currentColor" />
                        <stop offset="50%" stop-color="lightgray" />
                    </linearGradient>
                </defs>
                <path
                fill="url(#half-grad)"
                d="M10.788 3.21c.448-1.077 1.976-1.077 
                2.424 0l2.082 5.006 5.404.434c1.164.093 
                1.636 1.545.749 2.305l-4.117 3.527 
                1.257 5.273c.271 1.136-.964 2.033-1.96 
                1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273 
                -4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 
                2.082-5.005Z"
                />
            </svg>

            <svg
                v-else
                class="w-6 h-6 text-gray-300"
                fill="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 
                2.424 0l2.082 5.006 5.404.434c1.164.093 
                1.636 1.545.749 2.305l-4.117 3.527 
                1.257 5.273c.271 1.136-.964 2.033-1.96 
                1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273 
                -4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 
                2.082-5.005Z"
                />
            </svg>
        </div>
    </div>
</template>