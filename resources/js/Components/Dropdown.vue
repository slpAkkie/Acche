<template>
    <Overlay v-if="show" />

    <div class="flex justify-center z-50" v-click-outside="clickedOutside">
        <div>
            <div class="dropdown relative">
                <TwButton
                    :circle="circle"
                    :hovered="show"
                    :value="text"
                    @click="show = !show"
                />
                <ul
                    class="list-none bg-zinc-800 min-w-max py-2 rounded absolute top-full right-0 mt-1 z-10"
                    :class="{ hidden: !show }"
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
import Overlay from "./Overlay.vue";

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
        Overlay,
    },
    data: () => ({
        show: false,
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
            this.show = false;
        },
    },
};
</script>

<style lang="scss"></style>
