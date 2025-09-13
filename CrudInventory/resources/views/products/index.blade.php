<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">InventoryApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- ✅ Link back to homepage -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Go To Homepage</a>
                    </li>
                    
                    <!-- Already here: Products menu -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('products.index') }}">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Inventory Management</h1>

    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search product...">
        <button type="submit">Search</button>
    </form>

    <form action="{{ route('products.create') }}" method="GET" style="display:inline;">
        <button type="submit" class="btn btn-primary">Add Products</button>
    </form>

    <table border="1" cellpadding="10" style="margin-top:20px;">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($Products as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
            <td>
                @if ($product->status == 1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <!-- Edit Button -->
                <form action="{{ route('products.edit', $product->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                <!-- </form>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                </form> -->
                <!-- Delete Button -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
