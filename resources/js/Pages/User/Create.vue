<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { FormKitNode, FormKitSchemaNode } from "@formkit/core";
import { computed } from "vue";
import { FormKitFileValue } from "@formkit/inputs";

const formSchema: FormKitSchemaNode[] = [
    {
        $el: "div",
        attrs: { class: "px-10 flex flex-col gap-y-3 pt-5" },
        children: [
            {
                $el: "div",
                attrs: { class: "flex flex-col lg:flex-row gap-x-20" },
                children: [
                    {
                        $formkit: "text",
                        name: "first_name",
                        label: "First Name",
                        outerClass: "lg:w-1/2",
                        validation: "required|length:1,25",
                    },
                    {
                        $formkit: "text",
                        name: "last_name",
                        label: "Last Name",
                        outerClass: "lg:w-1/2",
                        validation: "required|length:1,25",
                    },
                ],
            },
            {
                $el: "div",
                attrs: { class: "flex flex-col lg:flex-row gap-x-20" },
                children: [
                    {
                        $formkit: "email",
                        name: "email",
                        label: "Email",
                        outerClass: "lg:w-1/2",
                        validation: "required|email|length:1,50",
                    },
                    {
                        $formkit: "password",
                        name: "password",
                        label: "Password",
                        outerClass: "lg:w-1/2",
                        validation: "required",
                    },
                ],
            },
            {
                $formkit: "file",
                name: "photo",
                label: "Photo",
                inputClass: "file:btn-primary",
                accept: "image/*",
            },
        ],
    },
];

const form = useForm<{ [key: string]: unknown }>({});

const submitAttrs = computed(() => ({
    inputClass: form.processing ? "loading" : "",
}));

const isFile = (obj: unknown): obj is FormKitFileValue =>
    Array.isArray(obj) &&
    obj.length > 0 &&
    obj.every(
        (value) =>
            value.name !== undefined &&
            typeof value.name === "string" &&
            (value.file === undefined || value.file instanceof File)
    );

const submit = (_data: typeof form, node?: FormKitNode) =>
    new Promise<void>((resolve) => {
        form.transform((data) => ({
            ...data,
            photo: isFile(data.photo) ? data.photo[0].file ?? null : null,
        })).post(route("users.store"), {
            onFinish: () => {
                node?.setErrors([], form.errors);
                resolve();
            },
        });
    });
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
                :submit-attrs="submitAttrs"
                messages-class="px-5 pt-0 mb-2"
                message-class="text-sm"
                @submit="submit"
            >
                <FormKitSchema :schema="formSchema" />
            </FormKit>
        </div>
    </AuthenticatedLayout>
</template>
