<template>
  <app-layout>
    <template #header>
      <h1>Hello</h1>
    </template>

    <div>
       <Link :href="route('products.create')">Create</Link>
    </div>
    <table class="table-fixed">
      <thead>
        <tr>
          <th class="w-1">Description</th>
          <th class="w-1">Prices</th>
          <th class="w-1">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.description }}</td>
          <td>{{ product.price }}</td>
          <td>
            <Link :href="route('products.edit', product.id)" type="button"
              >Edit</Link
            >
            <Link method="delete" :href="route('products.destroy', product.id)" type="button"
              >Delete</Link
            >
          </td>
        </tr>
      </tbody>
    </table>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue"
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    AppLayout,
    Link,
  },
  props: {
    products: Array,
  }, 
  
};
</script>