<template>
  <app-layout>
    <template #header>
      <h1>Create</h1>
      <form>
        <input type="text" v-model="form.description" />
        <input type="text" v-model="form.price" />
        <button type="button" v-on:click="update()">Send</button>
      </form>
    </template>
  </app-layout> 
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    AppLayout,
    Link,
  },
  props: ["data"],
  data() {
    return {
      form: {
        description: this.$props.data.description,
        price: this.$props.data.price,
      },
    };
  },

  methods: {
    update() {
      this.$inertia.put(route("products.update", this.$props.data.id), this.form);
    },
  },
};
</script>