@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-info">

<div class="inner">

<h3>
{{ session('user')['role'] }}
</h3>

<p>
Role User
</p>

</div>

<div class="icon">

<i class="fas fa-user"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>
{{ session('user')['nama'] }}
</h3>

<p>
Nama Pengguna
</p>

</div>

<div class="icon">

<i class="fas fa-id-card"></i>

</div>

</div>

</div>

</div>

@endsection