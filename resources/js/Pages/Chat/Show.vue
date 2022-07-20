<template>
    <!-- TODO: Set title according to the chat name or id -->

    <Head title="Чат #0000000" />

    <AuthorizedLayout>
        <div class="bg-zinc-800">
            <div class="-mb-px pt-6 px-6">
                <div class="flex flex-col gap-4 border border-zinc-600 rounded-t p-4 h-[calc(100vh-64px-116px-1.5rem)] sm:h-[calc(100vh-64px-68px-1.5rem)] overflow-y-auto"
                    ref="messageContainer" @scroll="handleScroll">
                    <template v-if="messagesLoaded">
                        <MessageCard v-for="(data, i) in messages" :key="data.id" :data="data" :index="i"
                            @mounted="scrollDown" />
                    </template>
                    <p v-else>Загрузка...</p>
                    <div id="chat-bottom" ref="chatBottom"></div>
                </div>
            </div>
            <div class="h-px bg-zinc-600"></div>
            <form class="flex flex-col sm:flex-row items-center gap-4 py-4 px-6"
                :action="route('chats.messages.store', id)" method="post" @submit.prevent="requestMessage">
                <TwInput name="content" placeholder="Сообщение..." :autofocus="true" v-model="formData.content" />
                <TwButton class="w-full sm:w-auto" type="submit" value="Отправить" />
            </form>
        </div>
    </AuthorizedLayout>
</template>

<script>
import { Head, usePage } from "@inertiajs/inertia-vue3";
import AuthorizedLayout from "@/Layouts/Authorized.vue";
import TwInput from "@/Components/FormControls/TwInput.vue";
import TwButton from "@/Components/FormControls/TwButton.vue";
import MessageCard from '@/Components/Chat/Message/MessageCard.vue';

export default {
    name: "ChatShowPage",
    components: {
        Head,
        AuthorizedLayout,
        MessageCard,
        TwInput,
        TwButton,
    },
    data: () => ({
        maybeScrolledDown: true,
        formData: {
            content: "",
        },
        apiResponse: null,
        messagesLoading: false,
    }),
    computed: {
        loadMessagesLink() {
            if (!this.apiResponse)
                return route("chats.messages.index", this.id);

            return this.apiResponse.links?.next;
        },
        id() {
            return usePage().props.value.chat.id;
        },
        messagesLoaded() {
            return this.apiResponse !== null;
        },
        messages() {
            return this.apiResponse ? this.apiResponse.data : [];
        },
    },
    methods: {
        setMessageCheckInterval() {
            this.messageCheckInterval = setInterval(this.checkNewMessages, 2500);
        },
        removeMessageCheckInterval() {
            clearInterval(this.messageCheckInterval);
        },
        restartMessageCheckInterval() {
            this.removeMessageCheckInterval();
            this.setMessageCheckInterval();
        },
        requestMessage() {
            this.removeMessageCheckInterval();

            axios
                .post(route("chats.messages.store", this.id), this.formData)
                .then((httpResponse) => {
                    this.checkNewMessages();
                    this.formData = {
                        //
                    }
                })
                .catch((e) => {
                    console.log(e);
                })
                .finally(() => this.setMessageCheckInterval());
        },
        loadMessages() {
            if (!this.loadMessagesLink || this.messagesLoading) return;

            this.messagesLoading = true;
            axios
                .get(this.loadMessagesLink)
                .then((httpResponse) => {
                    if (!this.apiResponse) {
                        httpResponse.data.data.reverse();
                        return (this.apiResponse = httpResponse.data);
                    }

                    httpResponse.data.data
                        .reverse()
                        .push(...this.apiResponse.data);
                    this.apiResponse = httpResponse.data;
                })
                .catch((e) => {
                    console.log(e);
                })
                .finally(() => {
                    this.messagesLoading = false;
                });
        },
        checkNewMessages() {
            const lastMessageID = this.messages.at(-1).id;

            axios
                .get(route('chats.messages.checkNew', { chat: this.id, after: lastMessageID }))
                .then((httpResponse) => {
                    if (httpResponse.data.data.length) {
                        this.apiResponse.data.push(...httpResponse.data.data.reverse());
                        this.planScrollDown();
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        planScrollDown() {
            setTimeout(
                () =>
                    this.$refs.chatBottom.scrollIntoView({
                        behavior: "smooth",
                    }),
                50
            );
        },
        scrollDown(index) {
            if (this.maybeScrolledDown && (index === (this.messages.length - 1)))
                this.maybeScrolledDown = false;

            if (this.maybeScrolledDown) this.planScrollDown();
        },
        handleScroll(event) {
            if (this.$refs.messageContainer.scrollTop < 4) this.loadMessages();
        },
    },
    created() {
        this.loadMessages();
        this.setMessageCheckInterval();
    },
    unmounted() {
        this.removeMessageCheckInterval();
    },
};
</script>

<style lang="scss">
</style>
