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
    <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:flex-shrink-0">
            <div
                class="flex items-center justify-between px-6 py-4 bg-primary-focus md:flex-shrink-0 md:justify-center md:w-56"
            >
                <Link class="mt-1" href="/">
                    <ApplicationLogo
                        class="fill-primary-content"
                        width="120"
                        height="28"
                    />
                </Link>
                <Dropdown
                    class="md:hidden"
                    content-class="mt-2 rounded shadow-lg"
                >
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
                        <MainMenu class="bg-base-300" />
                    </template>
                </Dropdown>
            </div>
            <div
                class="md:text-md flex items-center justify-end w-full text-sm bg-base-300 p-4 md:py-0"
            >
                <Dropdown>
                    <template #trigger>
                        <div
                            class="group flex items-center cursor-pointer select-none"
                        >
                            <div
                                class="mr-1 text-base-content group-hover:text-primary focus:text-primary whitespace-nowrap"
                            >
                                <span>{{ user.name }}</span>
                            </div>
                            <Icon
                                class="w-5 h-5 fill-base-content group-hover:fill-primary focus:fill-primary"
                                name="cheveron-down"
                            />
                        </div>
                    </template>
                    <template #content>
                        <Link
                            class="block px-6 py-2 hover:text-primary-content hover:bg-primary"
                            :href="`/users/${user.id}/edit`"
                        >
                            My Profile
                        </Link>
                        <Link
                            class="block px-6 py-2 hover:text-primary-content hover:bg-primary"
                            href="/users"
                        >
                            Manage Users
                        </Link>
                        <Link
                            class="block px-6 py-2 w-full text-left hover:text-primary-content hover:bg-primary"
                            href="/logout"
                            method="post"
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
                class="hidden flex-shrink-0 w-56 pt-10 bg-base-300 overflow-y-auto md:block"
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
</template>
