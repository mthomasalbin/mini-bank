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
          <li class="breadcrumb-item">
            <a href="{{ route('admin.customers') }}">Customers</a>
          </li>
          <li class="breadcrumb-item active">Add New Customer</li>
        </ol>
        <form action="{{ route('admin.save-customer') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                  Add New Customer
                  <a href="{{ route('admin.customers') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="name">Name of the Customer</label>
                          <input
                            class="form-control"
                            id="name" name="name"
                            type="text" value="{{ old('name') }}"
                            aria-describedby="nameHelp"
                            placeholder="Enter Full Name"
                          />
                          @error('name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="phone">Contact Number</label>
                          <input
                            class="form-control"
                            id="phone" name="phone"
                            type="tel" value="{{ old('phone') }}"
                            aria-describedby="phoneHelp"
                            placeholder="Enter Contact Number"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                          />
                          @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="email">Email Address</label>
                          <input
                            class="form-control"
                            id="email" autocomplete="off"
                            type="email" name="email" value="{{ old('email') }}"
                            aria-describedby="emailHelp"
                            placeholder="Enter Email ID"
                          />
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="password">Password</label>
                          <input
                            class="form-control"
                            id="password" name="password"
                            type="password" autocomplete="new-password"
                            aria-describedby="passwordHelp"
                            placeholder="Enter Password"
                          />
                          @error('password')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                          </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                          <button type="submit" class="btn btn-primary">Create Customer</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      
      @include('layouts.footer')

    </div>
  </body>
</html>
