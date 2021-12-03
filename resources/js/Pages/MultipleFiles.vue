<template>
    <app-layout>
        <div class="multiple-uploader">
            <div
                v-show="$refs.uploader && $refs.uploader.dropActive"
                class="drop-active"
            >
                <h3>Deja caer aquí los archivos</h3>
            </div>
            <table class="table table-condensed" v-if="files.length">
                <tr>
                    <th>Nombre</th>
                    <th class="text-right">Acciones</th>
                </tr>
                <tr v-for="file in files" :key="file.id">
                    <td>{{ file.name }}</td>
                    <td class="text-right">
                        <button
                            class="btn btn-danger btn-sm"
                            @click.exact="$refs.uploader.remove(file)"
                        >
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            </table>
            <div class="alert alert-info text-center" v-else>
                Todavía no has subido ningún archivo
            </div>
            <div class="card">
                <div class="card-body">
                    <div
                        class="
                            text-center
                            justify-content-center
                            align-content-center
                            card-title
                        "
                    >
                        <div class="col-12 p-4">
                            <button
                                type="button"
                                class="btn brand-color btn-lg"
                            >
                                <label
                                    class="btn"
                                    style="
                                        background: #2ab27b;
                                        color: white !important;
                                        cursor: pointer;
                                    "
                                >
                                    <i class="fas fa-upload"></i> Seleccionar
                                    documentos
                                </label>
                            </button>
                        </div>
                    </div>

                    <hr />
                    <button @click="upload" class="btn btn-success">
                        Subir archivos
                    </button>
                </div>
            </div>
            <div class="upload">
                <div class="btn-group">
                    <file-upload
                        class="btn btn-primary dropdown-toggle"
                        style="display: none"
                        input-id="uploader"
                        :extensions="extensions"
                        :accept="mime_types"
                        :multiple="multiple"
                        :directory="directory"
                        :drop="true"
                        :drop-directory="dropDirectory"
                        v-model="files"
                        @input-filter="inputFilter"
                        ref="uploader"
                    >
                    </file-upload>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from "../Layouts/AppLayout.vue"
import { Link } from '@inertiajs/inertia-vue3'


// import FileUpload from "@vue-upload-component";
export default {
    name: "MultipleUploader",
    components: {
        FileUpload,
    },
    data() {
        return {
            files: [],
            documents: [],
            multiple: true,
            directory: false,
            drop: true,
            dropDirectory: true,
            name: "file",
            mime_types:
                "application/vnd.ms-excel,application/msword,application/pdf",
            extensions: "xls,doc,docx,pdf",
        };
    },
    methods: {
        async upload() {
            try {
                const filesForUpload = this.files;
                const formData = new FormData();
                if (filesForUpload.length) {
                    filesForUpload.map((file) => {
                        formData.append("files[]", file.file);
                    });
                    await window.axios.post("/upload", formData);
                }
            } catch (e) {
                console.log(e);
            }
        },
        inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                if (
                    /(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)
                ) {
                    return prevent();
                }
                if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                    return prevent();
                }
                if (/\.(gif|jpg|jpeg|tiff|png)$/i.test(newFile.name)) {
                    return prevent();
                }
            }
            if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
                newFile.blob = "";
                let URL = window.URL || window.webkitURL;
                if (URL && URL.createObjectURL) {
                    newFile.blob = URL.createObjectURL(newFile.file);
                }
            }
        },
    },
};
</script>
