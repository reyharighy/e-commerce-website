<script setup lang="ts">
import HeaderLayout from '@/layouts/app/AppHeaderLayout.vue';
import SidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { usePage } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const role = usePage().props.auth?.user.role;
</script>

<template>
    <HeaderLayout v-if="role == 'customer'" :breadcrumbs="breadcrumbs">
        <slot />
    </HeaderLayout>
    <SidebarLayout v-else :breadcrumbs="breadcrumbs">
        <slot />
    </SidebarLayout>
</template>
