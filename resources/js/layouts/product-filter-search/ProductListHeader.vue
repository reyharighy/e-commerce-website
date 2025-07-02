<script setup lang="ts">
    import { ref } from 'vue'
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
    import { ChevronDownIcon, FunnelIcon, Squares2X2Icon } from '@heroicons/vue/20/solid'
    import MobileFilterDialog from './MobileFilterDialog.vue'

    // Define props for ProductListHeader
    defineProps<{
    title: string
    sortOptions: Array<{ name: string; href: string; current: boolean }>
    // These props are now also needed for MobileFilterDialog, so they should be passed down
    subCategories: Array<{ name: string; href: string }>
    filters: Array<{
        id: string
        name: string
        options: Array<{
        value: string
        label: string
        checked?: boolean
        }>
    }>
    }>()

    // Define emits for ProductListHeader
    defineEmits(['view-grid']) // Removed 'open-mobile-filter' as it's now handled internally

    // Create a ref to access the MobileFilterDialog component instance
    const mobileFilterDialogRef = ref<InstanceType<typeof MobileFilterDialog> | null>(null)

    // Function to open the mobile filter dialog
    const openMobileFilterDialog = () => {
    mobileFilterDialogRef.value?.open()
    }
</script>

<template>
    <div class="flex items-baseline justify-between border-b border-gray-200 pt-10 pb-6">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">{{ title }}</h1>

        <div class="flex items-center">
        <Menu as="div" class="relative inline-block text-left">
            <div>
            <MenuButton class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                Sort
                <ChevronDownIcon
                class="-mr-1 ml-1 size-5 shrink-0 text-gray-400 group-hover:text-gray-500"
                aria-hidden="true"
                />
            </MenuButton>
            </div>

            <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
            >
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black/5 focus:outline-hidden"
            >
                <div class="py-1">
                <MenuItem v-for="option in sortOptions" :key="option.name" v-slot="{ active }">
                    <a
                    :href="option.href"
                    :class="[
                        option.current ? 'font-medium text-gray-900' : 'text-gray-500',
                        active ? 'bg-gray-100 outline-hidden' : '',
                        'block px-4 py-2 text-sm'
                    ]"
                    >
                    {{ option.name }}
                    </a>
                </MenuItem>
                </div>
            </MenuItems>
            </transition>
        </Menu>

        <button
            type="button"
            class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7"
            @click="$emit('view-grid')"
        >
            <span class="sr-only">View grid</span>
            <Squares2X2Icon class="size-5" aria-hidden="true" />
        </button>

        <button
            type="button"
            class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
            @click="openMobileFilterDialog"
        >
            <span class="sr-only">Filters</span>
            <FunnelIcon class="size-5" aria-hidden="true" />
        </button>
        </div>
    </div>

    <MobileFilterDialog
        ref="mobileFilterDialogRef"
        :subCategories="subCategories"
        :filters="filters"
    />
</template>