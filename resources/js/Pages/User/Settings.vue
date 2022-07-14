<template>
    <Head title="User Settings" />

    <AuthorizedLayout>
        <!--  -->
    </AuthorizedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";

export default {
    name: "UserSettingsPage",
    components: {
        Head,
        AuthorizedLayout,
    },
};
</script>

<style lang="scss"></style>
