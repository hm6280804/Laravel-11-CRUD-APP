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
    </style>
  </head>
  <body>

    <div class="bg-light-blue py-3 fade-in">
        <h3 class="text-dark-blue text-center">Laravel 11 simple CRUD</h3>
    </div>

    <div class="container">

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-custom">Back</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4 fade-in">
                    <div class="card-header card-header-custom">
                        <h3 class="text-white animate-text">Edit Product</h3>
                    </div>
                    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input type="text" value="{{ old('name', $product->name) }}" class="@error('name') is-invalid @enderror form-control form-control-lg" name="name" placeholder="Name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Sku</label>
                                <input type="text" value="{{ old('sku', $product->sku) }}" class="@error('sku') is-invalid @enderror form-control form-control-lg" name="sku" placeholder="Sku">
                                @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Price</label>
                                <input type="text" value="{{ old('price', $product->price) }}" class="@error('price') is-invalid @enderror form-control form-control-lg" name="price" placeholder="Price">
                                @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea name="description" class="form-control form-control-lg" cols="30" rows="5" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image">
                                @if ($product->image != '')
                                    <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-thumbnail w-25 my-3">
                                @endif
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-custom">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>
