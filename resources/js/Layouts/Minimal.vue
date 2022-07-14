<template>
    <TwNav :canLogout="canLogout" />

    <main>
        <slot />
    </main>
</template>

<script>
import TwNav from "@/Components/TwNav.vue";

export default {
    name: "MinimalLayout",
    props: {
        canLogout: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        TwNav,
    },
};
</script>

<style lang="scss"></style>
