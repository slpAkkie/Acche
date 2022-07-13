<template>
    <div>
        <input
            :type="type"
            class="block w-full py-2 px-8 bg-zinc-700 rounded font-bold text-xs uppercase tracking-widest cursor-pointer hover:bg-zinc-200 hover:text-zinc-800 active:bg-zinc-100 active:text-zinc-800 transition ease-in-out duration-150"
            :value="value"
        />
    </div>
</template>

<script>
export default {
    name: "TwButton",
    props: {
        type: {
            type: String,
            default: "button",
        },
        value: {
            type: String,
            default: "Кнопка",
        },
    },
};
</script>
