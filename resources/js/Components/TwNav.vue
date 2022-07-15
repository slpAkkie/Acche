<template>
    <nav class="py-3 px-6 bg-blue-700 flex justify-between items-center">
        <h1 class="font-bold tracking-widest text-3xl">
            <Link :href="route('home')" class="unstyled">Acche</Link>
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
import { usePage, Link } from "@inertiajs/inertia-vue3";

export default {
    name: "TwNav",
    props: {
        canLogout: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        Link,
        TwButton,
        DropdownMenu,
    },
    data: () => ({
        dropdownElements: [
            { type: "link", slot: "Мои чаты", href: route("home") },
            {
                type: "link",
                slot: "Настройки аккаунта",
                href: route("user.settings.index"),
            },
            { type: "separator" },
            {
                type: "link",
                slot: "Выход",
                href: "#",
                click: ({ axios, location, console }) => {
                    axios
                        .delete(route("logout"))
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
