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
                                v-if="showRegisterLink"
                                to="/register"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Register
                            </router-link>

                            <router-link
                                v-if="showLoginLink"
                                to="/login"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Login
                            </router-link>

                            <button
                                @click="logout"
                                v-if="showLogoutButton"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Logout
                            </button>

                            <router-link
                                v-if="showDashboardLink"
                                to="/dashboard/2"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Dashboard
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <router-view></router-view>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from "vue-router";
const router = useRouter();

const to = router.currentRoute.value;
const isAuthenticated = ref(localStorage.getItem("token") !== null);

const showRegisterLink = computed(() => !isAuthenticated.value && !localStorage.getItem("token"));
const showLoginLink = computed(() => !isAuthenticated.value && !localStorage.getItem("token"));
const showLogoutButton = computed(() => isAuthenticated.value && localStorage.getItem("token"));
const showDashboardLink = computed(() => isAuthenticated.value && localStorage.getItem("token"));

function logout() {
    localStorage.removeItem("token");
    isAuthenticated.value = false;
    router.push("login");
}
</script>
