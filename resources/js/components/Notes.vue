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
                                v-if="authStore.getters.getIsAuthenticated != 0"
                                :to="'/dashboard/' + user_id"
                                :class="{
                                    'bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium':
                                        $route.path.startsWith('/dashboard'),
                                    'text-gray-300 hover:bg-gray-700 hover-text-white rounded-md px-3 py-2 text-sm font-medium':
                                        !$route.path.startsWith('/dashboard'),
                                }"
                            >
                                Dashboard
                            </router-link>

                            <router-link
                                to="/todo"
                                :class="{
                                    'bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium':
                                        $route.path === '/todo',
                                    'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium':
                                        $route.path !== '/todo',
                                }"
                            >
                                ToDo
                            </router-link>

                            <router-link
                                v-if="authStore.getters.getIsAuthenticated != 0"
                                :to="'/notes'"
                                :class="{
                                    'bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium':
                                        $route.path === '/notes',
                                    'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium':
                                        $route.path !== '/notes',
                                }"
                            >
                                Notes
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
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <section class="todoapp">
                <div class="form_container">
                    <div class="title_container">
                        <Notes></Notes>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>

<script setup>
import Notes from "../Practical3/Notes.vue";
import { useRouter } from "vue-router";
import authStore from "../store/auth.js";
import { ref, computed, onMounted } from "vue";
import { inject } from "vue";
import notesStore from "../store/notes.js";

const baseUrl = inject("baseUrl");
const router = useRouter();
const user_id = ref(0);

if (localStorage.getItem("token")) {
    authStore.dispatch("setAuthenticated", localStorage.getItem("token"));
} else if (!localStorage.getItem("token")) {
    authStore.dispatch("removeAuthenticated");
}

const getUserId = async () => {
    try {
        const user_data = await axios.get(baseUrl.value + "api/users");
        user_id.value = user_data.data.data.id;
    } catch (error) {
        console.log(error);
    }
};

function logout() {
    authStore.dispatch("removeAuthenticated");
    notesStore.dispatch("removeNotes", user_id.value);
    localStorage.clear();
    router.push("/login");
}

onMounted(() => {
    getUserId();
});
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
</style>
