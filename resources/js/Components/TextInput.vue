<script setup lang="ts">
import { uniqueId } from "lodash-es";

const { id = uniqueId("text-input-"), type = "text" } = defineProps<{
    id?: string;
    label?: string;
    error?: string;
    type?: string;
    modelValue: string;
}>();

const emit = defineEmits(["update:modelValue"]);

function onInput(event: Event) {
    emit("update:modelValue", (event.target as HTMLInputElement).value);
}
</script>

<template>
    <div>
        <label
            v-if="label"
            class="mb-2 block text-slate-700 select-none"
            :for="id"
            >{{ label }}:</label
        >
        <input
            :id="id"
            ref="input"
            class="p-2 leading-normal block w-full border text-slate-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring"
            :class="{ 'border-red-500 focus:ring focus:ring-red-200': error }"
            :type="type"
            :value="modelValue"
            @input="onInput"
        />
        <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
    </div>
</template>
