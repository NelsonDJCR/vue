<template>
  <app-layout>
    <template #header>
      <h1>Create</h1>


      <form >
          <input type="text" v-model="form.description">
          <input type="text" v-model="form.price">
          <button type="button" v-on:click="submit()" >Send</button>
      </form>

    </template>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
export default {
  components: {
    AppLayout,
    Link,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      form: {
        description: null,
        price: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route("products.store"), this.form);
    },
  },
};
</script>