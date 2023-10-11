<template>
  <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Registration Form</h1>
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
                            <Form @submit.prevent="saveData()">
                                <div class="row clearfix">
                                    <div class="col_half">
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                            <Field type="text" name="name" v-model="data.name" placeholder="First Name" :rules="isRequired" />
                                            <p><ErrorMessage style="color:red" class="form-required" name="name" /></p>
                                        </div>
                                    </div>

                                    <div class="col_half">
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                            <Field type="text" name="last_name" v-model="data.last_name"  placeholder="Last Name" :rules="isRequired" />
                                            <p><ErrorMessage style="color:red" class="form-required" name="last_name" /></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                    <Field type="email" name="email" placeholder="Email" v-model="data.email" :rules="isRequired"  />
                                    <p><ErrorMessage style="color:red" class="form-required" name="email" /></p>
                                </div>


                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                    <Field type="password" name="password" placeholder="Password" v-model="data.password" :rules="isRequired"  />
                                    <p><ErrorMessage style="color:red" class="form-required" name="password" /></p>
                                </div>

                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                    <Field type="password" name="password_confirmation" placeholder="Re-type Password" v-model="data.password_confirmation" :rules="isRequired"/>
                                    <p><ErrorMessage style="color:red" class="form-required" name="password_confirmation" /></p>
                                </div>

                                <div class="input_field radio_option">
                                    <input type="radio" name="gender" id="rd1" value="Male" v-model="data.gender"  checked>
                                    <label for="rd1">Male</label>
                                    <input type="radio" name="gender" id="rd2" value="Female" v-model="data.gender" >
                                    <label for="rd2">Female</label>
                                </div>

                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                    <textarea type="text" name="interest" placeholder="interest" v-model="data.interest" :rules="isRequired"></textarea>
                                    <p><ErrorMessage style="color:red" class="form-required" name="interest" /></p>
                                </div>


                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                    <input type="file" name="image" placeholder="Profile">
                                </div>

                                <input class="button" type="submit" value="Register" />
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import { ref } from 'vue';
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router';

export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    data() {
        return {
            'data': {
                'name':'',
                'last_name':'',
                'email':'',
                'interest':'',
                'password':'',
                'password_confirmation':'',
                'gender':''
            },
            route: useRoute(),
            router: useRouter(),
        };
    },

    methods: {
        isRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'This is required';
        },
         validateEmail(value) {

            if (!value) {
                return 'This field is required';
            }

            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return 'This field must be a valid email';
            }

            return true;
        },
        async saveData() {

            try {
                const response = await axios.post('api/register', {
                name: this.data.name,
                email: this.data.email,
                password: this.data.password,
                password_confirmation: this.data.password_confirmation,
                gender: this.data.gender,
                interest: this.data.interest
                });

                if (respose_register.data.status === true) {
                    route.push('login_vue');
                } else {
                    console.log("Registration failed: " + respose_register.data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
};
</script>
