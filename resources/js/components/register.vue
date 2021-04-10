<template>
    <div class="register-box offset-4">
        <div class="register-logo">
            <a href="#"><b>Admin</b>Register</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form @submit.prevent="register()" @keydown="form.onKeydown($event)">
                <div class="input-group mb-3">
                <input v-model="form.name" type="text" class="form-control" placeholder="Full name"
                :class="{ 'is-invalid': form.errors.has('name') }">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>
                    </div>
                </div>
                <has-error :form="form" field="name"></has-error>
                </div>
                <div class="input-group mb-3">
                <input v-model="form.email" type="email" class="form-control" placeholder="Email"
                :class="{ 'is-invalid': form.errors.has('email') }">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <has-error :form="form" field="email"></has-error>
                </div>
                <div class="input-group mb-3">
                <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                :class="{ 'is-invalid': form.errors.has('password') }">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                <has-error :form="form" field="password"></has-error>
                </div>
                <div class="input-group mb-3">
                <input v-model="form.re_password" type="password" class="form-control" placeholder="Retype password"
                :class="{ 'is-invalid': form.errors.has('re_password') }">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                <has-error :form="form" field="re_password"></has-error>
                </div>
                <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
                </a>
            </div>

            <router-link to="/" class="text-center">I already have an account</router-link>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form: new Form({
                name:"",
                email:"",
                password:"",
                re_password:""

            })
        };
    },

    methods:{
        register(){
            this.form.post("api/register")
            .then((response)=>{
                this.$router.push("/");
            Toast.fire({
                    icon: "success",
                    title: "Registration Successfull."
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

<style>

</style>
