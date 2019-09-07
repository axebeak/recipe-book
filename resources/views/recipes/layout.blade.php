@include('header')

<body>
<header class="row">
    <div class="col mt-3 mb-3"><a href="/recipes"><i class="fa fa-book" aria-hidden="true"></i> Книга Рецептов</a></div>
    <div class="log-out col mt-3 mb-3 text-right"><a href="/recipes"><i class="fa fa-sign-out" aria-hidden="true"></i> Выход</a></div>
</header>
<div class="row">
    <nav class="h-100 col col-xl-4 mt-2 text-justify">
        <div class="p-2 m-2 navigation-item"><a href="/recipes"><i class="fa fa-cutlery" aria-hidden="true"></i> <span class="ml-3">Мои Рецепты</span></a></div>
        <div class="p-2 m-2 navigation-item"><a href="/ingredients"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> <span class="ml-3">Мои ингредиенты</span></a></div>
    </nav>
    <div class="col">
        @yield('content')
    </div>
</div>

</body>