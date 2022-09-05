<script setup lang="ts">
defineProps<{ loading?: boolean }>();
</script>

<template>
    <button :disabled="loading" class="btn" :class="{ loading }">
        <slot />
    </button>
</template>
