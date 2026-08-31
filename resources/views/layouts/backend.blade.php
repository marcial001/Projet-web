<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrateur</title>

    <!-- Intégration de Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <style type="text/css">
        body {
            display: flex;
            min-height: 100vh;
            background-color: #cce7d0;

        }

        .sidebar {
            width: 250px;
            background: rgb(25, 135, 84);
            color: white;
            min-height: 100vh;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar h4 {
            text-align: center;
            padding-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            font-size: 16px;
        }

        .sidebar a:hover,
        .sidebar a:active {
            background: #1abc9c;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            width: 100%;
        }

        .navbar {
            background: rgb(25, 135, 84);
            color: white;
            padding: 20px;
            font-size: 1rem;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: auto;
        }

        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #c1dbd3;

        }

        .btn-primary {
            background: rgb(25, 135, 84);
            border: none;
        }

        .btn-primary:hover {
            background: #16a085;

        }

        .table thead {
            background: #16a085;
            color: white;
        }

        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .table-bordred {
            background-color: #c1dbd3;

        }
        input{
            background: lightgrey;!important
        }
    </style>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let links = document.querySelectorAll(".sidebar a");
            links.forEach(link => {
                link.addEventListener("click", function () {
                    links.forEach(l => l.classList.remove("active"));
                    this.classList.add("active");
                })
            })
        });
    </script>

</head>

<body>

    @include('layouts._sidebar')

    @yield('content')

    @include('layouts._footer')



</body>

</html>