<template>
  <app-layout>
    <div>
      <!-- @submit.prevent="submit" -->
      <form >
        <input type="text" v-model="form.name" />
        <input type="file" @input="form.avatar = $event.target.files[0]" />
        <button type="submit" v-on:click="submit()">Submit</button>
      </form>     
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  components: {
    AppLayout,
  },
  setup() {
    const form = useForm({
      name: null,
      avatar: null,
    });
    function submit() {
      form.post("/save-file");      
    }
    return { form, submit };
  },


};
</script>