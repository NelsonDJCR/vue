<template>
    <app-layout>
        <div>
            <h1>Save Files</h1>
            <input type="file" @change="selectFile" />
            <br />
            <input
                type="submit"
                class="btn"
                @click="submit_form"
                :value="form_submitting ? 'Saving comment...' : 'Save comment'"
            />
        </div>
    </app-layout>
</template>
<style scoped>
.btn {
    width: 200px;
    height: 50px;
    background: aqua;
    color: black;
}
</style>
<script>
export default {
    data() {
        return {
            form: {
                file: null,
            },
            form_submitting: false,
        };
    },
    methods: {
        selectFile(event) {
            this.form.file = event.target.files[0];
        },
        submit_form() {
            this.form_submitting = true;
            let form = new FormData();
            for (let key in this.form) {
                form.append(key, this.form[key]);
            }
            axios
                .post("/save-file", form)
                .then((response) => {
                    if ((response.response = 200)) {
                        this.form_submitting = false;
                    }
                })
                .catch((error) => {
                    this.form_submitting = false;
                });
        },
    },
};
</script>
