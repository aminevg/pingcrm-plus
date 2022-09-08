<script setup lang="ts">
import { InertiaForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

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
    <div
        class="flex flex-col sm:flex-row gap-x-2 sm:flex-grow sm:max-w-xl xl:max-w-3xl"
    >
        <FormKit v-model="formProxy" type="group">
            <FormKit
                name="search"
                type="text"
                outer-class="flex-grow"
                placeholder="Search..."
            />
            <FormKit
                name="trashed"
                type="select"
                outer-class="flex-grow"
                :options="[
                    { label: 'No trashed users', value: null },
                    { label: 'With trashed users', value: 'with' },
                    { label: 'Only trashed users', value: 'only' },
                ]"
            />
        </FormKit>
        <button
            class="btn btn-sm self-end sm:self-start sm:mt-2 btn-ghost"
            type="button"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
</template>
