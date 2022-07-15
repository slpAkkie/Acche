<template>
    <!-- TODO: Set title according to the chat name or id -->
    <Head title="Чат #0000000" />

    <AuthorizedLayout>
        <!--  -->
    </AuthorizedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";

export default {
    name: "ChatShowPage",
    components: {
        Head,
        AuthorizedLayout,
    },
};
</script>

<style lang="scss"></style>
