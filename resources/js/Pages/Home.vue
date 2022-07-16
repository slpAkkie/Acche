<template>
    <Head title="Чаты" />

    <AuthorizedLayout>
        <div class="bg-zinc-800 py-10 px-6">
            <div v-if="chats">
                <h3 class="font-bold text-xl mb-5">Ваши чаты</h3>
                <div class="flex items-center gap-4 mb-5">
                    <TwInput
                        v-model="chatQuery"
                        placeholder="Найти чат..."
                        :max-length="32"
                    />
                    <TwButton value="Войти в..." @click="openChatJoin" />
                    <TwButton value="Новый" @click="openChatCreate" />
                </div>
                <div v-if="chats.length" class="flex flex-col gap-4">
                    <ChatCard
                        v-for="chat in chats"
                        :key="chat.id"
                        :chat="chat"
                    />
                    <div v-if="hasMore" class="flex justify-center">
                        <TwButton value="Еще..." @click="searchChats" />
                    </div>
                </div>
                <p v-else class="text-zinc-300">Ничего не нашли...</p>
            </div>
            <p v-else class="text-zinc-300">Загружаем ваши чаты...</p>
        </div>
    </AuthorizedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";
import TwInput from "@/Components/FormControls/TwInput.vue";
import TwButton from "@/Components/FormControls/TwButton.vue";
import ChatCard from "@/Components/Chat/ChatCard.vue";

export default {
    name: "HomePage",
    components: {
        Head,
        AuthorizedLayout,
        TwInput,
        TwButton,
        ChatCard,
    },
    data: () => ({
        chatQuery: "",
        apiResponse: null,

        deboundsTimeout: null,
    }),
    computed: {
        chats() {
            return this.apiResponse ? this.apiResponse.data : [];
        },
        hasMore() {
            return !!this.apiResponse.links?.next;
        },
        loadLink() {
            if (!this.apiResponse)
                return `${route("chats.index")}?query=${this.chatQuery}`;

            return this.apiResponse.links?.next
                ? `${this.apiResponse.links?.next}&query=${this.chatQuery}`
                : null;
        },
    },
    watch: {
        chatQuery(val) {
            if (this.deboundsTimeout) clearTimeout(this.deboundsTimeout);

            this.deboundsTimeout = setTimeout(() => {
                this.apiResponse = null;

                this.searchChats();
            }, 250);
        },
    },
    methods: {
        openChatJoin() {
            location.href = route("chats.join");
        },
        openChatCreate() {
            location.href = route("chats.create");
        },
        searchChats() {
            return this.loadLink === null
                ? null
                : axios
                      .get(this.loadLink)
                      .then((httpResponse) => {
                          if (!this.apiResponse)
                              return (this.apiResponse = httpResponse.data);

                          httpResponse.data.data.unshift(
                              ...this.apiResponse.data
                          );
                          this.apiResponse = httpResponse.data;
                      })
                      .catch((e) => {
                          console.log(e.response);
                      });
        },
    },
    mounted() {
        this.searchChats();
    },
};
</script>

<style lang="scss"></style>
