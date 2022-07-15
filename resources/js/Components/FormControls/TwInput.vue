<template>
    <div class="flex flex-col w-full">
        <label v-if="label" :for="name" class="text-zinc-300">
            {{ label }}
            <span v-if="subLabel" class="text-zinc-500 text-sm"
                >({{ subLabel }})</span
            >
        </label>
        <input
            class="text-zinc-300 bg-zinc-700 border-2 border-zinc-700 focus:border-blue-500 focus:ring-blue-500 rounded py-1 px-2 placeholder:text-zinc-500 transition ease-in-out duration-150"
            :class="
                hasError && [
                    'text-rose-500',
                    'border-rose-700',
                    'focus:border-rose-700',
                    'focus:ring-rose-700',
                    'placeholder:text-rose-500',
                    'placeholder:opacity-90',
                ]
            "
            :type="type"
            :id="id || name"
            :name="name"
            :placeholder="placeholder"
            v-model="inputVal"
            ref="input"
        />
        <p v-if="hasError" class="text-rose-700 text-sm mt-1">
            {{ errorMessage }}
        </p>
    </div>
</template>

<script>
export default {
    name: "TwInput",
    props: {
        modelValue: {
            type: String,
        },
        type: {
            type: String,
            default: "text",
        },
        placeholder: {
            type: String,
            default: "",
        },
        label: {
            type: String,
            default: "",
        },
        subLabel: {
            type: String,
            default: "",
        },
        id: {
            type: String,
            default: null,
        },
        name: {
            type: String,
            default: null,
        },
        maxLength: {
            type: Number,
            default: null,
        },
        wrongFields: {
            type: Object,
            default: () => ({}),
        },
    },
    emits: ["update:modelValue"],
    data: () => ({
        inputVal: "",
    }),
    computed: {
        hasError() {
            return this.name ? !!this.wrongFields[this.name] : false;
        },
        errorMessage() {
            return this.name
                ? this.wrongFields[this.name] ?? "Ошибка при заполнении поля"
                : "";
        },
    },
    watch: {
        inputVal(newVal, oldVal) {
            if (this.hasError) delete this.wrongFields[this.name];

            if (!this.maxLength || newVal.length <= this.maxLength)
                return this.$emit(
                    "update:modelValue",
                    (this.inputVal = newVal)
                );

            return this.$emit("update:modelValue", (this.inputVal = oldVal));
        },
    },
    mounted() {
        if (this.modelValue) this.inputVal = this.modelValue;

        if (this.$refs.input.hasAttribute("autofocus")) {
            this.$refs.input.focus();
        }
    },
};
</script>
