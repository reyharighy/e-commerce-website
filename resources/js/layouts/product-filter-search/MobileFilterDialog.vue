<script setup lang="ts">
    import { ref } from 'vue'
    import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    TransitionChild,
    TransitionRoot,
    } from '@headlessui/vue'
    import { XMarkIcon } from '@heroicons/vue/24/outline'
    import { PlusIcon, MinusIcon } from 'lucide-vue-next'

    // Properti yang diterima dari komponen induk
    defineProps<{
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

    // Variabel reaktif untuk mengontrol status buka/tutup dialog
    const mobileFiltersOpen = ref(false)

    // Mengekspos variabel atau fungsi ke komponen induk
    // Ini memungkinkan induk untuk memanggil, misalnya, `dialogComponent.value.open()`
    defineExpose({
    open: () => {
        mobileFiltersOpen.value = true
    },
    close: () => {
        mobileFiltersOpen.value = false
    },
    // Anda juga bisa mengekspos ref secara langsung jika diinginkan
    // mobileFiltersOpen
    })
</script>

<template>
    <TransitionRoot as="template" :show="mobileFiltersOpen">
        <Dialog class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
        <TransitionChild
            as="template"
            enter="transition-opacity ease-linear duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="transition-opacity ease-linear duration-300"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 z-40 flex">
            <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="translate-x-full"
            >
            <DialogPanel class="relative ml-auto flex size-full max-w-xs flex-col overflow-y-auto bg-white pt-4 pb-6 shadow-xl">
                <div class="flex items-center justify-between px-4">
                <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                <button
                    type="button"
                    class="relative -mr-2 flex size-10 items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:outline-hidden"
                    @click="mobileFiltersOpen = false"
                >
                    <span class="absolute -inset-0.5" />
                    <span class="sr-only">Close menu</span>
                    <XMarkIcon class="size-6" aria-hidden="true" />
                </button>
                </div>

                <form class="mt-4 border-t border-gray-200">
                <h3 class="sr-only">Categories</h3>
                <ul role="list" class="px-2 py-3 font-medium text-gray-900">
                    <li v-for="category in subCategories" :key="category.name">
                    <a :href="category.href" class="block px-2 py-3">{{ category.name }}</a>
                    </li>
                </ul>

                <Disclosure as="div" v-for="section in filters" :key="section.id" class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                    <h3 class="-mx-2 -my-3 flow-root">
                    <DisclosureButton class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                        <span class="font-medium text-gray-900">{{ section.name }}</span>
                        <span class="ml-6 flex items-center">
                        <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                        <MinusIcon v-else class="size-5" aria-hidden="true" />
                        </span>
                    </DisclosureButton>
                    </h3>
                    <DisclosurePanel class="pt-6">
                    <div class="space-y-6">
                        <div v-for="(option, optionIdx) in section.options" :key="option.value" class="flex gap-3">
                        <div class="flex h-5 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                            <input
                                :id="`filter-mobile-${section.id}-${optionIdx}`"
                                :name="`${section.id}[]`"
                                :value="option.value"
                                type="checkbox"
                                :checked="option.checked"
                                class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                            />
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                viewBox="0 0 14 14"
                                fill="none"
                            >
                                <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            </div>
                        </div>
                        <label :for="`filter-mobile-${section.id}-${optionIdx}`" class="min-w-0 flex-1 text-gray-500">{{ option.label }}</label>
                        </div>
                    </div>
                    </DisclosurePanel>
                </Disclosure>
                </form>
            </DialogPanel>
            </TransitionChild>
        </div>
        </Dialog>
    </TransitionRoot>
</template>