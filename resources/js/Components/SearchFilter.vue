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
    <div class="flex flex-col md:flex-row gap-x-2">
        <FormKit v-model="formProxy" type="group">
            <FormKit name="search" type="text" placeholder="Search..." />
            <FormKit
                name="trashed"
                type="select"
                :options="{
                    null: 'No trashed users',
                    with: 'WIth trashed users',
                    only: 'Only trashed users',
                }"
            />
        </FormKit>
        <button
            class="btn btn-sm self-end md:self-start md:mt-2 btn-ghost"
            type="button"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
</template>
