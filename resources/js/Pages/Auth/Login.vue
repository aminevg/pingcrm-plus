<script setup lang="ts">
import GuestLayout from "@/Layouts/Guest.vue";
import TextInput from "@/Components/TextInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

defineProps<{
    canResetPassword: boolean;
    status: string | null;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="px-10 py-12">
                <h1 class="text-center text-3xl font-bold">Welcome Back!</h1>
                <div class="mt-6 mx-auto w-24 border-b-2" />
                <text-input
                    v-model="form.email"
                    :error="form.errors.email"
                    class="mt-10"
                    label="Email"
                    type="email"
                    autofocus
                    autocapitalize="off"
                />
                <text-input
                    v-model="form.password"
                    :error="form.errors.password"
                    class="mt-6"
                    label="Password"
                    type="password"
                />
                <label
                    class="flex items-center mt-6 select-none"
                    for="remember"
                >
                    <input
                        id="remember"
                        v-model="form.remember"
                        class="mr-1"
                        type="checkbox"
                    />
                    <span class="text-sm">Remember Me</span>
                </label>
            </div>
            <div class="flex px-10 py-4 bg-slate-100 border-t border-slate-100">
                <loading-button
                    :loading="form.processing"
                    class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400 ml-auto"
                    type="submit"
                >
                    Login
                </loading-button>
            </div>
        </form>
    </GuestLayout>
</template>
