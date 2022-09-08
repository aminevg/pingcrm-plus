<script setup lang="ts">
import { PropsInterface } from "@/global";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed, watch } from "vue";
import { $, $ref } from "vue/macros";

let show = $ref(true);

const props = $(usePage<PropsInterface>().props);
const { flash, errors } = props;

watch([flash, errors], () => (show = true));

const errorsLength = computed(() => (errors ? Object.keys(errors).length : 0));
</script>

<template>
    <div class="mb-4 flex flex-col items-center gap-y-4">
        <div
            v-if="flash?.success && show"
            class="alert alert-success flex-row shadow-lg md:max-w-xl md:w-1/2"
        >
            <div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current flex-shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>
                    {{ flash.success }}
                </span>
            </div>
            <button
                type="button"
                class="btn btn-ghost btn-xs !mt-0"
                @click="show = false"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
        <div
            v-if="(flash?.error || errorsLength > 0) && show"
            class="alert alert-error flex-row shadow-lg md:max-w-xl md:w-1/2"
        >
            <div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current flex-shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span v-if="flash?.error">
                    {{ flash.error }}
                </span>
                <span v-else>
                    There
                    {{ errorsLength === 1 ? "is one" : `are ${errorsLength}` }}
                    form {{ errorsLength === 1 ? "error" : "errors" }}.
                </span>
            </div>
            <button
                type="button"
                class="btn btn-ghost btn-xs !mt-0"
                @click="show = false"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
