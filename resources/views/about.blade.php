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
      <img style="height: auto; width: 100%;" src="{{ asset('yaldram.jpg') }}" alt="Arsalan Yaldram" class="bio-image">

      <div class="bio">
        <h3 class="text-secondary">BIO</h3>
        <p>Hard-working web developer with a flair for creating elegant solutions in the least amount of time. Developed solutions in PHP, Node.js. Also intrested in History of Philosophy and Religions.</p>
      </div>

      <div class="job job-1">
        <h3>PHP</h3>
        <h6>Back End Developer</h6>
        <p>I have worked with php since 2017 it was my first take on web development and really love working with php. Object oreiented Php really changed things around and Laravel was my choice as always for great PHP Apps.</p>
      </div>

      <div class="job job-2">
        <h3>Node JS</h3>
        <h6>Back End Developer</h6>
        <p>Building Rest Apis with Node is always a task that i would take up immediately if given. Securing Rest Apis, OAuth2, file uploads, sending Email and yes Graphql. GraphQL is my love.</p>
      </div>

      <div class="job job-3">
        <h3>React-Redux-Apollo-CLient</h3>
        <h6>Front End Developer</h6>
        <p>On the Front i started working with React during my final year exams i used to always give some time to react even during my exam studies. React has always been my front-end choice. But i would also try Angular, Vue, HyperApp especially HyperApp in the near future.</p>
      </div>
    </div>
  </main>

  <footer id="main-footer">
    Copyright &copy; 2018
  </footer>

  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
