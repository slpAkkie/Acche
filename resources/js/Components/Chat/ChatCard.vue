<template>
    <div class="group cursor-pointer" @click="openChat">
        <div
            class="p-3 border border-zinc-600 group-hover:border-blue-700 rounded group-hover:bg-blue-700 acche-transition"
        >
            <h3 class="font-bold text-lg">{{ chat.name }}</h3>
            <p class="text-zinc-300 group-hover:text-zinc-100 acche-transition">
                <span v-if="lastMessage">
                    <span
                        class="text-zinc-500 group-hover:text-zinc-300 acche-transition"
                        >{{ lastMessage.author.nickname }} ({{
                            lastMessage.author.name
                        }})</span
                    >:
                    {{ lastMessage.content }}
                </span>
                <span
                    v-else
                    class="text-zinc-500 group-hover:text-zinc-300 acche-transition"
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
