<template>
    <app-layout>
        <template #header>
            <h1>Hello</h1>
        </template>
        <form enctype="multipart/form-data">
            <input @change="getImage"  type="file" />
        </form>


            <img width="200" height="200" :src="imgPage">
            <button @click="deleteImage">x</button>


    </app-layout>
</template>

<script>
export default {
    data() {
        return {
            miniature: "",
            form: {
                img: "",
            },
        };
    },
    methods: {
        getImage(e) {
            // let file = e.target.files[0];
            // this.form.img = file;
            this.loadImg(file);
        },
        loadImg(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.miniature = e.target.result
            };
            reader.readAsDataURL(file)
        },
        deleteImage(){
            this.miniature = ""
        }
    },
    computed:{
        imgPage(){
            return this.miniature
        }
    }
};
</script>
