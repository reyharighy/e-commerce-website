<template>
    <button
        class="h-[44px] flex items-center justify-center gap-2 bg-[#fa8232] text-white px-6 rounded hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-1 transition-all"
        >
        <slot name="icon" />
        <slot />
    </button>
</template>