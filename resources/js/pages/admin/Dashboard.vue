<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col lg:flex-row">
    
        <div class="flex-1 bg-gray-100 min-h-screen w-full overflow-x-hidden">
            <main class="p-4 sm:p-6 space-y-8 max-w-screen-xl mx-auto">
            <!-- Greeting -->
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome back, Admin!</h1>
                <p class="text-gray-600">Here's what's happening today.</p>
            </div>

            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <StatCard title="Total Users" value="1,234" />
                <StatCard title="Orders Today" value="87" />
                <StatCard title="Revenue" value="$12,540" />
            </div>

            <!-- Order History Preview -->
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md">
                <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Recent Orders</h2>
                <button class="text-blue-600 text-sm hover:underline">View all</button>
                </div>

                <RecentOrders/>
            </div>
            </main>
        </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
    import StatCard from '@/components/admin/StatCard.vue';
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head } from '@inertiajs/vue3'
    import { type BreadcrumbItem } from '@/types'
    import RecentOrders from '@/components/admin/RecentOrders.vue';

    const breadcrumbs: BreadcrumbItem[] = [
            {
                title: 'Dashboard',
                href: '/dashboard',
            },
    ];
</script>
