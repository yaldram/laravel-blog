<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <style>
     body#bg-img {
      background: url({{ asset('background.jpg')  }});
    }
    .menu-branding .protrait {
      width: 250px;
      height: 250px;
      background: url({{ asset('yaldram.JPG')  }});
      background-size: cover;
      border-radius: 50%;
      border: solid 3px #eece1a; 
    }

    @media screen and (max-width: 768px) {
       .menu-branding .protrait {
          background: url({{ asset('yaldram.JPG')  }});
          background-size: cover;
       }
      }
  </style>
  <title>View My Work</title>
</head>

<body>
  <header>
    <div class="menu-btn">
      <div class="btn-line"></div>
      <div class="btn-line"></div>
      <div class="btn-line"></div>
    </div>

    <nav class="menu">
      <div class="menu-branding">
        <div class="protrait"></div>
      </div>
      <ul class="menu-nav">
        <li class="nav-item">
          <a href="{{ route('index') }}" class="nav-link">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about') }}" class="nav-link">
            About Me
          </a>
        </li>
        <li class="nav-item current">
          <a href="{{ route('work') }}" class="nav-link">
            My Work
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('contact') }}" class="nav-link">
            How To Reach Me
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            Blog
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('resume') }}" class="nav-link">
            Resume
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <main id="work">
    <h1 class="lg-heading">
      My
      <span class="text-secondary">Work</span>
    </h1>
    <h2 class="sm-heading">
      Check out some of my projects...
    </h2>
    <div class="projects">
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/php.jpg') }}" alt="Project">
        </a>
        <a href="" class="btn-light">
          <i class="fas fa-eye"></i> Not yet Deployed
        </a>
        <a href="https://github.com/yaldram/simple-php-oops" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
        <p>Php MVC Framework with Object-Oriented Programming.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/laravel.jpg') }}" alt="Project">
        </a>
        <a href="http://devyaldram.com" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="https://github.com/yaldram/Laravel-Blog" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>A fully-featured blog with Laravel, having multi-authentication.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/GraphQL.png') }}" alt="Project">
        </a>
        <a href="https://node-sequelize-graphql.herokuapp.com/" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="https://github.com/yaldram/Api-with-Node-GraphQL-Yoga" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>A GraphQl Backend for a fully-featured blog, with jwt Authentication.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/rest.png') }}" alt="Project">
        </a>
        <a href="https://node-knex-api.herokuapp.com/blog" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="https://github.com/yaldram/A-REST-API-with-Knex-Query-Builder" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>A fully featured Blog Rest Api with Multi-authentication, rest passwords, emails, etc.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/react-redux.png') }}" alt="Project">
        </a>
        <a href="https://thirsty-jones-7f8869.netlify.com/" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="https://github.com/yaldram/React-Redux-Blog" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>A fully featured Blog with React-Redux using Redux Forms querying a REST API.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/feathers.png') }}" alt="Project">
        </a>
        <a href="" class="btn-light">
          <i class="fas fa-eye"></i> Not yet deployed
        </a>
        <a href="https://github.com/yaldram/Introduction-To-FeathersJs" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>A real-time question answer app with feathers js and oAuth(github.com).</p>
      </div>
         <div class="item">
        <a href="#!">
          <img height="250px" src="{{ asset('projects/sequelize.png') }}" alt="Project">
        </a>
        <a href="https://github.com/yaldram/sequelize-async-await-api" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="https://sequelize-api-async-await.herokuapp.com/api/posts/list" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>Blog Rest Api using Sequelize ORM using async-await.</p>
      </div>
    </div>
  </main>

  <footer id="main-footer">
    Copyright &copy; 2018
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
