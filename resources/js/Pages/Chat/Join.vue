<template>
    <Head title="Войти в чат" />

    <AuthorizedLayout>
        <div class="bg-zinc-800 py-10 px-6">
            <form
                :action="route('chats.store')"
                method="post"
                @submit.prevent="requestCreate"
            >
                <h3 class="font-bold text-xl mb-5">Войти в существующий чат</h3>
                <div class="flex flex-col sm:flex-row gap-4">
                    <TwInput
                        v-model="formData.id"
                        name="id"
                        placeholder="ID чата..."
                        label="ID"
                        :max-length="32"
                        :wrong-fields="wrongFields"
                    />
                    <TwInput
                        type="password"
                        name="password"
                        v-model="formData.password"
                        placeholder="Пароль..."
                        label="Пароль для входа в чат"
                        :max-length="32"
                        :wrong-fields="wrongFields"
                    />
                </div>

                <div class="flex flex-col xs:flex-row mt-4">
                    <TwButton
                        class="w-1/2 pr-2"
                        type="submit"
                        value="Войти в чат"
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
    name: "ChatJoinPage",
    components: {
        Head,
        AuthorizedLayout,
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
        requestCreate() {
            this.wrongFields = {};

            axios
                .post(route("chats.join"), this.formData)
                .then((httpResponse) => {
                    location.href = route(
                        "chats.show",
                        httpResponse.data.data.id
                    );
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
