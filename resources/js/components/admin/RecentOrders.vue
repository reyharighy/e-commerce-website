<template>
    <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left text-gray-700 whitespace-nowrap">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
        <tr>
            <th class="px-4 py-2">Order ID</th>
            <th class="px-4 py-2">Customer</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="order in recentOrders"
            :key="order.id"
            class="border-b hover:bg-gray-50"
        >
            <td class="px-4 py-2 font-mono">#{{ order.id }}</td>
            <td class="px-4 py-2">{{ order.customer }}</td>
            <td class="px-4 py-2">{{ order.date }}</td>
            <td class="px-4 py-2">
            <span
                :class="[
                'px-2 py-1 text-xs font-medium rounded',
                order.status === 'Pending'
                    ? 'bg-yellow-100 text-yellow-800'
                    : order.status === 'Shipped'
                    ? 'bg-blue-100 text-blue-800'
                    : 'bg-green-100 text-green-800',
                ]"
            >
                {{ order.status }}
            </span>
            </td>
            <td class="px-4 py-2 font-semibold">{{ order.total }}</td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
    setup() {
        const recentOrders = ref([
            { id: 'A1001', customer: 'John Doe', date: '2025-07-01', status: 'Pending', total: '$125.00' },
            { id: 'A1002', customer: 'Jane Smith', date: '2025-07-01', status: 'Shipped', total: '$80.00' },
            { id: 'A1003', customer: 'Michael Lee', date: '2025-06-30', status: 'Delivered', total: '$220.00' },
            { id: 'A1004', customer: 'Emily Davis', date: '2025-06-29', status: 'Delivered', total: '$59.00' },
        ]);
        return { recentOrders };
    }
});
</script>