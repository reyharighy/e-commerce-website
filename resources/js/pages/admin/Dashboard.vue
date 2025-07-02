<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue'
    import Card from '@/components/ui/card/Card.vue'
    import StatCard from '@/components/admin/StatCard.vue'
    import RecentOrders from '@/components/admin/RecentOrders.vue'

    import { ref } from 'vue'
    import DashboardChart from '@/components/admin/DashboardChart.vue'
import OrangeButton from '@/components/button/OrangeButton.vue'

    // Data reaktif untuk chart penjualan
    const salesChartTitle = ref('Sales Performance')
    const salesChartData = ref({
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    values: [1200, 2000, 1500, 3000, 2500, 3200],
    })

    // Data reaktif untuk chart pendapatan (contoh kedua)
    const revenueChartTitle = ref('Quarterly Revenue')
    const revenueChartData = ref({
    labels: ['Q1', 'Q2', 'Q3', 'Q4'],
    values: [22000, 19000, 31000, 28500],
    })

    // Fungsi untuk memperbarui data dan menunjukkan bahwa chart akan bereaksi
    const updateData = () => {
    salesChartData.value = {
        labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        values: [2100, 2400, 3500, 2900, 4100, 5000],
    }
    salesChartTitle.value = 'Sales Performance (H2)'
    }
</script>

<template>
    <AppLayout title="Dashboard">
        <section class="px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <!-- Header Title -->

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <StatCard title="Total Users" value="1,234" icon="users" color="blue" />
            <StatCard title="Orders Today" value="87" icon="shopping-cart" color="green" />
            <StatCard title="Revenue" value="$12,540" icon="dollar-sign" color="yellow" />
        </div>

        <div class="p-8 min-h-screen">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <DashboardChart :title="salesChartTitle" :chartData="salesChartData" />

        <div class="mt-8">
        <DashboardChart :title="revenueChartTitle" :chartData="revenueChartData" />
        </div>

        <OrangeButton @click="updateData" class="mt-6 px-4 py-2">
        Load New Sales Data
        </OrangeButton>
    </div>

        <!-- Recent Orders Table -->
        <Card class="overflow-hidden">
            <div class="px-6 py-4">
            <h2 class="text-lg font-semibold mb-4">Recent Orders</h2>
            <RecentOrders />
            </div>
        </Card>
        </section>
    </AppLayout>
</template>