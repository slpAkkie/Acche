<template>
    <Head title="Login" />

    <GuestLayout>
        <div class="container max-w-xl mx-auto">
            <form
                :action="route('login.store')"
                method="post"
                class="bg-zinc-800 py-10 px-6"
                @submit.prevent="requestLogin"
            >
                <h1 class="font-bold text-2xl text-center mb-5">Вход</h1>
                <div class="flex flex-col gap-4">
                    <TwInput
                        name="nickname"
                        placeholder="Никнейм"
                        label="Никнейм"
                        v-model="formData.nickname"
                        :max-length="32"
                        :wrong-fields="wrongFields"
                    />
                    <TwInput
                        type="password"
                        name="password"
                        placeholder="Пароль"
                        label="Пароль"
                        v-model="formData.password"
                        :max-length="32"
                        :wrong-fields="wrongFields"
                    />

                    <TwCheckbox
                        v-model="formData.remember_me"
                        label="Запомнить меня"
                        name="remember_me"
                    />

                    <TwButton
                        class="w-1/2 pr-2"
                        type="submit"
                        value="Войти в аккаунт"
                    />
                    <p class="text-zinc-400 mt-5">
                        Если у вас нет аккаунта, можете
                        <Link :href="route('register.create')" class="stilyzed"
                            >создать</Link
                        >
                        новый
                    </p>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import GuestLayout from "@/Layouts/Guest.vue";
import TwInput from "@/Components/FormControls/TwInput.vue";
import TwButton from "@/Components/FormControls/TwButton.vue";
import TwCheckbox from "@/Components/FormControls/TwCheckbox.vue";

export default {
    name: "LoginPage",
    components: {
        Head,
        Link,
        GuestLayout,
        TwInput,
        TwCheckbox,
        TwButton,
    },
    data: () => ({
        formData: {
            //
        },
        wrongFields: {
            //
        },
    }),
    methods: {
        requestLogin() {
            this.wrongFields = {};

            axios
                .post(route("login.store"), this.formData)
                .then((httpResponse) => {
                    location.href = route("home");
                })
                .catch((e) => {
                    const errorResponse = e.response.data.error;
                    this.wrongFields = errorResponse.errors;
                });
        },
    },
};
</script>

<style lang="scss"></style>
