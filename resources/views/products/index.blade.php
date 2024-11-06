
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Products Managementgit Project</h1>


            <div class="display1">
                <form action="{{'/products/search'}}" method="GET">
                    <input class="search" type="text" name="search" placeholder="Search"/>
                </form>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort By
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('products.index', ['sort' => 'name', 'order' => 'asc'])}}">Name Asc</a>
                        <a class="dropdown-item" href="{{route('products.index', ['sort' => 'name', 'order' => 'desc'])}}">Name Desc</a>
                        <a class="dropdown-item" href="{{route('products.index', ['sort' => 'price', 'order' => 'asc'])}}">Price Asc</a>
                        <a class="dropdown-item" href="{{route('products.index', ['sort' => 'price', 'order' => 'desc'])}}">Price Desc</a>
                    </div>
                </div>
                <a class="create" href="{{route('products.create')}}">Create</a>

            </div>

            <table id="myTable" class="display text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>

                    <th>Name <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            <i class="fas fa-sort"></i>
                        </a></th>
                    <th>Price <a href="{{ route('products.index', ['sort_by' => 'price', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            <i class="fas fa-sort"></i>
                        </a></th>
                    <th>Description</th>

                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>

                        <td>{{ $product->description }}</td>

                        <td>{{ $product->stock }}</td>
                        <td><img src="{{asset('images/'.$product->image)}}" alt="" width="80px"></td>
                        <td class="flex flex-row justify-center items-center">
                            <a href="{{route('products.show', $product->id)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                            <div style="display: inline-block">
                                <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>

                        </td>
                    </tr>

                @endforeach


                <!-- Add more rows as needed -->
                </tbody>
            </table>
            <div>
                {{ $products->appends(['sort' => $sortBy, 'order' => $sortOrder])->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


</body>
</html>

