<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data | CFK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{ asset('adminstyles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
</head>

<body>

<div class="row g-0">

<!-- Sidebar -->
<div class="col-lg-3 col-md-4 col-12 maincolor">

<div class="title text-center">
<a class="navbar-brand fw-bold d-flex justify-content-center align-items-center" href="{{ url('/') }}">
<i class="bi bi-shop me-2"></i> City Food Kitchen
</a>
</div>


<nav class="navadmin">
<a href="{{ url('/home') }}">
<i class="bi bi-house-door me-2"></i> Home
</a>

<a href="{{ url('/customers') }}">
<i class="bi bi-people me-2"></i> Customers
</a>

<a href="{{ url('/orders') }}">
<i class="bi bi-file-earmark-text me-2"></i> Orders
</a>

<a href="{{ url('/sales') }}">
<i class="bi bi-clipboard-data me-2"></i> Sales
</a>

<a href="{{ url('/data') }}">
<i class="bi bi-graph-up me-2"></i> Data
</a>

</nav>

</div>

<div class="col-lg-9 col-md-8 col-12">

<!-- Top bar -->
<div class="text-end p-3 maincolor dropdown">
    <i class="bi bi-person-check me-2"></i>

    <span class="me-2">
        {{ Auth::guard('admin')->user()->username }}
    </span>

    <i class="bi bi-gear dropdown-toggle"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
    </i>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="container mt-4">

<h1 class="py-4 text-dark text-center fw-bold">
Data Analytics
</h1>

    <div class="row g-3">

    <!-- Total Revenue -->
    <div class="col-md-4">
        <div class="card kpi-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                
                <div class="kpi-icon bg-success text-white me-3">
                    <i class="bi bi-currency-dollar"></i>
                </div>

                <div>
                    <div class="text-muted small">Total Revenue</div>
                    <div class="fw-bold fs-4">
                        ${{ number_format($totalRevenue, 2) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="col-md-4">
        <div class="card kpi-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">

                <div class="kpi-icon bg-primary text-white me-3">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>
                    <div class="text-muted small">Registered Customers</div>
                    <div class="fw-bold fs-4">
                        {{ $totalCustomers }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-md-4">
        <div class="card kpi-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">

                <div class="kpi-icon bg-danger text-white me-3">
                    <i class="bi bi-bag-check-fill"></i>
                </div>

                <div>
                    <div class="text-muted small">Total Orders</div>
                    <div class="fw-bold fs-4">
                        {{ $totalOrders }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="container mt-4">
    <h1 class="py-4 text-dark text-center">
Top Selling Menu
</h1>

<canvas id="menuChart"></canvas>
<script>
const menuChart = new Chart(document.getElementById('menuChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($topMenu->pluck('mname')) !!},
        datasets: [{
            label: 'Sold',
            data: {!! json_encode($topMenu->pluck('total_sold')) !!},
            backgroundColor: 'orange'
        }]
    }
});
</script>


    <h1 class="py-4 text-dark text-center">
Revenue Over Time
</h1>

<canvas id="revenueChart"></canvas>
<script>
const revenueChart = new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueData->pluck('date')) !!},
        datasets: [{
            label: 'Revenue',
            data: {!! json_encode($revenueData->pluck('total')) !!},
            borderColor: 'green',
            backgroundColor: 'rgba(0,255,0,0.1)',
            fill: true,
            tension: 0.4
        }]
    }
});
</script>
</div>



</div>

@include('footer')

</div>
</div>

</body>
</html>