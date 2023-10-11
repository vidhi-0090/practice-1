import { createRouter, createWebHistory } from "vue-router";
import Register from "./components/Register.vue";
import Login from "./components/Login.vue";
import Logout from "./components/Logout.vue";
import Home from "./components/Home.vue";
import Dashboard from "./components/Dashboard.vue";
// import User from './components/Dashboard.vue';

const routes = [
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/logout",
        name: "Logout",
        component: Logout,
        meta: {
            requiresAuth: true,
        },
    },
    { path: "/home", name: "Home", component: Home },
    {
        path: "/dashboard/:user_id",
        name: "dashboard",
        component: Dashboard,
        meta: {
            requiresAuth: true,
        },
    },
    // {
    //     path: '/get_user/:user_id',
    //     name: 'get_user',
    //     component: User,
    //     meta: {
    //         requiresAuth:true
    //     }
    // },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
        return { name: "Login" };
    }
    if (to.meta.requiresAuth == false && localStorage.getItem("token")) {
        return { name: "dashboard", params: 1 };
    }
});
export default router;
