<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";

const form = useForm<{
    first_name: string | null;
    last_name: string | null;
    email: string | null;
    password: string | null;
}>({ first_name: null, last_name: null, email: null, password: null });

function store() {
    console.log(form);
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create User" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="link link-primary link-hover" href="/users">
                Users</Link
            >
            <span class="text-primary"> /</span>
            Create
        </h1>
        <div
            class="mx-auto max-w-5xl bg-base-200 rounded-md shadow overflow-hidden"
        >
            <FormKit
                v-model="form"
                type="form"
                submit-label="Create user"
                messages-class="px-10 pt-0 mb-2"
                message-class="text-sm"
                @submit="store"
            >
                <div class="flex flex-col lg:flex-row gap-x-20 px-10 pt-5">
                    <FormKit
                        name="first_name"
                        type="text"
                        label="First name"
                        outer-class="lg:w-1/2"
                        validation="required|length:1,25"
                    />
                    <FormKit
                        name="last_name"
                        type="text"
                        label="Last name"
                        outer-class="lg:w-1/2"
                        validation="required|length:1,25"
                    />
                </div>
                <div class="flex flex-col lg:flex-row gap-x-20 px-10 pb-5">
                    <FormKit
                        name="email"
                        type="email"
                        label="Email"
                        outer-class="lg:w-1/2"
                        validation="required|email|length:1,50"
                    />
                    <FormKit
                        name="password"
                        type="password"
                        label="Password"
                        outer-class="lg:w-1/2"
                        validation="required"
                    />
                </div>
            </FormKit>
        </div>
    </AuthenticatedLayout>
</template>
