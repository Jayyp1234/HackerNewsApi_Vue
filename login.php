<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
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
            <h4>Login Form</h4>
            <div>
                <form action="" @submit.prevent="login" method="" autocomplete="off">
                    
                    <div>
                        <label for="" class="form-label">Email</label>
                        <input type="email" v-model="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password:</label>
                        <input type="password" v-model="password" name="password" class="form-control">
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
                email:'',
                password: '',
                error: null,
                success: false
            }),
            methods: {
                login: async function() {
                    const auth = {  
                        email:this.email,
                        password: this.password 
                    };
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if (filter.test(this.email)) {
                        this.error = null;
                        axios({
                            method: 'post',
                            url: './api/login.php',
                            data: auth
                        })
                        .then(function (response) {
                            console.log(response.data);
                            if (response.data.status == true){
                                swal("Success", "Login Succesful", "success").then((value) => {
                                window.location.href ='./dashboard.php';
                                });
                            }
                            else{
                                
                                this.error = response.data.email;
                                swal("Invalid Credientials", (response.data.email,response.data.password), "warning");
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                        
                    }
                    else{
                        swal("Invalid Credientials", "Please provide a valid email address and password", "warning");
                    }
                    
                    
                }
            }
        });
        app.mount('#app');        


       
        
    </script>


</body>

</html>