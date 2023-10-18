<template>
    <div></div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    props: ["options"],
    watch: {
        options: {
            handler(newOptions) {
                this.showAlert(newOptions);
            },
            deep: true,
        },
    },
    methods: {
        showAlert(options) {
            Swal.fire(options);
        },
    },
};
</script>
