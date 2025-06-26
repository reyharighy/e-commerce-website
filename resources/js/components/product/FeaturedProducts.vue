<template>
  <!-- Products Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div
          v-for="product in products"
          :key="product.id"
          class="border rounded-lg overflow-hidden bg-white hover:shadow-md"
        >
          <img :src="product.image" alt="Product Image" class="w-full h-48 object-cover" />

          <div class="p-4">
            <div class="flex justify-between items-center mb-2">
              <h3 class="font-semibold text-gray-800 text-lg">{{ product.name }}</h3>
              <span
                class="text-xs font-bold text-white px-2 py-1 rounded"
                :class="{
                  'bg-red-500': product.tag === 'HOT',
                  'bg-blue-500': product.tag === 'BEST DEAL',
                  'bg-green-500': product.tag === 'SALE'
                }"
              >
                {{ product.tag }}
              </span>
            </div>
            <div class="text-xl font-bold text-orange-600">{{ product.price }}</div>
            <button
              class="mt-4 w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded"
            >
              Add to Cart
            </button>
          </div>
        </div>
      </div>
</template>

<script setup lang="ts">
const products = [
  {
    id: 1,
    name: 'Samsung Galaxy S21 5G',
    price: '$230',
    image: 'https://via.placeholder.com/200x200?text=Product',
    tag: 'HOT',
  },
  {
    id: 2,
    name: 'Amazon Basics HDMI Cable',
    price: '$30',
    image: 'https://via.placeholder.com/200x200?text=HDMI+Cable',
    tag: 'BEST DEAL',
  },
  {
    id: 3,
    name: 'Wired Gamepad',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
  {
    id: 4,
    name: 'Anjay',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
  {
    id: 5,
    name: 'Anjay',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
  {
    id: 6,
    name: 'Anjay',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
  {
    id: 7,
    name: 'Anjay',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
  {
    id: 8,
    name: 'Anjay',
    price: '$15',
    image: 'https://via.placeholder.com/200x200?text=Gamepad',
    tag: 'SALE',
  },
]
</script>

<style scoped>
/* Tambahan kecil jika ingin responsif di mobile */
</style>
