<script setup lang="ts">
defineProps<{ loading?: boolean }>();
</script>

<template>
    <button :disabled="loading" class="flex items-center">
        <div
            v-if="loading"
            class="mr-2 relative text-[10px] rounded-[50%] w-4 h-4 -indent-[9999em] border-[0.2em] border-solid border-l-transparent border-white animate-spin"
        />
        <slot />
    </button>
</template>
