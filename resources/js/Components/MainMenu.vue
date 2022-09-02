<script setup lang="ts">
import { Link, usePage } from "@inertiajs/inertia-vue3";
import Icon from "./Icon.vue";

const { url } = usePage();

const dashboardUrl = route("dashboard", {}, false);
</script>

<template>
    <div>
        <div class="mb-4">
            <Link class="group flex items-center py-3" :href="dashboardUrl">
                <Icon
                    name="dashboard"
                    class="mr-2 w-4 h-4"
                    :class="
                        url.startsWith(dashboardUrl)
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        url.startsWith(dashboardUrl)
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    Dashboard
                </div>
            </Link>
        </div>
    </div>
</template>
