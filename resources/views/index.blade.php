<!DOCTYPE html>
<html lang="en">

  @include('layouts.header')

  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-primary text-white mb-4">
                      <a href="{{ route('admin.customers') }}" class="text-white">
                        <div class="card-body">
                          <h5>Total Customers</h5>
                          <p class="mb-0">{{ $total_customers ?? 'NA' }}</p>
                        </div>
                      </a>                     
                  </div>
              </div>
              <div class="col-xl-3 col-md-6">
                  <div class="card bg-success text-white mb-4">
                      <div class="card-body">
                        <h5>Total Revenue</h5>
                        <p class="mb-0">{{ $average_amount ? "₹" . $average_amount : 'NA' }}</p>
                      </div>                      
                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->

      @include('layouts.footer')

    </div>
  </body>

</html>