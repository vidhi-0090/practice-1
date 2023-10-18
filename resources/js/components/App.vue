<!-- js/components/app.vue -->
<template>
    <router-view></router-view>
</template>

<script setup>
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
