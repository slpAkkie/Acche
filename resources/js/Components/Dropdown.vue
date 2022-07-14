<template>
    <div class="flex justify-center" v-click-outside="clickedOutside">
        <div>
            <div class="dropdown relative">
                <TwButton
                    :circle="circle"
                    :value="text"
                    @click="showDropdown = !showDropdown"
                />
                <ul
                    class="list-none bg-zinc-800 min-w-max py-2 rounded absolute top-full right-0 mt-1 z-50"
                    :class="{ hidden: !showDropdown }"
                >
                    <component
                        v-for="(el, i) in elements"
                        :key="i"
                        :is="getComponent(el.type)"
                        :data="el"
                    ></component>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import DropdownLink from "./DropdownLink.vue";
import DropdownSeparator from "./DropdownSeparator.vue";
import TwButton from "./FormControls/TwButton.vue";

export default {
    name: "DropdownMenu",
    props: {
        text: {
            type: String,
        },
        elements: {
            type: Array,
            default: [],
        },
        circle: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        TwButton,
    },
    data: () => ({
        showDropdown: false,
    }),
    methods: {
        getComponent(elType) {
            switch (elType) {
                case "separator":
                    return DropdownSeparator;
                case "link":
                    return DropdownLink;
                default:
                    return "div";
            }
        },
        clickedOutside() {
            this.showDropdown = false;
        },
    },
};
</script>

<style lang="scss"></style>
