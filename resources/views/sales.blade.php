<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales | CFK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
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
Sales
</h1>
<div class="card shadow-sm border-0">
    <div class="card-body">

        <!-- Total Revenue -->
        <div class="mb-3">
            <h5 class="fw-bold">
                Total Revenue:
                <span class="text-success">
                    ${{ number_format($totalRevenue, 2) }}
                </span>
            </h5>
        </div>

        <!-- Sort Buttons -->
 <div class="d-flex justify-content-end mb-3">
    
    <a href="?order=asc"
       class="btn btn-outline-secondary me-2 {{ $order === 'ASC' ? 'disabled' : '' }}">
        <i class="bi bi-caret-up-fill"></i>
    </a>

    <a href="?order=desc"
       class="btn btn-outline-secondary {{ $order === 'DESC' ? 'disabled' : '' }}">
        <i class="bi bi-caret-down-fill"></i>
    </a>

</div>

        <!-- Table -->
        <!-- Top scrollbar mirror -->
        <div id="sales-top-scroll" style="overflow-x:auto; overflow-y:hidden; height:16px;">
            <div id="sales-top-scroll-inner" style="height:1px;"></div>
        </div>

        <div class="table-responsive" id="sales-table-scroll">

            <table class="table table-striped table-hover align-middle text-center" id="sales-table">

                <!-- Table Head -->
                      <thead>
            <tr class="border-bottom">
                <th class="py-3">Order ID</th>
                <th class="py-3">Customer ID</th>
                <th class="py-3">Order Time</th>
                <th class="py-3">Payment</th>
                <th class="py-3">Menu</th>
                <th class="py-3 text-end">Price</th>
                <th class="py-3">Qty</th>
                <th class="py-3 text-end">Revenue</th>
            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody>
            @forelse($sales as $sale)
                <tr>

                    <td class="py-3 fw-bold">
                        {{ $sale->orderid }}
                    </td>

                    <td class="py-3">
                        {{ $sale->id }}
                    </td>

                    <td class="py-3">
                        {{ $sale->ordertime }}
                    </td>

                    <td class="py-3">
                        {{ $sale->payment }}
                    </td>

                    <td class="py-3 fw-semibold">
                        {{ $sale->mname }}
                    </td>
    
             
                    <td class="py-3 text-end">
                        ${{ number_format($sale->price, 2) }}
                    </td>

                     <td class="py-3">
                        {{ $sale->quantity }}
                    </td>


                    <td class="py-3 text-end fw-bold">
                        ${{ number_format($sale->revenue, 2) }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-4 text-muted">
                        No sales found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>


        </div>

        <script>
        (function() {
            var topScroll = document.getElementById('sales-top-scroll');
            var tableScroll = document.getElementById('sales-table-scroll');
            var inner = document.getElementById('sales-top-scroll-inner');
            function syncWidth() {
                inner.style.width = tableScroll.scrollWidth + 'px';
            }
            syncWidth();
            window.addEventListener('resize', syncWidth);
            topScroll.addEventListener('scroll', function() {
                tableScroll.scrollLeft = topScroll.scrollLeft;
            });
            tableScroll.addEventListener('scroll', function() {
                topScroll.scrollLeft = tableScroll.scrollLeft;
            });
        })();
        </script>

    </div>
</div>

</div>

@include('footer')

</div>
</div>

</body>
</html>