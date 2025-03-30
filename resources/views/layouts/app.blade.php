<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Well Operation Management System - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #005f73;
            border-radius: 12px;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
            font-weight: 500;
        }
        .navbar-toggler-icon {
            filter: invert(1);
        }
        .container-fluid a:hover {
            color: #94d2bd;
        }
        .alert {
            background-color: #fffbeb;
            border-color: #ffeb3b;
            color: #996c00;
            border-radius: 12px;
        }
        .main-content {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        button, .btn {
            background-color: #0077b6;
            color: #ffffff;
            border: 2px solid #005f73;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        button:hover, .btn:hover {
            background-color: #023e8a;
            border-color: #03045e;
        }
        .btn-secondary {
            background-color: #adb5bd;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('wells.index') }}">Well Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wells.index') }}">Well List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wells.create') }}">Register New Well</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-4 main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
