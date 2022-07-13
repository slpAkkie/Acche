<template>
    <div class="flex items-center gap-4">
        <input
            class="-mt-0.5 rounded text-blue-500 focus:ring-0 focus:ring-offset-0"
            type="checkbox"
            :id="id || name"
            :name="name"
            v-model="proxyChecked"
        />
        <label
            v-if="label"
            :for="name"
            class="text-zinc-300 w-full select-none cursor-pointer"
        >
            {{ label }}
            <span v-if="subLabel" class="text-zinc-500 text-sm"
                >({{ subLabel }})</span
            >
        </label>
    </div>
</template>

<script>
export default {
    name: "TwCheckbox",
    emits: ["update:modelValue"],
    props: {
        modelValue: {
            type: Boolean,
            default: false,
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
            default: "",
        },
        name: {
            type: String,
            default: "",
        },
    },
    computed: {
        proxyChecked: {
            get: function () {
                return this.modelValue;
            },

            set: function (val) {
                this.$emit("update:modelValue", val);
            },
        },
    },
};
</script>
