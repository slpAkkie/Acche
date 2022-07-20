<template>
    <div>
        <div class="py-3 px-4 w-max max-w-[75%] rounded" :class="classes">
            <h5 class="font-bold text-sm">
                {{ authorTitle }}
                <span v-if="!isAuthor" class="text-zinc-500">
                    | {{ data.author.name }}</span
                >
            </h5>
            <p class="text-zinc-300">{{ data.content }}</p>
        </div>
        <p class="text-zinc-600 mt-1" :class="sentAtClasses">
            {{ data.sent_at }}
        </p>
    </div>
</template>

<script>
export default {
    name: "MessageCard",
    props: {
        data: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
            default: null,
        },
    },
    computed: {
        isAuthor() {
            return this.data.owner;
        },
        authorTitle() {
            return this.isAuthor ? "Я" : this.data.author.nickname;
        },
        sentAtClasses() {
            return { "text-right": this.isAuthor };
        },
        classes() {
            return this.isAuthor
                ? ["ml-auto", "mr-0", "bg-blue-600"]
                : ["ml-0", "mr-auto", "bg-zinc-600"];
        },
    },
    mounted() {
        if (this.index) this.$emit("mounted", this.index);
    },
};
</script>

<style lang="scss"></style>
