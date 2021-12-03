<template>
    <app-layout>
        <template #header>
            <h1>Hello</h1>
        </template>

        <!-- <div>
       <Link :href="route('products.create')">Create</Link>
    </div> -->
        <div id="cargando" ref="entrada" style="display: block">Cargando</div>
        <div class="row">
            <table class="table table-responsive table-borderd table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>Nuevos Confirmados</th>
                        <th>Total Confirmados</th>
                        <th>Nuevos Fallecidos</th>
                        <th>Total Fallecidos</th>
                        <th>Nuevos Recuperados</th>
                        <th>Recuperados</th>
                    </tr>
                </thead>
                <tbody id="generar_datos"></tbody>
            </table>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            table: [],
            looo:document.getElementById('cargando')
        };
    },
    created() {
        console.log("loading");
        // const $tabla = document.getElementById("generar_datos");

        console.log(app.$refs.entrada);

        
        // const $cargando = document.getElementById("cargando");
        // $cargando.style.display = "block";
        // $tabla.parentElement.style.display = "none";



        axios.get("https://api.covid19api.com/summary")
            .then((datos) => {
                console.log("data");
            })
            .catch((error) => console.error("Error:", error))
            .finally(() => {
                console.log("loading ready");
                // $cargando.style.display = "none";
                // $tabla.parentElement.style.display = "block";
            });
    },
    components: {
        AppLayout,
        Link,
    },
    props: {
        products: Array,
    },
};
</script>
