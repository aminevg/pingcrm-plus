<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import SearchFilter from "@/Components/SearchFilter.vue";
import Icon from "@/Components/Icon.vue";

const { filters } = defineProps<{
    filters: { search: string | null; trashed: string | null };
    users: Record<string, string>[];
}>();

const form = useForm(filters);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Users" />
        <h1 class="mb-8 text-3xl font-bold">Users</h1>

        <div class="flex justify-between mb-6 gap-y-2">
            <SearchFilter v-model="form" @reset="form.reset()" />
            <Link class="btn btn-primary" href="/users/create">
                <span>Create</span>
                <span class="hidden xl:inline">&nbsp;User</span>
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th colspan="2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="hover">
                        <td class="p-0">
                            <Link
                                :href="`/users/${user.id}/edit`"
                                class="block p-4"
                            >
                                <img
                                    v-if="user.photo"
                                    class="block -my-2 mr-2 w-5 h-5 rounded-full"
                                    :src="user.photo"
                                />
                                {{ user.name }}
                                <Icon
                                    v-if="user.deleted_at"
                                    name="trash"
                                    class="flex-shrink-0 ml-2 w-3 h-3"
                                />
                            </Link>
                        </td>
                        <td class="p-0">
                            <Link
                                :href="`/users/${user.id}/edit`"
                                tabindex="-1"
                                class="block p-4"
                            >
                                {{ user.email }}
                            </Link>
                        </td>
                        <td class="w-px p-0">
                            <Link
                                :href="`/users/${user.id}/edit`"
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
