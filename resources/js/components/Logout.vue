<template>
  <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Logout Form</h1>
        </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div>

          <button @click="logout" style="float: right; background-color: #212529" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
        </div>
      </div>
    </main>
  </template>

<script setup>
    import { useRouter } from "vue-router";
    const router = useRouter();

    function logout() {
        localStorage.removeItem('token');
        router.push("login");
    }

</script>
