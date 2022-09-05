<script setup lang="ts">
import { uniqueId } from "lodash-es";

const { id = uniqueId("text-input-"), type = "text" } = defineProps<{
    id?: string;
    label?: string;
    error?: string;
    type?: string;
    placeholder?: string;
    contentClass?: string;
    modelValue: string | null;
}>();

const emit = defineEmits(["update:modelValue"]);

function onInput(event: Event) {
    emit("update:modelValue", (event.target as HTMLInputElement).value);
}
</script>

<template>
    <label v-if="label" class="label" :for="id">
        <span class="label-text">{{ label }}</span>
    </label>
    <input
        :id="id"
        ref="input"
        class="input input-bordered"
        :class="[{ 'input-error': error }, contentClass]"
        :type="type"
        :value="modelValue"
        :placeholder="placeholder"
        @input="onInput"
    />
    <label v-if="error" class="label">
        <span class="label-text-alt text-error">{{ error }}</span>
    </label>
</template>
