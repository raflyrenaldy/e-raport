<template>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary" v-if="message">
                {{ message }}
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>Download e-Raport</h4></div>

                <div class="card-body">


                        <div class="form-group text-center">
                            <button @click="download()" class="btn btn-lg btn-round btn-primary">
                                Download
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['path'],
        data: function () {
            return {
                roles: '',
                loading: false,
            }
        },
        mounted() {

        },
        methods: {
            download() {
                window.open(this.path, "_blank");
            }
        }
    };
</script>
