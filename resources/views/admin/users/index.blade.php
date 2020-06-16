@extends('layouts.admin-master')

@section('title')
Manage Users
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Pengguna</h1>
      <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Pengguna</div>
            </div>
  </div>
  <div class="section-body">
      <users-component></users-component>
  </div>
</section>
@endsection
