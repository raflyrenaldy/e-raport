@extends('layouts.admin-master')

@section('title')
Create User
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tambah Pengguna</h1>
      <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.users') }}">Pengguna</a></div>
              <div class="breadcrumb-item">Tambah Pengguna</div>
        </div>
  </div>
  <div class="section-body">
      <adduser-component></adduser-component>
  </div>
</section>
@endsection
