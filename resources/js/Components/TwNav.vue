<template>
    <nav class="py-3 px-6 bg-blue-700 flex justify-between items-center">
        <h1 class="font-bold tracking-widest text-3xl">
            <a :href="route('home')" class="unstyled">Acche</a>
        </h1>

        <TwButton value="Выйти" @click="requestLogout" />
    </nav>
</template>

<script>
import TwButton from "@/Components/FormControls/TwButton.vue";
import axios from "axios";

export default {
    name: "TwNav",
    components: {
        TwButton,
    },
    methods: {
        requestLogout() {
            axios
                .delete(route("login.destroy"))
                .then((httpResponse) => {
                    location.href = route("home");
                })
                .catch((httpResponse) => {
                    console.log(httpResponse.response);
                });
        },
    },
};
</script>

<style lang="scss"></style>
