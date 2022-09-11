<script setup lang="ts">
import GuestLayout from "@/Layouts/Guest.vue";
import { FormKitNode } from "@formkit/core";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submitAttrs = computed(() => ({
    inputClass: form.processing ? "loading" : "",
}));

const submit = (data: typeof form, node?: FormKitNode) => {
    form.clearErrors();
    return new Promise<void>((resolve) =>
        form.post(route("login"), {
            onSuccess: () => form.reset("password"),
            onFinish: () => {
                node?.setErrors([], form.errors);
                resolve();
            },
        })
    );
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <FormKit
            id="login-form"
            v-model="form"
            type="form"
            submit-label="Login"
            :submit-attrs="submitAttrs"
            messages-class="px-5 pt-0 mb-2"
            message-class="text-sm"
            @submit="submit"
        >
            <div class="px-10 pt-12 pb-5">
                <h1 class="text-center text-3xl font-bold">Welcome back!</h1>
                <div class="divider" />
                <FormKit
                    name="email"
                    label="Email"
                    type="email"
                    validation="required|email"
                    autofocus
                    autocapitalize="off"
                />
                <FormKit
                    name="password"
                    label="Password"
                    type="password"
                    validation="required"
                />
                <FormKit name="remember" label="Remember me" type="checkbox" />
            </div>
        </FormKit>
    </GuestLayout>
</template>
