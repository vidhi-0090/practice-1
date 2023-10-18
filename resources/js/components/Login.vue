<template>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="form_wrapper">
                <div class="form_container">
                    <div class="title_container">
                        <h2>Login Form</h2>
                    </div>
                    <div v-if="errors">
                        <p style="color: red">
                            {{ errors }}
                        </p>
                    </div>
                    <div class="row clearfix">
                        <div class="">
                            <form @submit.prevent="login()">
                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="envelope"
                                    /></span>
                                    <input
                                        type="text"
                                        name="email"
                                        placeholder="Email"
                                        v-model="email"
                                    />

                                    <div v-if="v$.email.$error">
                                        <p v-if="v$.email.required">
                                            <strong style="color: red">{{
                                                v$.email.required.$message
                                            }}</strong>
                                        </p>
                                        <p v-if="v$.email.email">
                                            <strong style="color: red">{{
                                                v$.email.email.$message
                                            }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="lock"
                                    /></span>
                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Password"
                                        v-model="password"
                                    />

                                    <div v-if="v$.password.$error">
                                        <p v-if="v$.password.required">
                                            <strong style="color: red">{{
                                                v$.password.required.$message
                                            }}</strong>
                                        </p>
                                    </div>
                                </div>

                                <input
                                    class="button"
                                    type="submit"
                                    value="Login"
                                />
                            </form>
                            <p class="credit">
                                Not a member?
                                <router-link
                                    to="/register"
                                ><b>
                                    Register </b></router-link
                                >
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import authStore from "../store/auth.js";
import { useVuelidate } from "@vuelidate/core";
import { email, required } from "@vuelidate/validators";
import axios from "axios";
import Swal from "sweetalert2";

export default {
    setup: () => ({
        v$: useVuelidate(),
        authStoreInstance: authStore,
    }),
    data: () => ({
        password: "",
        email: "",
        errors: "",
    }),
    validations() {
        return {
            password: { required },
            email: { required, email },
        };
    },

    methods: {
        methods: {
            showAlert(options) {
                Swal.fire(options);
            },
        },

        async login() {
            const result = await this.v$.$validate();
            if (!result) {
                return;
            }

            try {
                axios
                    .post("api/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((res) => {
                        if (res.data.status === true) {
                            const token = res.data.data.token;
                            const user_id = res.data.data.id;

                            Swal.fire({
                                icon: "success",
                                title: "Login Successful",
                                text: "You will be redirected to the dashboard.",
                                showConfirmButton: true,
                            }).then(() => {
                                this.authStoreInstance.dispatch(
                                    "setAuthenticated",
                                    res.data.data.token
                                );
                                this.$router.push({
                                    name: "dashboard",
                                    params: { user_id: user_id },
                                });

                                // this.authStore.dispatch(
                                //     "setAuthenticated",
                                //     res.data.data.token
                                // );
                                // this.$router.push({
                                //     name: "dashboard",
                                //     params: { user_id: user_id },
                                // });
                            });
                        } else {
                            console.log(res.data.message);
                            if (res.data.status == false) {
                                this.errors = res.data.message;
                            }
                        }
                    })
                    .catch((error) => {});
            } catch (error) {
                console.error("Error:", error);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
</style>
