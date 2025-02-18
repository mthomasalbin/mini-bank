<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Bank</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item active" title="Dashboard">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-fw fa-tachometer-alt"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item" title="Customers">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" data-target="#collapseCustomers" aria-expanded="false">
                    <i class="fa fa-fw fa-user-alt"></i>
                    <span class="nav-link-text">Customers</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseCustomers">
                    <li><a href="{{ route('admin.add-customer') }}">Add Customer</a></li>
                    <li><a href="{{ route('admin.customers') }}">View Customers</a></li>
                </ul>
            </li>

            <li class="nav-item" title="Logout">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <i class="fa fa-fw fa-sign-out-alt"></i>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Required Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
