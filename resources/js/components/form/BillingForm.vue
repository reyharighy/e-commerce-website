<script setup lang="ts">
    import BaseInput from './BaseInput.vue'
    import BaseSelect from './BaseSelect.vue'

    const countryOptions = [
    { value: 'US', label: 'United States' },
    { value: 'AS', label: 'Australia' },
    { value: 'FR', label: 'France' },
    { value: 'ES', label: 'Spain' },
    { value: 'UK', label: 'United Kingdom' },
    ]

    const regionOptions = [
    { value: 'AL', label: 'Alakazam' },
    { value: 'AW', label: 'Awikwok' },
    { value: 'SY', label: 'Sybau' },
    { value: 'AN', label: 'Anjay' },
    { value: 'TP', label: 'TS PMO' },
    ]

    const cityOptions = [
    { value: 'SF', label: 'San Francisco' },
    { value: 'NY', label: 'New York' },
    { value: 'LA', label: 'Los Angeles' },
    { value: 'CH', label: 'Chicago' },
    { value: 'HU', label: 'Houston' },
    ]
</script>

<template>
    <div class="space-y-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Billing Information</h2>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <BaseInput label="First Name" placeholder="First Name" id="first_name" required />
        <BaseInput label="Last Name" placeholder="Last Name" id="last_name"/>
        <BaseInput label="Company Name" placeholder="(Optional)" id="company_name" class="sm:col-span-2" />
        
        <BaseInput label="Address" id="address" class="col-span-1 sm:col-span-2 lg:col-span-4" required/>

        <BaseSelect label="Country" placeholder="Select..." id="select-country" :options="countryOptions" />
        <BaseSelect label="Region/State" placeholder="Select..." id="select-region" :options="regionOptions" />
        <BaseSelect label="City" placeholder="Select..." id="select-city" :options="cityOptions" />
        <BaseInput label="Zip Code" id="zip_code" />

        <BaseInput label="Email" id="email" type="email" class="col-span-2" required />
        <BaseInput label="Phone Number" id="email" type="number" class="col-span-2 [-moz-appearance:_textfield] [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none" required />

        <div class="col-span-2">
            <input type="checkbox" id="different-address" />
            <label for="different-address" class="text-sm opacity-50 ml-2">Ship into different address</label>
        </div>
        </div>
    </div>
</template>