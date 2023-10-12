
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
                            v-if="!isAuthenticated"
                                to="/register"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Register
                            </router-link>

                            <router-link
                            v-if="!isAuthenticated"
                                to="/login"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Login
                            </router-link>

                            <router-link
                            v-if="isAuthenticated"
                                to="/dashboard/2"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                            >
                                Dashboard
                            </router-link>


                            <button
                            v-if="isAuthenticated"
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
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();
const router = useRouter();

const isAuthenticated = computed(() => store.state.isAuthenticated);

function logout() {
    store.commit("setAuthenticationStatus", false);
    localStorage.removeItem("token");
    router.push("/login");
}
</script>
