<template>
    <Head title="Create new chat" />

    <AuthorizedLayout>
        <div class="bg-zinc-800 py-10 px-6">
            <form
                :action="route('chats.store')"
                method="post"
                @submit.prevent="requestCreate"
            >
                <h3 class="font-bold text-xl mb-5">Новый чат</h3>
                <div class="flex flex-col sm:flex-row gap-4">
                    <TwInput
                        v-model="formData.name"
                        name="name"
                        placeholder="Название..."
                        label="Название чата"
                        :max-length="32"
                    />
                    <TwInput
                        type="password"
                        name="password"
                        v-model="formData.password"
                        placeholder="Пароль..."
                        label="Пароль для входа в чат"
                        :max-length="32"
                    />
                </div>

                <div class="flex flex-col xs:flex-row mt-4">
                    <TwButton
                        class="w-1/2 pr-2"
                        type="submit"
                        value="Создать чат"
                    />
                </div>
            </form>
        </div>
    </AuthorizedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";
import TwInput from "@/Components/FormControls/TwInput.vue";
import TwButton from "@/Components/FormControls/TwButton.vue";

export default {
    name: "ChatCreatePage",
    components: {
        Head,
        AuthorizedLayout,
        TwInput,
        TwButton,
    },
    data: () => ({
        formData: {
            name: "",
            password: "",
        },
    }),
    methods: {
        requestCreate() {
            axios
                .post(route("chats.store"), this.formData)
                .then((httpResponse) => {
                    location.href = route("home");
                })
                .catch((e) => {
                    console.log(e.response);
                });
        },
    },
};
</script>

<style lang="scss"></style>
