@extends("admin/admin-index")

@section('small_content')
<h4>Category List</h4>
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
            <td>Category Name</td>
        </tr>
        <tr>
            <form method="POST" action="/admin/add_category">
                @csrf
                <td class="table-dark col-2">
                    <input type="text" name="prd_name_add" placeholder="Enter category name">
                </td>
                <td>
                    <button class="btn btn-dark" type="submit">Add</button>
                </td>
            </form>
        </tr>
    </table>
    <form method="POST" action="/admin/category_list" class="d-flex" role="search">
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
            <td>Category Name</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $obj)
            <tr>
                @if($route == "admin/category_list")
                    <td>{{$obj->id}}</td>
                    <td>{{$obj->category_name}}</td>
                @elseif($route == "admin/edit_category")
                    <td>{{$obj->id}}</td>
                    <td>
                        <input type="text" id="cate_name" value="{{$obj->category_name}}">
                    </td>
                @endif
                    <td>
                        <form method="POST" action="/admin/delete_category">
                            @csrf
                            <input type="hidden" name="cate_id" value="{{$obj->id}}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @if($route == "admin/category_list")
                    <td>
                        <button type="button" class="btn btn-outline-success"><a style="text-decoration: none;color: darkgreen" href="/admin/edit_category">Edit</a></button>
                    </td>
                @elseif($route == "admin/edit_category")
                    <td>
                        <form method="POST" id="myForm{{$obj->id}}" action="/admin/edit_category">
                            @csrf
                            <input type="hidden" name="cate_idd" value="{{$obj->id}}">
                            <button type="submit" class="btn btn-success" onclick="save({{$obj->id}})">Save</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('custom_js')
    <script>
        function save(cateID) {
            const externalInput = document.getElementById('cate_name');
            const form = document.getElementById('myForm'+cateID);

            form.addEventListener('submit', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Get the value from the external input field
                const externalValue = externalInput.value;

                // Create a hidden input field dynamically
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'cate_name';
                hiddenInput.value = externalValue;

                // Append the hidden input field to the form
                form.appendChild(hiddenInput);

                // Submit the form programmatically
                form.submit();
            });
        }
    </script>
@endsection
