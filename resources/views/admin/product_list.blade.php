@extends('admin/admin-index')

@section('small_content')
    <h4>Product List</h4>
    <br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-sm d-flex justify-content-between align-items-center" >
        <table class="table table-borderless">
            <tr>
                <td>Product Name</td>
            </tr>
            <tr>
                <form method="POST" action="/admin/add_product">
                    @csrf
                    <td class="table-dark col-2">
                        <input type="text" name="prd_name_add" placeholder="Enter product name">
                    </td>
                    <td>
                        <button class="btn btn-dark" type="submit">Add</button>
                    </td>
                </form>
            </tr>
        </table>
        <form method="POST" action="/admin/product_list" class="d-flex" role="search">
            @csrf
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <input type="hidden" name="whereAmI" value="{{$route}}">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
    <br>
    <br>
    <table class="table table-hover table-bordered table-striped">
        <thead>
        <tr>
            <td>Id</td>
            <td>Product Name</td>
        </tr>
        </thead>
        <tbody>
        @if($products != null)
        @foreach($products as $obj)
            <tr>
                @if($route == "admin/product_list")
                    <td>{{$obj->id}}</td>
                    <td>{{$obj->prd_name}}</td>
                @elseif($route == "admin/edit_product")
                    <td>{{$obj->id}}</td>
                    <td>
                        <input type="text" id="prd_name_{{$obj->id}}" value="{{$obj->prd_name}}">
                    </td>
                @endif
                    <td>
                        <form method="POST" action="/admin/delete_product">
                            @csrf
                            <input type="hidden" name="prd_id" value="{{$obj->id}}">

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                @if($route == "admin/product_list")
                    <td>
                        <button type="button" class="btn btn-outline-success"><a style="text-decoration: none;color: darkgreen" href="/admin/edit_product">Edit</a></button>
                    </td>
                @elseif($route == "admin/edit_product")
                    <td>
                        <form method="POST" id="myForm{{$obj->id}}" action="/admin/edit_product">
                            @csrf

                            <input type="hidden" name="prd_idd" value="{{$obj->id}}">
                            <button type="submit" class="btn btn-success" onclick="save({{$obj->id}})">Save</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        @else
            <tr>
                <td>No records found!</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection

@section("custom_js")
    <script>
        function save(productId) {
            const externalInput = document.getElementById('prd_name_' + productId);
            const form = document.getElementById('myForm'+productId);

            form.addEventListener('submit', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Get the value from the external input field
                const externalValue = externalInput.value;

                // Create a hidden input field dynamically
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'prd_name';
                hiddenInput.value = externalValue;

                // Append the hidden input field to the form
                form.appendChild(hiddenInput);

                // Submit the form programmatically
                form.submit();

            });
        }
    </script>
@endsection


