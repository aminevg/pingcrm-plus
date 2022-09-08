<script setup lang="ts">
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { PropsInterface, User } from "@/global";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import MainMenu from "@/Components/MainMenu.vue";
import FlashMessages from "@/Components/FlashMessages.vue";

const { props } = usePage<PropsInterface>();
const user = props.value.auth.user as User;
</script>

<template>
    <div>
        <div class="navbar bg-primary-focus text-primary-content">
            <div class="navbar-start">
                <Dropdown class="lg:hidden" content-class="mt-3">
                    <template #trigger>
                        <svg
                            class="w-6 h-6 fill-primary-content cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                            />
                        </svg>
                    </template>
                    <template #content>
                        <MainMenu class="bg-primary-focus shadow rounded-box" />
                    </template>
                </Dropdown>
                <Link
                    href="/"
                    class="btn btn-ghost hidden lg:flex no-animation"
                >
                    <ApplicationLogo
                        class="fill-primary-content"
                        width="140"
                        height="32"
                    />
                </Link>
            </div>
            <div class="navbar-center">
                <MainMenu class="menu-horizontal hidden lg:flex" />
                <Link href="/" class="btn btn-ghost lg:hidden">
                    <ApplicationLogo
                        class="fill-primary-content"
                        width="140"
                        height="32"
                    />
                </Link>
            </div>
            <div class="navbar-end">
                <Dropdown
                    class="dropdown-end"
                    content-class="bg-primary-focus mt-3"
                >
                    <template #trigger>
                        <div class="flex items-center gap-x-2">
                            <div class="avatar">
                                <div class="mask mask-circle w-8 h-8">
                                    <img v-if="user.photo" :src="user.photo" />
                                    <svg
                                        v-else
                                        width="32px"
                                        height="32px"
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
                            <span class="hidden md:inline">
                                {{ user.name }}
                            </span>
                        </div>
                    </template>
                    <template #content>
                        <ul class="menu">
                            <li>
                                <Link :href="`/users/${user.id}/edit`">
                                    My Profile
                                </Link>
                            </li>
                            <li>
                                <Link href="/users">Manage Users</Link>
                            </li>
                            <li>
                                <Link href="/logout" method="post" as="button">
                                    Logout
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Dropdown>
            </div>
        </div>
        <div class="lg:overflow-hidden px-4 py-8 lg:p-12">
            <div class="lg:overflow-y-auto" scroll-region>
                <FlashMessages />
                <slot />
            </div>
        </div>
    </div>
</template>
