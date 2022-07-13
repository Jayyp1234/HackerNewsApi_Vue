<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/css/boxicons.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body id="app" v-cloak>
    <style>
        [v-cloak]{
            display: none;
        }
    </style>
    <main>
        <div class="">
            <h4>Form</h4>
            <div>
                <form action="" @submit.prevent="register" method="" autocomplete="off">
                    <div>
                        <label for="" class="form-label">Name</label>
                        <input type="text" v-model="name" class="form-control">
                    </div>
                    <div>
                        <label for="" class="form-label">Email</label>
                        <input type="email" v-model="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password:</label>
                        <input type="password" v-model="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Corfirm Password:</label>
                        <input type="password" v-model="conpassword"  name="conpassword" class="form-control">
                    </div>
                    <div v-if="error">
                        {{error}}
                    </div>
                    <div class="submit col-12 col-md-10 mx-auto">
                        <div class="col-md-6 text-center mx-auto">
                            <button type="submit">
                                <span>Submit</span>
                                <i class="bx bx-arrow-back"></i>
                            </button>
                        </div>
                    </div>
                </form>


    </main>




    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"> </script>
    <script src="js/bootstrap.js"></script>
    <script>
        const app = Vue.createApp({
            data: () => ({
                name: '',
                email:'',
                password: '',
                conpassword: '',
                error: null,
                success: false
            }),
            methods: {
                register: async function() {
                    const auth = { 
                        name: this.name, 
                        email:this.email,
                        password: this.password 
                    };
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if (this.password == this.conpassword){
                        this.success = false;
                        this.error = null;
                        axios({
                            method: 'post',
                            url: './api/register.php',
                            data: auth
                        })
                        .then(function (response) {
                            console.log(response.data);
                            if (response.data.status == true){
                                swal("Success", "Account created successfully", "success").then((value) => {
                                window.location.href ='./login.php';
                                });
                            }
                            else{
                                this.error = response.data.email;
                                swal("Invalid Email Address", response.data.email, "warning");
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                        this.success = true;
                    }
                    else if (!filter.test(email.value)) {
                        swal("Invalid Email Address", "Please provide a valid email address", "warning");
                    }
                    else{
                        swal("Password Mismatch", "Please Try again", "warning");
                    }
                    
                    
                }
            }
        });
        app.mount('#app');        


       
        
    </script>


</body>

</html>