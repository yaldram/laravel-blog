<!DOCTYPE html>
<html>
<head>
	<title>Protfolio</title>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<style>
	  body#bg-img {
      background: url({{ asset('background.jpg')  }});
    }
    .menu-branding .protrait {
      width: 250px;
      height: 250px;
      background: url({{ asset('yaldram.jpg')  }});
      background-size: cover;
      border-radius: 50%;
      border: solid 3px #eece1a; 
    }

    @media screen and (max-width: 768px) {
       .menu-branding .protrait {
         background: url({{ asset('yaldram.jpg')  }});
         background-size: cover;
       }
      }
  </style>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body id="bg-img">
	<header>
		<div class="menu-btn">
			<div class="btn-line"></div>
			<div class="btn-line"></div>
			<div class="btn-line"></div>
		</div>
		
		<nav class="menu">
			<div class="menu-branding">
				<div class="protrait">
				</div>
			</div>
			<ul class="menu-nav">
        <li class="nav-item current">
          <a href="{{ route('index') }}" class="nav-link">
            Home
          </a>
        </li>
        <li class="nav-item">
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
         <li class="nav-item">
          <a href="{{ route('resume') }}" class="nav-link">
            Resume
          </a>
        </li>
      </ul>		</nav>
	</header>	

	<main id="home">
		<h1 class="lg-heading">
			Arsalan <span class="text-secondary">Yaldram</span>
		</h1>
		<h2 class="sm-heading">
			Web Developer, Programmer, Philosphy Geek
		</h2>
		<div class="icons">
			<a href="">
				<i class="fab fa-twitter fa-2x"></i>
			</a>
			<a href="">
				<i class="fab fa-facebook fa-2x"></i>
			</a>
			<a href="">
				<i class="fab fa-linkedin fa-2x"></i>
			</a>
			<a href="">
				<i class="fab fa-github fa-2x"></i>
			</a>
		</div>
	</main>
</body>
<script src="{{ asset('js/main.js') }}"></script>
</html>
