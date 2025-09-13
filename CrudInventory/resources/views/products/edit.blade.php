<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')
        Name: <input type="text" name="name" value="{{ $product->name }}"><br><br>
        Quantity: <input type="number" name="quantity" value="{{ $product->quantity }}"><br><br>
        Price: <input type="text" name="price" value="{{ $product->price }}"><br><br>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>

    <a href="{{ route('products.index') }}">Back</a>
</body>
</html>
