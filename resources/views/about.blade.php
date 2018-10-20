<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <title>About Me</title>
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
        <li class="nav-item current">
          <a href="{{ route('about') }}" class="nav-link">
            About Me
          </a>
        </li>
        <li class="nav-item">
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

  <main id="about">
    <h1 class="lg-heading">
      About
      <span class="text-secondary">Me</span>
    </h1>
    <h2 class="sm-heading">
      Let me tell you a few things...
    </h2>
    <div class="about-info">
      <img src="{{ asset('portrait.jpg') }}" alt="John Doe" class="bio-image">

      <div class="bio">
        <h3 class="text-secondary">BIO</h3>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt magni nam nisi quae vitae? Quod molestiae ipsa
          autem natus eum vel ducimus nulla harum voluptatem eligendi! Unde, reiciendis? Praesentium, laborum.</p>
      </div>

      <div class="job job-1">
        <h3>123 Webshop</h3>
        <h6>Full Stack Developer</h6>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates perferendis totam enim. Nesciunt porro dolores
          expedita dolor necessitatibus deserunt nemo.</p>
      </div>

      <div class="job job-2">
        <h3>Designers ABC</h3>
        <h6>Front End Developer</h6>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates perferendis totam enim. Nesciunt porro dolores
          expedita dolor necessitatibus deserunt nemo.</p>
      </div>

      <div class="job job-3">
        <h3>Webworks</h3>
        <h6>Graphic Designer</h6>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates perferendis totam enim. Nesciunt porro dolores
          expedita dolor necessitatibus deserunt nemo.</p>
      </div>
    </div>
  </main>

  <footer id="main-footer">
    Copyright &copy; 2018
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
