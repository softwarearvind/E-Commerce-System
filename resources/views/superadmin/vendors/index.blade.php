<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<style>

body{
    background:#f5f6fa;
}


/* Sidebar */

.sidebar{
    width:260px;
    height:100vh;
    background:#111827;
    position:fixed;
    left:0;
    top:0;
    color:white;
}


.sidebar h3{
    padding:25px;
    text-align:center;
}


.sidebar a{

    display:block;
    padding:13px 25px;
    color:#cbd5e1;
    text-decoration:none;

}


.sidebar a:hover{

    background:#2563eb;
    color:white;

}


/* Main */

.main{
    margin-left:260px;
}


/* Topbar */

.topbar{

    background:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    box-shadow:0 2px 10px #ddd;

}



/* Cards */

.card-box{

    border:none;
    border-radius:15px;
    padding:20px;
    background:white;
    box-shadow:0 5px 20px #ddd;
    transition:.3s;

}


.card-box:hover{

    transform:translateY(-5px);

}


.icon{

    width:55px;
    height:55px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;
    color:white;

}


</style>

</head>


<body>


@include('layouts.sidebar')





<!-- Main Content -->

<div class="main">


<!-- Topbar -->

<div class="topbar">

<h5>

Super Admin

</h5>


<div>

<i class="bi bi-bell fs-5"></i>

&nbsp;

{{ Auth::user()->name }}

</div>
</div>

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="card shadow border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-shop text-primary"></i>
                    Vendor Management
                </h3>

                <p class="text-muted mb-0">
                    Manage Vendor Approval & Rejection
                </p>
            </div>

            <div>
                <span class="badge bg-primary fs-6 px-3 py-2">
                    Total Vendors :
                    {{ $vendors->count() }}
                </span>
            </div>

        </div>
    </div>


    <!-- Search -->

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form>

                <div class="input-group">

                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                           class="form-control"
                           placeholder="Search Vendor...">

                </div>

            </form>

        </div>
    </div>


    <!-- Vendor Table -->

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Vendor List
            </h5>

        </div>

        <div class="table-responsive">

            <table class="table align-middle table-hover mb-0">

                <thead class="table-light">

                <tr>

                    <th>Sn</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Status</th>

                    <th width="220">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($vendors as $vendor)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
                                     style="width:45px;height:45px;">

                                    {{ strtoupper(substr($vendor->name,0,1)) }}

                                </div>

                                <div>

                                    <strong>{{ $vendor->name }}</strong>

                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $vendor->email }}

                        </td>

                        <td>

                            @if($vendor->status=='approved')

                                <span class="badge bg-success px-3 py-2">
                                    Approved
                                </span>

                            @elseif($vendor->status=='pending')

                                <span class="badge bg-warning text-dark px-3 py-2">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-danger px-3 py-2">
                                    Rejected
                                </span>

                            @endif

                        </td>

                        <td>

<button class="btn btn-success btn-sm approveVendor"
        data-id="{{ $vendor->id }}">
    <i class="bi bi-check-circle"></i>
    Approve
</button>


<button class="btn btn-danger btn-sm rejectVendor"
        data-id="{{ $vendor->id }}">
    <i class="bi bi-x-circle"></i>
    Reject
</button>

</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="text-center p-5">

                                <i class="bi bi-inbox display-4 text-secondary"></i>

                                <h5 class="mt-3">
                                    No Vendor Found
                                </h5>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
        <div class="mt-3">

             {{ $vendors->links() }}

        </div>


</div>


</div>

<script>

$('.approveVendor, .rejectVendor').click(function(){

    let id = $(this).data('id');

    let status = $(this).hasClass('approveVendor')
        ? 'approved'
        : 'rejected';


    $.ajax({

        url: "{{ url('/vendors') }}/"+id+"/status",

        type:"PATCH",

        data:{
            _token:"{{ csrf_token() }}",
            status:status
        },

        success:function(response){

            console.log(response);

            alert(response.message);

            location.reload();

        },

        error:function(xhr){

            console.log(xhr.responseText);

            alert('Error');

        }

    });

});

</script>
</body>

</html>
