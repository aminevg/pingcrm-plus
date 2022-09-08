<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import SearchFilter from "@/Components/SearchFilter.vue";
import Icon from "@/Components/Icon.vue";
import { User } from "@/global";
import { watch } from "vue";
import { pickBy, throttle } from "lodash-es";

const { filters } = defineProps<{
    filters: { search: string | null; trashed: string | null };
    users: User[];
}>();

const form = useForm(filters);

function resetSearch() {
    form.search = null;
    form.trashed = null;
}

watch(
    form,
    throttle(
        () =>
            form.transform(pickBy).get(route("users.index"), {
                preserveState: true,
                only: ["users"],
            }),
        150
    )
);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Users" />
        <h1 class="mb-8 text-3xl font-bold">Users</h1>

        <div class="flex flex-col md:justify-between md:flex-row mb-6 gap-y-2">
            <SearchFilter v-model="form" @reset="resetSearch" />
            <Link
                class="btn btn-primary max-w-max xl:max-w-none"
                :href="route('users.create')"
            >
                Create user
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <colgroup>
                    <col class="w-px" />
                    <col class="w-1/2" />
                    <col class="w-1/2" span="2" />
                </colgroup>
                <thead>
                    <tr>
                        <th />
                        <th>Name</th>
                        <th colspan="2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="hover">
                        <td class="p-0" />
                        <td class="p-0">
                            <Link
                                :href="route('users.edit', user.id)"
                                class="p-4 flex items-center gap-x-3"
                            >
                                <div class="avatar">
                                    <div class="mask mask-circle w-12 h-12">
                                        <img
                                            v-if="user.photo"
                                            :src="user.photo"
                                        />
                                        <svg
                                            v-else
                                            width="48px"
                                            height="48px"
                                            stroke-width="1.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="bg-base-300"
                                        >
                                            <path
                                                d="M5 20v-1a7 7 0 017-7v0a7 7
                                            0 017 7v1M12 12a4 4 0 100-8 4 4 0
                                            000 8z"
                                                class="stroke-base-content"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <span>{{ user.name }}</span>
                                <Icon
                                    v-if="user.deleted_at"
                                    name="trash"
                                    class="flex-shrink-0 ml-2 w-3 h-3"
                                />
                            </Link>
                        </td>
                        <td class="p-0">
                            <Link
                                :href="route('users.edit', user.id)"
                                tabindex="-1"
                                class="block p-4"
                            >
                                {{ user.email }}
                            </Link>
                        </td>
                        <td class="p-0">
                            <Link
                                :href="route('users.edit', user.id)"
                                tabindex="-1"
                                class="block p-4"
                            >
                                <Icon
                                    name="cheveron-right"
                                    class="block w-6 h-6 fill-base-content"
                                />
                            </Link>
                        </td>
                    </tr>
                </tbody>
                <tr v-if="users.length === 0">
                    <td colspan="4">No users found.</td>
                </tr>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
