<script setup lang="ts">
import { Link, usePage } from "@inertiajs/inertia-vue3";
import Icon from "./Icon.vue";
import { $ } from "vue/macros";

const { name, label } = defineProps<{ name: string; label: string }>();
const { url: currentUrl } = $(usePage());

const relativeUrl = route().has(name) ? route(name, {}, false) : "";
const active = relativeUrl ? currentUrl.startsWith(relativeUrl) : false;
</script>

<template>
    <li>
        <Link
            :class="{ active }"
            class="group shadow rounded-full focus:border-opacity-10 hover:bg-primary hover:text-primary-content"
            :href="relativeUrl"
        >
            <Icon
                :name="name"
                class="w-4 h-4"
                :class="
                    active
                        ? 'fill-primary-content'
                        : 'fill-base-content group-hover:fill-primary-content'
                "
            />
            {{ label }}
        </Link>
    </li>
</template>
