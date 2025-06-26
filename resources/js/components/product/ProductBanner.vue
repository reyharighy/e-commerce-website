<script setup lang="ts">
    import PlaceholderPattern from '../PlaceholderPattern.vue';
</script>

<template>
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 auto-rows-min">
            <!-- Kolom 1: Lebar penuh (besar) -->
            <div class="h-full w-full md:col-span-2 aspect-video relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>

            <!-- Kolom 2: Dua elemen kecil (stacked) -->
            <div class="flex flex-col gap-4">
                <div class="aspect-video relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="aspect-video relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
        </div>
    </div>
</template>