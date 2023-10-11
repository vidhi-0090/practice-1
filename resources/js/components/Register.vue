<template>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Registration Form
            </h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="form_wrapper">
                <div class="form_container">
                    <div class="title_container">
                        <h2>Registration Form</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="">
                            <p
                                style="color: red"
                                v-for="error in errors"
                                :key="error"
                            >
                                {{ error }}
                                <span v-for="err in error" :key="err">
                                    {{ err }}
                                </span>
                            </p>
                            <form @submit.prevent="register">
                                <div class="row clearfix">
                                    <div class="col_half">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon icon="user" />
                                            </span>
                                            <input
                                                type="text"
                                                name="name"
                                                v-model="form.name"
                                                placeholder="First Name"
                                            />
                                            <p style="color:red" id="name"></p>
                                        </div>
                                    </div>
                                    <div class="col_half">
                                        <div class="input_field">
                                            <span
                                                ><font-awesome-icon icon="user" /></span>
                                            <input
                                                type="text"
                                                name="last_name"
                                                v-model="form.last_name"
                                                placeholder="Last Name"
                                            />
                                            <p style="color:red" id="name"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="envelope" /></span>
                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Email"
                                        v-model="form.email"
                                    />
                                    <p style="color:red" id="email"></p>
                                </div>
                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="lock" /></span>
                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Password"
                                        v-model="form.password"
                                    />
                                    <p style="color:red" id="password"></p>
                                </div>
                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="lock" /></span>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="Re-type Password"
                                        v-model="form.password_confirmation"
                                    />
                                    <p style="color:red" id="password_confirmation"></p>
                                </div>

                                <div class="input_field radio_option">
                                    <input
                                        type="radio"
                                        name="gender"
                                        id="rd1"
                                        value="Male"
                                        v-model="form.gender"
                                    />
                                    <label for="rd1">Male</label>
                                    <input
                                        type="radio"
                                        name="gender"
                                        id="rd2"
                                        value="Female"
                                        v-model="form.gender"
                                    />
                                    <label for="rd2">Female</label>
                                    <p style="color:red" id="gender"></p>
                                </div>

                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="cog" /></span>
                                    <textarea
                                        type="text"
                                        name="interest"
                                        placeholder="interest"
                                        v-model="form.interest"
                                    ></textarea>
                                    <p style="color:red" id="interest"></p>
                                </div>

                                <div class="input_field">
                                    <span
                                        ><font-awesome-icon icon="camera" /></span>
                                    <input
                                        type="file"
                                        name="image"
                                        placeholder="Profile"
                                    />

                                </div>

                                <input
                                    class="button"
                                    type="submit"
                                    value="Register"
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const form = ref({
    name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
    gender: "",
    interest: "",
});
const errors = reactive({});

const register = async () => {
    try {
        const response_register = await axios.post("api/register", {
            name: form.value.name + ' ' + form.value.last_name,
            email: form.value.email,
            password: form.value.password,
            password_confirmation: form.value.password_confirmation,
            gender: form.value.gender,
            interest: form.value.interest,
        });

        if (response_register.data.status === true) {
            router.push("login");
        } else {
            console.log(response_register.data);

            errors.value = response_register.data.message;
            // errors.forEach(errorArray);
        }
    } catch (error) {
       console.log(error);
    }

    // function errorArray(message, index ) {
    //     console.log(message);
    //     console.log(index);
    //     text += index + ": " + message + "<br>";
    //     document.getElementById("name").innerHTML = text;

    // }
};


</script>

<style lang="scss" scoped>
@import "../../css/app.css"; /* injected */
</style>
