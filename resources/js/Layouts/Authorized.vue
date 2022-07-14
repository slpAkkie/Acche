<template>
    <MinimalLayout :can-logout="true">
        <slot />
    </MinimalLayout>
</template>

<script>
import MinimalLayout from "./Minimal.vue";

export default {
    name: "AuthorizedLayout",
    components: {
        MinimalLayout,
    },
};
</script>

<style lang="scss"></style>
