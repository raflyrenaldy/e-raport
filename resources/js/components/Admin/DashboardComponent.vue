<template>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary" v-if="message">
                {{ message }}
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                roles: '',
                loading: false,
            }
        },
        mounted() {
        },
        methods: {

        }
    };
</script>
