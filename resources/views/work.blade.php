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
      background: url({{ asset('portrait.jpg')  }});
      border-radius: 50%;
      border: solid 3px #eece1a; 
    }

    @media screen and (max-width: 768px) {
       .menu-branding .protrait {
          background: url({{ asset('portrait.jpg')  }});
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
          <img src="{{ asset('background.jpg') }}" alt="Project">
        </a>
        <a href="#" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="#" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img src="{{ asset('background.jpg') }}" alt="Project">
        </a>
        <a href="#" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="#" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img src="{{ asset('background.jpg') }}" alt="Project">
        </a>
        <a href="#" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="#" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img src="{{ asset('background.jpg') }}" alt="Project">
        </a>
        <a href="#" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="#" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="item">
        <a href="#!">
          <img src="{{ asset('background.jpg') }}" alt="Project">
        </a>
        <a href="#" class="btn-light">
          <i class="fas fa-eye"></i> Project
        </a>
        <a href="#" class="btn-dark">
          <i class="fab fa-github"></i> Github
        </a>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
    </div>
  </main>

  <footer id="main-footer">
    Copyright &copy; 2018
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
