<script setup lang="ts">
import { InertiaForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import TextInput from "./TextInput.vue";

const { modelValue } = defineProps<{
    modelValue: InertiaForm<{ search: string | null; trashed: string | null }>;
}>();

const emit = defineEmits(["update:modelValue", "reset"]);

const formProxy = computed({
    get() {
        return modelValue;
    },
    set(newValue) {
        emit("update:modelValue", newValue);
    },
});
</script>

<template>
    <div class="flex gap-x-2 max-w-xs md:max-w-none">
        <TextInput v-model="formProxy.search" placeholder="Search…" />
        <select v-model="formProxy.trashed" class="select select-bordered">
            <option :value="null">No trashed users</option>
            <option value="with">With trashed users</option>
            <option value="only">Only trashed users</option>
        </select>
        <button
            class="btn btn-sm self-center btn-ghost"
            type="button"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
</template>
