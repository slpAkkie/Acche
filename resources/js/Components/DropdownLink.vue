<template>
    <li>
        <Link
            class="block px-5 py-0.5"
            :href="data.href"
            @click="clickHandler"
            >{{ data.slot }}</Link
        >
    </li>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    name: "DropdownLink",
    props: {
        data: {
            type: Object,
            default: () => ({}),
        },
    },
    components: {
        Link,
    },
    methods: {
        clickHandler() {
            if (this.data.click) this.data.click({ ...window });
        },
    },
};
</script>

<style lang="scss"></style>
