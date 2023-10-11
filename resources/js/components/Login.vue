<template>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Login Form</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="form_wrapper">
                <div class="form_container">
                    <div class="title_container">
                        <h2>Login Form</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="">
                            <form @submit.prevent="login()">
                                    <div class="input_field"> <span><font-awesome-icon icon="envelope" /></span>
                                        <input type="text" name="email" placeholder="Email" v-model="email"/>

                                            <div v-if="v$.email.$error">
                                                <p v-if="v$.email.required">
                                                    <strong style="color:red;">{{ v$.email.required.$message }}</strong>
                                                </p>
                                                <p v-if="v$.email.email">
                                                    <strong style="color:red;">{{ v$.email.email.$message }}</strong>
                                                </p>
                                            </div>

                                    </div>
                                    <div class="input_field"> <span><font-awesome-icon icon="lock" /></span>
                                        <input type="password" name="password" placeholder="Password" v-model="password"/>

                                            <div v-if="v$.password.$error">
                                                <p v-if="v$.password.required">
                                                    <strong style="color:red;">{{ v$.password.required.$message }}</strong>
                                                </p>
                                            </div>
                                            <!-- <div v-if="v$.password.$error">
                                                <strong style="color:red;">{{ error.$property }} {{ error.$message }}</strong>
                                            </div> -->

                                    </div>

                                <input class="button" type="submit" value="Login" />
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { email, required } from '@vuelidate/validators'
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup: () => ({ v$: useVuelidate()}),
  data: () => ({ password: '' ,email: ''}),
  validations () {
    return {
        password: { required },
        email:{ required, email}
    }
  },

  methods: {

    async login () {

        const result = await this.v$.$validate()
        if (!result) {
            // alert("not validate");
            return
        }
        // alert("successfull")

        try {

            axios.post('api/login', {
                email: this.email,
                password: this.password
            }).then((res) => {

                if(res.data.status === true){
                    const token = res.data.data.token
                    const user_id = res.data.data.id;
                    console.log(user_id)
                    localStorage.setItem('token', token);
                    this.$router.push({ name: 'dashboard', params: { user_id :user_id}});
                    // router.push({ name: 'dashboard', params: 2 });
                }
            })
            .catch((error) => {
                // error.response.status Check status code
            });

        } catch (error) {
            console.error('Error:', error);
        }
    }
  }
}
</script>

<style lang="scss" scoped>
  @import '../../css/app.css'; /* injected */
</style>
