<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Blog Template · Bootstrap v5.0</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
  </head>
  <body id="app" v-cloak >
    <style>
        [v-cloak]{
            display: none;
        }
    </style>
    
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="link-secondary" href="#">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"></circle><path d="M21 21l-5.2-5.2"></path></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 link-secondary" href="#">World</a>
      <a class="p-2 link-secondary" href="#">U.S.</a>
      <a class="p-2 link-secondary" href="#">Technology</a>
      <a class="p-2 link-secondary" href="#">Design</a>
      <a class="p-2 link-secondary" href="#">Culture</a>
      <a class="p-2 link-secondary" href="#">Business</a>
      <a class="p-2 link-secondary" href="#">Politics</a>
      <a class="p-2 link-secondary" href="#">Opinion</a>
      <a class="p-2 link-secondary" href="#">Science</a>
      <a class="p-2 link-secondary" href="#">Health</a>
      <a class="p-2 link-secondary" href="#">Style</a>
      <a class="p-2 link-secondary" href="#">Travel</a>
    </nav>
  </div>
</div>
<button type="button" class="btn btn-primary" @click="fetch_data">Fetch news</button>
<main class="container" v-if="success">
  <div class="row mb-2">
  <div  id="post_body" class="row m-0"> 
      
  </div>
    
    
  </div>

 
</main>


    
  

</body>
<script src="https://unpkg.com/vue@next"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"> </script>
    <script src="js/bootstrap.js"></script>
    <script>
        const app = Vue.createApp({
            data: () => ({
                posts: [],
                limit:10,
                success: false
                
            }),
            methods: {
                fetch_data: async function() {
                    var count = this.limit;
                    this.success = true;
                    let one = "https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty";
                        axios.get(one)
                        .then(function (response) {
                          console.log(response.data);
                            for (let i = 0; i < count; i++) {
                                axios.get("https://hacker-news.firebaseio.com/v0/item/"+response.data[i]+".json?print=pretty")
                                .then(function (response) {
                                    console.log(response.data);
                                    $("#post_body").append('<div class="col-md-6"><div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"><div class="col p-4 d-flex flex-column position-static"><strong class="d-inline-block mb-2 text-primary">By '+response.data.by+'</strong><h3 class="mb-0">'+response.data.title+'</h3><div class="mb-1 text-muted">Nov 12</div><p class="card-text mb-auto">'+response.data.type+'</p><a href="'+response.data.url+'" target="_blank" class="stretched-link">Continue reading</a></div><div class="col-auto d-none d-lg-block"><svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg></div></div>');
                                }).catch(function (error) {
                                    console.log(error);
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    
                    
                }
            }
        });
        
        app.mount('#app');        


       
        
    </script>


</body>

</html>