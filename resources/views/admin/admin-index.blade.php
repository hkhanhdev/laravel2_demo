@extends('header_footer')


@section("content")
    <a href="/" class="bold">Home</a>
    <h1 class="text-center">ADMIN PAGE</h1>
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/category_list">Category List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/product_list">Product List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('small_content')
{{--    @include("admin.category-list")--}}
@endsection
