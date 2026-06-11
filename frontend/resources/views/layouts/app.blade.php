<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SIM Laboratorium</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">

<li class="nav-item">

<a class="nav-link" data-widget="pushmenu" href="#">

<i class="fas fa-bars"></i>

</a>

</li>

</ul>

<ul class="navbar-nav ml-auto">

<li class="nav-item">

<span class="nav-link">

{{ session('user')['nama'] ?? 'User' }}

</span>

</li>

</ul>

</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="/dashboard" class="brand-link">

<span class="brand-text font-weight-light">

SIM LAB

</span>

</a>

<div class="sidebar">

<nav class="mt-2">

<ul class="nav nav-pills nav-sidebar flex-column">

<li class="nav-item">
<a href="/dashboard" class="nav-link">
<i class="nav-icon fas fa-home"></i>
<p>Dashboard</p>
</a>
</li>

@if(session('user')['role']=='administrator')

<li class="nav-item">
<a href="/users" class="nav-link">
<i class="nav-icon fas fa-users"></i>
<p>Users</p>
</a>
</li>

<li class="nav-item">
<a href="/rooms" class="nav-link">
<i class="nav-icon fas fa-door-open"></i>
<p>Rooms</p>
</a>
</li>

@endif

@if(session('user')['role']=='kepala_lab')

<li class="nav-item">
<a href="/drafts" class="nav-link">
<i class="nav-icon fas fa-file-alt"></i>
<p>Draft Pengadaan</p>
</a>
</li>

@endif

@if(session('user')['role']=='kaprodi')

<li class="nav-item">
<a href="/reviews" class="nav-link">
<i class="nav-icon fas fa-check-circle"></i>
<p>Review Draft</p>
</a>
</li>

@endif

@if(session('user')['role']=='staf_admin')

<li class="nav-item">
<a href="/drafts" class="nav-link">
<i class="nav-icon fas fa-file-alt"></i>
<p>Draft Pengadaan</p>
</a>
</li>

<li class="nav-item">
<a href="/bhp" class="nav-link">
<i class="nav-icon fas fa-cubes"></i>
<p>BHP</p>
</a>
</li>

<li class="nav-item">
<a href="/inventories" class="nav-link">
<i class="nav-icon fas fa-box"></i>
<p>Inventaris</p>
</a>
</li>

@endif

@if(session('user')['role']=='staf_lab')

<li class="nav-item">
<a href="/bhp" class="nav-link">
<i class="nav-icon fas fa-cubes"></i>
<p>BHP</p>
</a>
</li>

<li class="nav-item">
<a href="/maintenance" class="nav-link">
<i class="nav-icon fas fa-tools"></i>
<p>Maintenance</p>
</a>
</li>

@endif

<li class="nav-item">

<a href="/logout" class="nav-link">

<i class="nav-icon fas fa-sign-out-alt"></i>

<p>Logout</p>

</a>

</li>

</ul>

</nav>

</div>

</aside>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

@yield('content')

</div>

</section>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>