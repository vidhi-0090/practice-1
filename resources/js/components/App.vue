<!-- js/components/app.vue -->
<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div
                    class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start"
                >
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <router-link
                                to="/home"
                                class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                aria-current="page"
                            >
                                Home
                            </router-link>

                            <router-link
                                v-if="authStore.getters.getIsAuthenticated == 0"
                                to="/register"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Register
                            </router-link>

                            <router-link
                                v-if="authStore.getters.getIsAuthenticated == 0"
                                to="/login"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Login
                            </router-link>

                            <router-link
                                v-if="authStore.getters.getIsAuthenticated != 0"
                                to="/dashboard/2"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Dashboard
                            </router-link>

                            <router-link
                                to="/todo"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                ToDo
                            </router-link>

                            <button
                                v-if="authStore.getters.getIsAuthenticated != 0"
                                @click="logout"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <router-view></router-view>
</template>

<script setup>
import { useRouter } from "vue-router";
import authStore from "../store/auth.js";
import { computed } from "vue";

const router = useRouter();

function logout() {
    authStore.dispatch("removeAuthenticated");
    router.push("/login");
}
if (localStorage.getItem("token")) {
    authStore.dispatch("setAuthenticated", localStorage.getItem("token"));
} else if (!localStorage.getItem("token")) {
    authStore.dispatch("removeAuthenticated");
}
</script>
