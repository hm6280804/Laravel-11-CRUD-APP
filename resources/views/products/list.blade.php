<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>

      .bg-light-blue {
            background-color: #e3f2fd;
            animation: colorChange 5s infinite alternate;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow effect */
            font-family: 'Gloria Hallelujah', cursive; /* Specify curved font */
            font-weight: bold; /* Make the text bold */
        }

      .text-dark-blue {
            color: #0d47a1;
        }


      .btn-custom {
        background-color: #0d47a1;
        color: white;
      }
      
      .btn-custom:hover {
        background-color: #1565c0;
        color: white;
      }

      .card-header-custom {
        background-color: #42a5f5;
        color: white;
      }

      .table-hover tbody tr:hover {
        background-color: #f1f1f1;
      }

      .fade-in {
        animation: fadeIn 2s;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      .animate-text {
        display: inline-block;
        animation: slide-in-out 5s infinite alternate;
      }
      @keyframes slide-in-out {
        0% {
          transform: translateX(-100%);
        }
        100% {
          transform: translateX(100%);
        }
      }
      .overflow-hidden {
        overflow: hidden;
      }
      
        @keyframes colorChange {
            0%, 100% {
                color: #0d47a1; /* Starting and ending color */
            }
            50% {
                color: #4caf50; /* Color change to green */
            }
            75% {
                color: #ffeb3b; /* Color change to yellow */
            }
        }
    </style>
  </head>
  <body>

    <div class="bg-light-blue py-3 fade-in">
        <h3 class="text-dark-blue text-center">Laravel 11 simple CRUD</h3>
    </div>

    <div class="container">

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-custom">Create</a>
            </div>
        </div>

        <div class="row justify-content-center">
                @if (session('success'))
                    <div class="col-md-10 mt-3">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>  
                @endif
            
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4 fade-in">
                    <div class="card-header card-header-custom">
                        <h3 class="text-white animate-text">Products</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->image != '')
                                            <img src="{{ asset('uploads/products/'.$product->image) }}" width="50" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-custom">Edit</a>
                                        <a onclick="deleteProduct({{ $product->id }});" href="#" class="btn btn-danger">Delete</a>
                                        <form action="{{ route('products.delete',$product->id) }}" method="POST" id="delete-product-from{{ $product->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif   
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

  </body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure you want to delete the product?")){
            document.getElementById("delete-product-from" + id).submit();
        }
    }
</script>
