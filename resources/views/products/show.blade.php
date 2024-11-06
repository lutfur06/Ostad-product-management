<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .product-image {
            max-width: 100%;
            height: auto;
        }
        .product-details {
            margin-top: 20px;
        }
        .product-title {
            font-size: 24px;
            font-weight: bold;
        }
        .product-price {
            font-size: 20px;
            color: #28a745;
        }
        .add-to-cart {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="product-image img-fluid">
            </div>
            <div class="col-md-6 product-details">
                <h2 class="product-title">{{ $product->name }}</h2>
                <p class="product-price">${{ $product->price }}</p>
                <p>
                    <strong>Description:</strong>
                    <br>
                    {{ $product->description }}
                </p>
                <p>
                    <strong>Stock:</strong> {{ $product->stock }}
                </p>
                <p>
                    <strong>SKU:</strong> {{ $product->product_id }}
                </p>
                <div class="add-to-cart">
                    <button class="btn btn-primary btn-lg"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
        </div>
        </div>
        </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
