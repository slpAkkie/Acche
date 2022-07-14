<template>
    <div class="group cursor-pointer" @click="openChat">
        <div
            class="p-3 border border-zinc-500 group-hover:border-blue-700 rounded group-hover:bg-blue-700 transition ease-in-out duration-150"
        >
            <h3 class="font-bold text-lg">{{ chat.name }}</h3>
            <p
                class="text-zinc-300 group-hover:text-zinc-100 transition ease-in-out duration-150"
            >
                <span v-if="lastMessage">
                    <span
                        class="text-zinc-500 group-hover:text-zinc-300 transition ease-in-out duration-150"
                        >{{ lastMessage.author.nickname }} ({{
                            lastMessage.author.name
                        }})</span
                    >:
                    {{ lastMessage.content }}
                </span>
                <span v-else class="text-zinc-500 group-hover:text-zinc-300"
                    >Сообщений еще нет</span
                >
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatCard",
    props: {
        chat: {
            type: Object,
            required: true,
        },
    },
    computed: {
        messages() {
            return this.chat.messages;
        },
        lastMessage() {
            return this.messages[0];
        },
    },
    methods: {
        openChat() {
            location.href = route("chats.show", this.chat.id);
        },
    },
};
</script>

<style lang="scss"></style>
