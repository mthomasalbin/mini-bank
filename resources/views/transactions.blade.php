<!DOCTYPE html>
<html lang="en">

  @include('layouts.header')

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('admin.customers') }}">Customers</a>
          </li>
          <li class="breadcrumb-item active">Transactions</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div>
                  <h5>Listing Transactions of <b>{{ ($user_transactions->count() > 0 && $user_transactions[0]->customer) ? $user_transactions[0]->customer->name : 'NA' }}</b></h5>
                  <p>Balance : ₹ {{ ($user_transactions->count() > 0  && $user_transactions[0]->customer) ? $user_transactions[0]->customer->balance : 'NA' }}</p>
                </div>
                <div>
                  <a href="{{ route('admin.customers') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                </div>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                      <tr>
                          <th>SI No.</th>
                          <th>Type</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>IP</th>                         
                      </tr>
                  </thead>            
                  <tbody>
                    @php $key = 1; @endphp
                      @foreach ($user_transactions as $transaction)
                          <tr>
                              <td>{{ $key++ }}</td>
                              <td>{{ strtoupper($transaction->transaction_type) }}</td> 
                              <td>{{ date('jS M, Y', strtotime($transaction->created_at)) }}</td>
                              <td>{{ $transaction->amount }}</td>
                              <td>{{ $transaction->ip }}</td>
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
