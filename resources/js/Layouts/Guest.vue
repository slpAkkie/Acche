<template>
    <MinimalLayout :can-logout="false">
        <slot />
    </MinimalLayout>
</template>

<script>
import MinimalLayout from "./Minimal.vue";

export default {
    name: "GuestLayout",
    components: {
        MinimalLayout,
    },
};
</script>

<style lang="scss"></style>
