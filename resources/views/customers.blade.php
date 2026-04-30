<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers | CFK</title>
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

<!-- Main Content-->
<div class="container mt-4">

    <h1 class="py-4 text-dark text-center fw-bold">
        Customers
    </h1>

    <div class="d-flex justify-content-end mb-3">

    <a href="{{ url('customers?sort=asc') }}"
       class="btn btn-outline-secondary me-2 {{ $sort === 'asc' ? 'disabled' : '' }}">
        <i class="bi bi-caret-up-fill"></i>
    </a>

    <a href="{{ url('customers?sort=desc') }}"
       class="btn btn-outline-secondary {{ $sort === 'desc' ? 'disabled' : '' }}">
        <i class="bi bi-caret-down-fill"></i>
    </a>

</div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Top scrollbar mirror -->
            <div id="customers-top-scroll" style="overflow-x:auto; overflow-y:hidden; height:16px;">
                <div id="customers-top-scroll-inner" style="height:1px;"></div>
            </div>

            <div class="table-responsive" id="customers-table-scroll">

                <table class="table table-striped table-hover align-middle text-center">

                    <thead>
                        <tr class="border-bottom">
                            <th class="py-3">ID</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td class="py-3">{{ $customer->id }}</td>
                                <td class="py-3 fw-semibold">{{ $customer->name }}</td>
                                <td class="py-3">{{ $customer->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            <script>
            (function() {
                var topScroll = document.getElementById('customers-top-scroll');
                var tableScroll = document.getElementById('customers-table-scroll');
                var inner = document.getElementById('customers-top-scroll-inner');
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

@include('footer')
</div>
</div>

</body>
</html>