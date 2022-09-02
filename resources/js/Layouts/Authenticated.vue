<script setup lang="ts">
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { PropsInterface, User } from "@/global";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import MainMenu from "@/Components/MainMenu.vue";
import Icon from "@/Components/Icon.vue";
import FlashMessages from "@/Components/FlashMessages.vue";

const { props } = usePage<PropsInterface>();
const user = props.value.auth.user as User;
</script>

<template>
    <div>
        <div id="dropdown" />
        <div class="md:flex md:flex-col">
            <div class="md:flex md:flex-col md:h-screen">
                <div class="md:flex md:flex-shrink-0">
                    <div
                        class="flex items-center justify-between px-6 py-4 bg-indigo-900 md:flex-shrink-0 md:justify-center md:w-56"
                    >
                        <Link class="mt-1" href="/">
                            <ApplicationLogo
                                class="fill-white"
                                width="120"
                                height="28"
                            />
                        </Link>
                        <Dropdown
                            class="md:hidden"
                            content-class="mt-2 px-8 py-4 bg-indigo-800 rounded shadow-lg"
                        >
                            <template #trigger>
                                <svg
                                    class="w-6 h-6 fill-white cursor-pointer"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                                    />
                                </svg>
                            </template>
                            <template #content>
                                <MainMenu />
                            </template>
                        </Dropdown>
                    </div>
                    <div
                        class="md:text-md flex items-center justify-end p-4 w-full text-sm bg-white border-b md:px-12 md:py-0"
                    >
                        <Dropdown>
                            <template #trigger>
                                <div
                                    class="group flex items-center cursor-pointer select-none"
                                >
                                    <div
                                        class="mr-1 text-slate-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap"
                                    >
                                        <span>{{ user.name }}</span>
                                    </div>
                                    <Icon
                                        class="w-5 h-5 fill-slate-700 group-hover:fill-indigo-600 focus:fill-indigo-600"
                                        name="cheveron-down"
                                    />
                                </div>
                            </template>
                            <template #content>
                                <Link
                                    class="block px-6 py-2 hover:text-white hover:bg-indigo-500"
                                    :href="`/users/${user.id}/edit`"
                                >
                                    My Profile
                                </Link>
                                <Link
                                    class="block px-6 py-2 hover:text-white hover:bg-indigo-500"
                                    href="/users"
                                >
                                    Manage Users
                                </Link>
                                <Link
                                    class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500"
                                    href="/logout"
                                    method="delete"
                                    as="button"
                                >
                                    Logout
                                </Link>
                            </template>
                        </Dropdown>
                    </div>
                </div>
                <div class="md:flex md:flex-grow md:overflow-hidden">
                    <MainMenu
                        class="hidden flex-shrink-0 p-12 w-56 bg-indigo-800 overflow-y-auto md:block"
                    />
                    <div
                        class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto"
                        scroll-region
                    >
                        <FlashMessages />
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
