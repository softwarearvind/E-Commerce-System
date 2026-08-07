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



@include('layouts.main')





</div>


</body>

</html>
