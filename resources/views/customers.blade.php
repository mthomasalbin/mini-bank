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
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                Listing Customers
                <a href="{{ route('admin.add-customer') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Customer</a>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                      <tr>
                          <th>Customer Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Balance</th>
                          <th>Created On</th>
                          <th>Action</th>
                      </tr>
                  </thead>            
                  <tbody>
                      @foreach($customers as $customer)
                      <tr>
                          <td>#C{{ $customer->id }}</td>
                          <td>{{ $customer->name }}</td>
                          <td>{{ $customer->email }}</td>
                          <td>+91 {{ $customer->phone }}</td>
                          <td>{{ $customer->balance }}</td>
                          <td>{{ date('d-M-Y', strtotime($customer->created_at)) }}</td>
                          <td>
                            @if ($customer->transactions->count() > 0)
                              <a href="{{ route('admin.view-transaction', encrypt($customer->id)) }}" class="btn btn-sm btn-primary">Transactions ({{ $customer->transactions->count() }})</a>
                            @else
                              <span class="text-muted">No transactions</span>
                            @endif
                          </td>
                      </tr>                      
                      @endforeach
                  </tbody>
              </table>
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
