<template>
    <TwNav />

    <main>
        <slot />
    </main>
</template>

<script>
import TwNav from "@/Components/TwNav.vue";

export default {
    name: "MinimalLayout",
    components: {
        TwNav,
    },
};
</script>

<style lang="scss"></style>
