<template>
    <app-layout>
        <div>
            <h1>Pagination</h1>
        </div>
        <div class="container flex justify-center mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="border-b border-gray-200 shadow">
                        <table style="position: relative">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        id
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Name
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        specie
                                    </th>
                                </tr>
                            </thead>

                            <tbody
                                :class="['bg-white', loader ? 'loader' : '']"
                            >
                                <tr class="text-center" v-if="loader">
                                    <td></td>
                                    <td>Cargando..</td>
                                    <td></td>
                                </tr>
                                <tr
                                    class="whitespace-nowrap"
                                    v-for="i in users"
                                    :key="i.id"
                                >
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ i.id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ i.name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ i.email }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <!-- Paginator -->
        <div class="container">
            <div
                class="
                    bg-white
                    px-4
                    py-3
                    flex
                    items-center
                    justify-between
                    border-t border-gray-200
                    sm:px-6
                "
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <a
                        @click="changePage(link_next)"
                        class="
                            relative
                            inline-flex
                            items-center
                            px-4
                            py-2
                            border border-gray-300
                            text-sm
                            font-medium
                            rounded-md
                            text-gray-700
                            bg-white
                            hover:bg-gray-50
                        "
                    >
                        Anterior
                    </a>
                    <a
                        @click="changePage(link_prev)"
                        class="
                            ml-3
                            relative
                            inline-flex
                            items-center
                            px-4
                            py-2
                            border border-gray-300
                            text-sm
                            font-medium
                            rounded-md
                            text-gray-700
                            bg-white
                            hover:bg-gray-50
                        "
                    >
                        Siguiente
                    </a>
                </div>
                <div
                    class="
                        hidden
                        sm:flex-1 sm:flex sm:items-center sm:justify-between
                    "
                >
                    <div>
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">{{ links.fromc }}</span>
                            to
                            <span class="font-medium">{{ links.to }}</span>
                            de
                            <span class="font-medium">{{ links.total }}</span>
                            Resultados
                        </p>
                    </div>
                    <div>
                        <nav
                            class="
                                relative
                                z-0
                                inline-flex
                                rounded-md
                                shadow-sm
                                -space-x-px
                            "
                            aria-label="Pagination"
                        >
                            <!-- Arrow last -->
                            <a
                                @click="changePage(link_next)"
                                class="
                                    relative
                                    inline-flex
                                    items-center
                                    px-2
                                    py-2
                                    rounded-l-md
                                    border border-gray-300
                                    bg-white
                                    text-sm
                                    font-medium
                                    text-gray-500
                                    hover:bg-gray-50
                                "
                            >
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                            <!-- Links Numbers -->
                            <div v-for="link in links.links" :key="link.id">
                                <a
                                    @click="changePage(link.url)"
                                    :class="[
                                        'border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                        link.active ? 'bg-black' : 'bg-white',
                                    ]"
                                >
                                    <span v-if="link.label.length == 16"
                                        >Anterior</span
                                    >
                                    <span v-else-if="link.label.length == 12"
                                        >Siguiente</span
                                    >
                                    <span v-else>{{ link.label }}</span>
                                </a>
                            </div>
                            <!-- Arrow Next -->
                            <a
                                @click="changePage(link_prev)"
                                class="
                                    relative
                                    inline-flex
                                    items-center
                                    px-2
                                    py-2
                                    rounded-r-md
                                    border border-gray-300
                                    bg-white
                                    text-sm
                                    font-medium
                                    text-gray-500
                                    hover:bg-gray-50
                                "
                            >
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
// import AppLayout from "../Layouts/AppLayout.vue";
export default {
    components: {
        // AppLayout,
    },
    data() {
        return {
            users: [],
            links: {},
            link_prev: "",
            link_next: "",
            loader: true,
        };
    },
    created() {
        this.getList("/dataUsers");
    },
    methods: {
        getList(url = null) {
            if (url != null) {
                this.loader = true;
                axios
                    .get(url)
                    .then((e) => {
                        this.loader = false;
                        this.users = e.data.data;
                        this.links = e.data;
                        this.link_prev = e.data.next_page_url;
                        this.link_next = e.data.prev_page_url;
                        console.log(this.link_prev);

                        console.log();
                    });
            }
        },
        changePage(url) {
            this.getList(url);
        },
    },
};
</script>

<style>
.loader::before {
    text-align: center;
    content: url(https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif);
    background: rgba(0, 0, 0, 0.541);
    position: absolute;
    width: 100%;
    height: 95%;
}
</style>
