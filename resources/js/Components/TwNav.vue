<template>
    <nav class="py-3 px-6 bg-blue-700 flex justify-between items-center">
        <h1 class="font-bold tracking-widest text-3xl">
            <a :href="route('home')" class="unstyled">Acche</a>
        </h1>

        <DropdownMenu
            v-if="canLogout"
            :text="nickname"
            :elements="dropdownElements"
            :circle="true"
        />
    </nav>
</template>

<script>
import TwButton from "@/Components/FormControls/TwButton.vue";
import DropdownMenu from "@/Components/Dropdown.vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    name: "TwNav",
    props: {
        canLogout: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        TwButton,
        DropdownMenu,
    },
    data: () => ({
        dropdownElements: [
            { type: "link", slot: "Мои чаты", href: route("home") },
            {
                type: "link",
                slot: "Настройки аккаунта",
                href: route("user.settings.create"),
            },
            { type: "separator" },
            {
                type: "link",
                slot: "Выход",
                href: route("login.destroy"),
                click: ({ axios, location, console }) => {
                    axios
                        .delete(route("login.destroy"))
                        .then((httpResponse) => {
                            location.href = route("login.create");
                        })
                        .catch((e) => {
                            console.log(e.response);
                        });
                },
            },
        ],
    }),
    computed: {
        nickname() {
            return usePage().props.value.auth.user.nickname;
        },
    },
};
</script>

<style lang="scss"></style>
