<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";
import { $ref } from "vue/macros";

const { contentClass = "bg-base-100" } = defineProps<{
    align?: string;
    width?: string;
    contentClass?: string;
}>();

const dropdown = $ref<HTMLDivElement | null>(null);

const closeOnEscape = (e: KeyboardEvent) => {
    if (e.key === "Escape") {
        dropdown?.blur();
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));
</script>

<template>
    <div class="dropdown">
        <label ref="dropdown" tabindex="0" class="btn btn-ghost">
            <slot name="trigger" />
        </label>

        <div
            tabindex="0"
            class="dropdown-content w-52 shadow rounded-box"
            :class="contentClass"
        >
            <slot name="content" />
        </div>
    </div>
</template>
