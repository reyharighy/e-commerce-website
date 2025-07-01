<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

interface Order {
  id: string;
  status: 'COMPLETED' | 'IN PROGRESS' | 'CANCELED';
  date: string;
  total: string;
}

const orders = ref<Order[]>([
  { id: "#94549761", status: "IN PROGRESS", date: "Dec 30, 2019 07:52", total: "$80 (5 Products)" },
  { id: "#71867167", status: "COMPLETED", date: "Dec 7, 2019 23:26", total: "$70 (4 Products)" },
  { id: "#95243632", status: "CANCELED", date: "Dec 7, 2019 23:26", total: "$2,300 (2 Products)" },
  { id: "#71867167", status: "COMPLETED", date: "Feb 6, 2019 19:28", total: "$260 (1 Products)" },
  { id: "#51746385", status: "COMPLETED", date: "Dec 30, 2019 07:52", total: "$360 (2 Products)" }
]);

const pages = ref([1, 2, 3, 4, 5, 6]);
const currentPage = ref(1);

function statusClass(status: string) {
  if (status === 'COMPLETED') return 'text-green-600 font-medium';
  if (status === 'CANCELED') return 'text-red-600 font-medium';
  if (status === 'IN PROGRESS') return 'text-yellow-600 font-medium';
  return '';
}

function changePage(page: number) {
  currentPage.value = page;
}

function prevPage() {
  if (currentPage.value > 1) currentPage.value--;
}

function nextPage() {
  if (currentPage.value < pages.value.length) currentPage.value++;
}
</script>

<template>
  <AppLayout>
    <div class="order-history-container">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
        Order History
      </h2>
      <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-md overflow-hidden">
        <thead class="bg-gray-50 dark:bg-gray-800">
          <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ORDER ID</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">STATUS</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">DATE</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">TOTAL</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ACTION</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="order in orders" :key="order.id">
            <td class="px-4 py-2">{{ order.id }}</td>
            <td class="px-4 py-2">
              <span :class="statusClass(order.status)">
                {{ order.status }}
              </span>
            </td>
            <td class="px-4 py-2">{{ order.date }}</td>
            <td class="px-4 py-2">{{ order.total }}</td>
            <td class="px-4 py-2">
              <button class="text-indigo-600 hover:underline font-medium">
                View Details →
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="flex justify-center items-center mt-8 space-x-2">
        <!-- Tombol panah kiri -->
        <button
          @click="prevPage"
          class="w-9 h-9 flex items-center justify-center border border-orange-500 rounded-full text-orange-500 hover:bg-orange-100 disabled:opacity-50 disabled:cursor-not-allowed"
          :disabled="currentPage === 1"
        >
          ←
        </button>

        <!-- Nomor halaman -->
        <button
          v-for="page in pages"
          :key="page"
          @click="changePage(page)"
          class="w-9 h-9 flex items-center justify-center border rounded-full text-sm font-medium"
          :class="[
            page === currentPage
              ? 'bg-orange-500 text-white border-orange-500'
              : 'border-gray-300 text-gray-700 hover:bg-gray-100'
          ]"
        >
          {{ page < 10 ? `0${page}` : page }}
        </button>

        <!-- Tombol panah kanan -->
        <button
          @click="nextPage"
          class="w-9 h-9 flex items-center justify-center border border-orange-500 rounded-full text-orange-500 hover:bg-orange-100 disabled:opacity-50 disabled:cursor-not-allowed"
          :disabled="currentPage === pages.length"
        >
          →
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.order-history-container {
  padding: 24px;
}
</style>
