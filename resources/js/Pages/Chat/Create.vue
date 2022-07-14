<template>
    <Head title="Create new chat" />

    <AuthorizedLayout>
        <!--  -->
    </AuthorizedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";

export default {
    name: "ChatCreatePage",
    components: {
        Head,
        AuthorizedLayout,
    },
};
</script>

<style lang="scss"></style>
