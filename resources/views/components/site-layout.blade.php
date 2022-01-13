<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $title }}</title>
	<meta name="author" content="name">
	<meta name="description" content="description here">
	<meta name="keywords" content="keywords,here">
		        <!-- Fonts -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

 <!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
</head>

<body class="bg-gray-400 font-sans leading-normal tracking-normal">
	<!--Nav-->
	<nav class="bg-gray-800 p-2 mt-0 w-full"> <!-- Add this to make the nav fixed: "fixed z-10 top-0" -->
		<div class="container mx-auto flex flex-wrap items-center">
			<div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
				<a class="text-white no-underline hover:text-white hover:no-underline" href="#">
					<span class="text-2xl pl-2"> Real Estate Selling System</span>
				</a>
			</div>
			<x-site-right-menu/>
		</div>
	</nav>

	<!--Hero-->
	<div class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24">
        {{ $slot }}
        <!--Left Col-->
	</div>
</body>
</html>
