<template>
    <div
        class="group cursor-pointer"
        :class="wrapperClasses"
        :data-letter="afterContent"
    >
        <input
            :type="type"
            class="block w-full bg-zinc-700 rounded font-bold uppercase tracking-widest cursor-pointer group-hover:bg-zinc-200 group-hover:text-zinc-800 group-active:bg-zinc-100 group-active:text-zinc-800 acche-transition"
            :class="inputClasses"
            :value="text"
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
        circle: {
            type: Boolean,
            default: false,
        },
        hovered: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        text() {
            return this.circle ? "" : this.value;
        },
        afterContent() {
            return this.value[0].toUpperCase();
        },
        wrapperClasses() {
            let classes = this.circle
                ? [
                      "relative",
                      "select-none",
                      "hover:text-zinc-800",
                      "after:font-bold",
                      "after:absolute",
                      "after:content-[attr(data-letter)]",
                      "after:top-[50%]",
                      "after:left-[50%]",
                      "after:-translate-x-1/2",
                      "after:-translate-y-1/2",
                      "after:transition",
                      "after:ease-in-out",
                      "after:duration-150",
                  ]
                : [];

            if (this.hovered) classes.push(...["text-zinc-800"]);

            return classes;
        },
        inputClasses() {
            let classes = this.circle
                ? ["h-[40px]", "w-[40px]", "rounded-full"]
                : ["py-2", "px-8", "text-xs"];

            if (this.hovered)
                classes.push(
                    "bg-zinc-200",
                    "text-zinc-800",
                    "bg-zinc-100",
                    "text-zinc-800"
                );

            return classes;
        },
    },
};
</script>
