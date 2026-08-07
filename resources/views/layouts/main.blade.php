<style>

.dashboard-card{
    border:0;
    border-radius:18px;
    transition:.3s;
}

.dashboard-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}


.stat-card{
    padding:22px;
    color:#fff;
    border-radius:18px;
}


.stat-card h2{
    font-size:32px;
    font-weight:700;
}



.icon-box,
.icon{

    width:55px;
    height:55px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;
    color:#fff;

}


.icon-box{

background:rgba(255,255,255,.25);

}



.bg-primary-gradient{
background:linear-gradient(135deg,#667eea,#764ba2);
}

.bg-success-gradient{
background:linear-gradient(135deg,#11998e,#38ef7d);
}

.bg-warning-gradient{
background:linear-gradient(135deg,#f7971e,#ffd200);
}

.bg-danger-gradient{
background:linear-gradient(135deg,#ff416c,#ff4b2b);
}




.card-box{

background:#fff;
padding:25px;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;

}


.card-box:hover{

transform:translateY(-5px);

}



.section-card{

border:0;
border-radius:18px;
overflow:hidden;

}


.ai-header{

background:linear-gradient(135deg,#667eea,#764ba2);

}


</style>



@php

$user = Auth::user();

@endphp



<div class="container-fluid mt-4">



@if($user->hasRole('vendor'))



<!-- ================= VENDOR DASHBOARD ================= -->


<div class="row g-4">


<div class="col-lg-3 col-md-6">

<div class="stat-card bg-primary-gradient dashboard-card">


<div class="d-flex justify-content-between">


<div>

<h6>Total Products</h6>

<h2>
{{ $totalProducts }}
</h2>


</div>


<div class="icon-box">

<i class="bi bi-box"></i>

</div>


</div>


</div>

</div>





<div class="col-lg-3 col-md-6">

<div class="stat-card bg-success-gradient dashboard-card">


<div class="d-flex justify-content-between">


<div>

<h6>Total Orders</h6>

<h2>
{{ $totalOrders }}
</h2>


</div>


<div class="icon-box">

<i class="bi bi-cart-check"></i>

</div>


</div>


</div>

</div>





<div class="col-lg-3 col-md-6">

<div class="stat-card bg-warning-gradient dashboard-card">


<div class="d-flex justify-content-between">


<div>

<h6>Total Revenue</h6>

<h2>
₹{{ number_format($revenue,2) }}
</h2>


</div>


<div class="icon-box">

<i class="bi bi-currency-rupee"></i>

</div>


</div>


</div>

</div>





<div class="col-lg-3 col-md-6">


<div class="stat-card bg-danger-gradient dashboard-card">


<div class="d-flex justify-content-between">


<div>

<h6>Pending Orders</h6>

<h2>
{{ $pendingOrders }}
</h2>


</div>


<div class="icon-box">

<i class="bi bi-clock"></i>

</div>


</div>


</div>


</div>


</div>





<div class="row mt-4 g-4">


<div class="col-lg-8">


<div class="card section-card shadow">


<div class="card-header bg-white">

<h5>
📈 Monthly Revenue
</h5>

</div>


<div class="card-body">

<canvas id="revenueChart"></canvas>

</div>


</div>


</div>




<div class="col-lg-4">


<div class="card section-card shadow">


<div class="card-header bg-white">

<h5>
⚠️ Low Stock
</h5>


</div>


<ul class="list-group list-group-flush">


@forelse($lowStocks as $product)


<li class="list-group-item d-flex justify-content-between">


{{ $product->name }}


<span class="badge bg-danger">

{{ $product->stock }}

</span>


</li>


@empty


<li class="list-group-item text-center">

No Low Stock

</li>


@endforelse


</ul>



</div>


</div>


</div>





<div class="card shadow mt-4">


<div class="card-header ai-header text-white">

<h5>
🤖 AI Sales Insights
</h5>

</div>



<div class="card-body">


<div class="alert alert-success">

Sales increased by <b>18%</b>

</div>


<div class="alert alert-warning">

Stock optimization required

</div>



<ul>

<li>Increase fast selling products</li>

<li>Create discount campaigns</li>

<li>Improve low sales products</li>

</ul>



</div>


</div>






@elseif($user->hasRole('super-admin'))





<!-- ================= SUPER ADMIN ================= -->



<div class="row g-4">



<div class="col-md-3">

<div class="card-box">


<div class="icon bg-primary">

<i class="bi bi-people"></i>

</div>


<h6 class="mt-3">
Total Users
</h6>


<h2>
{{ $totalUsers ?? 0 }}
</h2>


</div>

</div>





<div class="col-md-3">

<div class="card-box">


<div class="icon bg-success">

<i class="bi bi-shop"></i>

</div>


<h6 class="mt-3">
Total Vendors
</h6>


<h2>
{{ $totalVendors ?? 0 }}
</h2>


</div>

</div>





<div class="col-md-3">

<div class="card-box">


<div class="icon bg-warning">

<i class="bi bi-box"></i>

</div>


<h6>
Products
</h6>


<h2>
{{ $totalProducts ?? 0 }}
</h2>


</div>

</div>





<div class="col-md-3">

<div class="card-box">


<div class="icon bg-danger">

<i class="bi bi-cart"></i>

</div>


<h6>
Orders
</h6>


<h2>
{{ $totalOrders ?? 0 }}
</h2>


</div>

</div>


</div>





<div class="card shadow mt-5">


<div class="card-header">

<h5>
Pending Vendor Approval
</h5>


</div>



<div class="card-body">


<table class="table">


<thead>

<tr>

<th>Name</th>
<th>Email</th>
<th>Action</th>

</tr>

</thead>



<tbody>


@foreach($pendingVendors ?? [] as $vendor)


<tr>

<td>
{{ $vendor->name }}
</td>


<td>
{{ $vendor->email }}
</td>


<td>


<button class="btn btn-success btn-sm">
Approve
</button>


<button class="btn btn-danger btn-sm">
Reject
</button>


</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</div>





@endif


</div>






@if($user->hasRole('vendor'))

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


let ctx=document.getElementById('revenueChart');


if(ctx){


new Chart(ctx,{

type:'line',


data:{


labels:@json($months ?? []),


datasets:[{

label:'Revenue',

data:@json($revenues ?? []),

borderWidth:3,

tension:.4

}]


}


});


}


</script>

@endif