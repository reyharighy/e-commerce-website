<script setup lang="ts">
const categories = [
  {
    title: 'Flash Sale Today',
    products: [
      {
        id: 1,
        name: 'Bose Sport Earbuds - Wireless',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Bose',
      },
      {
        id: 2,
        name: 'Simple Mobile 4G LTE Prepaid Smartphone',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Phone',
      },
      {
        id: 3,
        name: '4K UHD LED Smart TV with Chromecast Built-in',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=TV',
      },
    ],
  },
  {
    title: 'Best Sellers',
    products: [
      {
        id: 4,
        name: 'Samsung Galaxy S21 5G',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=S21',
      },
      {
        id: 5,
        name: 'Simple Mobile 5G Gaming Phone',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Phone',
      },
      {
        id: 6,
        name: 'Sony DSCHX8 Point & Shoot Camera',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Camera',
      },
    ],
  },
  {
    title: 'Top Rated',
    products: [
      {
        id: 7,
        name: 'Washing Machine Model 18NMF',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Washer',
      },
      {
        id: 8,
        name: 'Sony DSCHX8 Zoom Camera',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Zoom',
      },
      {
        id: 9,
        name: 'Dell Optiplex 7000 Monitor',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Dell',
      },
    ],
  },
  {
    title: 'New Arrival',
    products: [
      {
        id: 10,
        name: 'TOZO T6 Wireless Earbuds',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=TOZO',
      },
      {
        id: 11,
        name: 'JBL FLIP 4 Bluetooth Speaker',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=JBL',
      },
      {
        id: 12,
        name: 'Wyze Cam Pan 1080p',
        price: '$1,500',
        image: 'https://via.placeholder.com/60?text=Wyze',
      },
    ],
  },
]
</script>

<template>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div
      v-for="(category, index) in categories"
      :key="index"
      class="space-y-4"
    >
      <h3 class="font-semibold text-gray-800 uppercase text-sm">
        {{ category.title }}
      </h3>
      <div
        v-for="product in category.products"
        :key="product.id"
        class="flex items-center gap-4 p-3 bg-white rounded shadow-sm hover:shadow transition"
      >
        <img
          :src="product.image"
          alt="product"
          class="w-12 h-12 object-contain"
        />
        <div>
          <p class="text-sm text-gray-700 truncate">{{ product.name }}</p>
          <p class="text-sm font-semibold text-blue-600">{{ product.price }}</p>
        </div>
      </div>
    </div>
  </div>
</template>


