<script setup lang="ts">
    import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
    import { PlusIcon, MinusIcon } from 'lucide-vue-next'

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
</script>

<template>
    <form class="hidden lg:block">
        <h3 class="sr-only">Categories</h3>
        <ul
        role="list"
        class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900"
        >
        <li v-for="category in subCategories" :key="category.name">
            <a :href="category.href">{{ category.name }}</a>
        </li>
        </ul>

        <Disclosure
        as="div"
        v-for="section in filters"
        :key="section.id"
        class="border-b border-gray-200 py-6"
        v-slot="{ open }"
        >
        <h3 class="-my-3 flow-root">
            <DisclosureButton
            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
            >
            <span class="font-medium text-gray-900">{{ section.name }}</span>
            <span class="ml-6 flex items-center">
                <PlusIcon v-if="!open" class="size-5" aria-hidden="true" />
                <MinusIcon v-else class="size-5" aria-hidden="true" />
            </span>
            </DisclosureButton>
        </h3>
        <DisclosurePanel class="pt-6">
            <div class="space-y-4">
            <div
                v-for="(option, optionIdx) in section.options"
                :key="option.value"
                class="flex gap-3"
            >
                <div class="flex h-5 shrink-0 items-center">
                <div class="group grid size-4 grid-cols-1">
                    <input
                    :id="`filter-${section.id}-${optionIdx}`"
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
                    <path
                        class="opacity-0 group-has-checked:opacity-100"
                        d="M3 8L6 11L11 3.5"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        class="opacity-0 group-has-indeterminate:opacity-100"
                        d="M3 7H11"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    </svg>
                </div>
                </div>
                <label
                :for="`filter-${section.id}-${optionIdx}`"
                class="text-sm text-gray-600"
                >
                {{ option.label }}
                </label>
            </div>
            </div>
        </DisclosurePanel>
        </Disclosure>
    </form>
</template>
