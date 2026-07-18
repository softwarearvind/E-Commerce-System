<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f7fb;
        }

        .sidebar{
            width:260px;
            min-height:100vh;
            background:#1e293b;
            position:fixed;
            left:0;
            top:0;
        }

        .sidebar .logo{
            color:#fff;
            font-size:24px;
            font-weight:bold;
            padding:25px;
        }

        .sidebar a{
            display:block;
            color:#cbd5e1;
            padding:14px 25px;
            text-decoration:none;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#334155;
            color:#fff;
        }

        .content{
            margin-left:260px;
        }

        .navbar{
            background:#fff;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 8px 20px rgba(0,0,0,.05);
        }

        .icon-box{
            width:55px;
            height:55px;
            border-radius:12px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:22px;
            color:#fff;
        }
    </style>

</head>
