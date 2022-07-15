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
        clickHandler(event) {
            if (this.data.click) {
                event.preventDefault();
                this.data.click({ ...window });
            }
        },
    },
};
</script>

<style lang="scss"></style>
