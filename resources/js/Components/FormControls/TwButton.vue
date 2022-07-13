<template>
    <div>
        <input
            :type="type"
            class="block w-full py-3 px-8 bg-zinc-700 rounded font-bold text-xs uppercase tracking-widest cursor-pointer hover:bg-blue-600 active:bg-blue-500 transition ease-in-out duration-150"
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
