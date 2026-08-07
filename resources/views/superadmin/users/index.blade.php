<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


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



<div class="main">

    <!-- Topbar -->

    <div class="topbar">

        <h4 class="fw-bold">
            <i class="bi bi-people-fill text-primary"></i>
            Customers
        </h4>

        <div>

            <i class="bi bi-bell fs-5 me-3"></i>

            <strong>{{ Auth::user()->name }}</strong>

        </div>

    </div>


    <div class="container-fluid mt-4">

        <div class="table-card">

            <div class="card-header-custom">

                <h4>
                    Customer List
                </h4>

                <span class="badge bg-success fs-6">
                    Total : {{ $users->total() }}
                </span>

            </div>
             <br>
             <br>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                    <tr>

                        <th>Sn</th>

                        <th>Customer</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Joined</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>

                                <div class="d-flex align-items-center">

                                    <div class="avatar">

                                        {{ strtoupper(substr($user->name,0,1)) }}

                                    </div>

                                    <div class="ms-3">

                                        <strong>{{ $user->name }}</strong><br>

                                        <small class="text-muted">
                                            ID :
                                            {{ $user->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $user->email }}

                            </td>

                            <td>

                                <span class="role-badge">

                                    {{ $user->getRoleNames()->first() }}

                                </span>

                            </td>

                            <td>

                                {{ $user->created_at->format('d M Y') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <i class="bi bi-inbox display-5 text-secondary"></i>

                                <h5 class="mt-3">

                                    No Customers Found

                                </h5>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-3">

            {{ $users->links() }}

        </div>

    </div>

</div>





</body>

</html>
