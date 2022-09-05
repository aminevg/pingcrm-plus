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

        <div v-if="status" class="mb-4 font-medium text-sm text-success">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="px-10 pt-12 pb-5">
                <h1 class="text-center text-3xl font-bold">Welcome Back!</h1>
                <div class="divider" />
                <div class="form-control gap-y-2">
                    <TextInput
                        v-model="form.email"
                        :error="form.errors.email"
                        label="Email"
                        type="email"
                        autofocus
                        autocapitalize="off"
                    />
                    <TextInput
                        v-model="form.password"
                        :error="form.errors.password"
                        label="Password"
                        type="password"
                    />
                    <label class="label cursor-pointer">
                        <span class="label-text">Remember Me</span>
                        <input
                            id="remember"
                            v-model="form.remember"
                            type="checkbox"
                            class="checkbox"
                        />
                    </label>
                </div>
            </div>
            <div class="flex px-10 py-4 bg-base-200">
                <LoadingButton
                    :loading="form.processing"
                    class="btn-primary ml-auto px-6"
                    type="submit"
                >
                    Login
                </LoadingButton>
            </div>
        </form>
    </GuestLayout>
</template>
