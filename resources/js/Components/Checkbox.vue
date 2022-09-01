<script setup lang="ts">
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const { checked = false } = defineProps<{
    checked?: boolean | Array<string>;
}>();

const proxyChecked = computed({
    get() {
        return checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    />
</template>
