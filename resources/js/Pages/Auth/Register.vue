<template>
    <Head title="Register" />

    <MinimalLayout>
        <div class="container max-w-xl mx-auto">
            <form
                :action="route('register.store')"
                method="post"
                class="bg-zinc-800 py-10 px-6"
                @submit.prevent="requestRegister"
            >
                <h1 class="font-bold text-2xl text-center mb-5">
                    Регистрация новго аккаунта
                </h1>
                <div class="flex flex-col gap-4">
                    <TwInput
                        name="nickname"
                        placeholder="Придумайте никнейм..."
                        label="Никнейм"
                        sub-label="Всегда ваш"
                        v-model="formData.nickname"
                        :max-length="32"
                        :wrong-fields="wrongFields"
                    />
                    <TwInput
                        name="name"
                        placeholder="Ваше имя..."
                        label="Имя"
                        sub-label="Чтобы другие понимали кто ты"
                        v-model="formData.name"
                        :max-length="64"
                        :wrong-fields="wrongFields"
                    />
                    <TwInput
                        type="email"
                        name="email"
                        placeholder="Ваша почта..."
                        label="Email"
                        sub-label="Вдруг забудете пароль"
                        v-model="formData.email"
                        :max-length="64"
                        :wrong-fields="wrongFields"
                    />
                    <div class="flex flex-col sm:flex-row gap-4">
                        <TwInput
                            type="password"
                            name="password"
                            placeholder="Пароль..."
                            label="Пароль"
                            v-model="formData.password"
                            :max-length="32"
                            :wrong-fields="wrongFields"
                        />
                        <TwInput
                            type="password"
                            name="password_confirmation"
                            placeholder="Повтор пароля..."
                            label="Повторите пароль"
                            v-model="formData.password_confirmation"
                            :max-length="32"
                            :wrong-fields="wrongFields"
                        />
                    </div>

                    <div class="w-full flex flex-col xs:flex-row gap-4">
                        <TwButton
                            class="w-1/2 pr-2"
                            type="submit"
                            value="Зарегистрироваться"
                        />
                    </div>
                    <p class="text-zinc-400 mt-5">
                        Если у вас есть аккаунт, можете
                        <Link :href="route('login.create')" class="stilyzed"
                            >войти</Link
                        >
                        в него
                    </p>
                </div>
            </form>
        </div>
    </MinimalLayout>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MinimalLayout from "@/Layouts/Minimal.vue";
import TwInput from "@/Components/FormControls/TwInput.vue";
import TwButton from "@/Components/FormControls/TwButton.vue";
import axios from "axios";

export default {
    name: "RegisterPage",
    components: {
        Head,
        Link,
        MinimalLayout,
        TwInput,
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
        requestRegister() {
            this.wrongFields = {};

            axios
                .post(route("register.store"), this.formData)
                .then((httpResponse) => {
                    location.href = route("home");
                })
                .catch((httpResponse) => {
                    const errorResponse = httpResponse.response.data.error;
                    this.wrongFields = errorResponse.errors;
                });
        },
    },
};
</script>

<style lang="scss"></style>
