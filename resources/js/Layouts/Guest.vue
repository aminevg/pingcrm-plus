<script setup lang="ts">
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <div class="flex items-center justify-center p-6 min-h-screen bg-primary">
        <div class="w-full max-w-md">
            <Link href="/">
                <BreezeApplicationLogo
                    class="block mx-auto w-full max-w-xs fill-primary-content"
                    height="50"
                />
            </Link>
            <div class="mt-8 bg-base-100 rounded-lg shadow-xl overflow-hidden">
                <slot />
            </div>
        </div>
    </div>
</template>
