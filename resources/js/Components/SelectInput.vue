<script setup lang="ts">
import { uniqueId } from "lodash-es";

const { id = uniqueId("text-input-") } = defineProps<{
    id?: string;
    label?: string;
    error?: string;
    contentClass?: string;
    modelValue: string | null;
}>();

const emit = defineEmits(["update:modelValue"]);

function onInput(event: Event) {
    emit("update:modelValue", (event.target as HTMLSelectElement).value);
}
</script>

<template>
    <label v-if="label" class="label" :for="id">
        <span class="label-text">{{ label }}</span>
    </label>
    <select
        :id="id"
        class="select select-bordered"
        :class="[{ 'input-error': error }, contentClass]"
        :value="modelValue"
        @input="onInput"
    >
        <slot />
    </select>
    <label v-if="error" class="label">
        <span class="label-text-alt text-error">{{ error }}</span>
    </label>
</template>
