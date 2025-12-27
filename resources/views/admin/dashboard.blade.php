<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mama Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Mama Orders - Admin Dashboard</span>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome, {{ Auth::guard('admin')->user()->name }}!</h1>
        <p class="lead">You are successfully logged in to the admin dashboard.</p>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>📋 Manage Orders</h3>
                        <p>View and manage all customer orders</p>
                        <a href="/orders" class="btn btn-primary">Go to Orders</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>👥 Manage People</h3>
                        <p>View and manage all customers</p>
                        <a href="/people" class="btn btn-primary">Go to People</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
