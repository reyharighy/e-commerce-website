<script setup lang="ts">
import { Check, NotebookText, Package, Truck, Handshake } from 'lucide-vue-next'

// Props
defineProps({
  activeStep: {
    type: Number,
    default: 0 // Index of the current step
  }
})

// Step data (can be passed via props too if needed)
const steps = [
  { label: 'Order Placed', icon: NotebookText },
  { label: 'Packaging', icon: Package },
  { label: 'On The Road', icon: Truck },
  { label: 'Delivered', icon: Handshake }
]

</script>

<template>
    <div class="w-full py-9 flex flex-col items-start">
        <div class="w-full flex flex-col justify-center sm:items-center items-start gap-8">
            <ol class="flex sm:items-center items-start w-full sm:gap-0 gap-5">
                <li
                    v-for="(step, index) in steps"
                    :key="step.label"
                    class="flex w-full relative justify-center text-base font-semibold"
                    :class="{
                        // The line connects the nodes
                        'after:content-[\'\'] after:w-full after:h-1 after:absolute after:top-4 after:left-1/2': index !== steps.length - 1,
                        // Line color logic
                        'after:bg-[#FA8232]': index < activeStep,
                        'after:bg-[#FFE7D6]': index >= activeStep
                    }"
                >
                    <div class="z-10 flex flex-col items-center text-center gap-y-2">
                        <span
                            class="w-8 h-8 rounded-full flex justify-center items-center mx-auto font-bold text-sm"
                            :class="{
                                'bg-[#FA8232] text-white': index <= activeStep,
                                'border-2 border-[#FA8232] text-[#FA8232] bg-transparent': index > activeStep
                            }"
                        >
                            <Check v-if="index < activeStep" class="w-5 h-5" />
                            <span v-else>{{ index + 1 }}</span>
                        </span>

                        <component
                            :is="step.icon"
                            class="w-8 h-8"
                            :class="{
                                'text-green-500' : index < activeStep,
                                'text-[#FA8232]': index == activeStep,
                                'text-[#FFE7D6]': index > activeStep
                            }"
                        />

                        <span
                            class="text-sm font-medium text-center"
                            :class="{
                                'text-gray-800': index <= activeStep,
                                'text-gray-400': index > activeStep
                            }"
                        >
                            {{ step.label }}
                        </span>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</template>