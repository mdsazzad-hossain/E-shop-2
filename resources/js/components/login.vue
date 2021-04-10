<template>
    <div class="login-box offset-4">
        <div class="login-logo">
            <a href="#"><b>Admin</b>Login</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form @submit.prevent="login()" @keydown="form.onKeydown($event)">
                <div class="input-group mb-3">
                    <input type="email" v-model="form.email" class="form-control" placeholder="Email"
                    :class="{ 'is-invalid': form.errors.has('email') }">

                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <has-error :form="form" field="email"></has-error>
                </div>
                <div class="input-group mb-3">
                    <input type="password" v-model="form.password" class="form-control"
                    placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">

                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <has-error :form="form" field="password"></has-error>
                </div>
                <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <router-link to="/register" class="text-center">Register a new account</router-link>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</template>

<script>
import jwt from "jsonwebtoken";
    export default {
        data(){
            return{
                form : new Form({
                    email:"",
                    password:""
                })
            };
        },
        methods:{
            login(form){
                this.form.post('api/login')
                .then((response)=>{
                    // var token = jwt.sign(
                    //     { form: form },
                    //     "@e#shop$%da&!sss&2020@#PrOjeCt"
                    // );
                    //   var auth = `${authUser}`;
                    window.location.reload();
                    localStorage.setItem("e-shop-sss", response.data.access_token);

                    this.$router.push("/dashboard");

                    Toast.fire({
                        icon: "success",
                        title: "Login Successfull."
                    });
                })
                .catch(()=>{
                    Swal.fire({
                        'icon': "warning",
                        'title': "wrong creidentials!"

                    });
                })

            }
        }
    }
</script>

