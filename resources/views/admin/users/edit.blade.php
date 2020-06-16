@extends('layouts.admin-master')

@section('title')
Edit ({{ $user->name }})
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Pengguna</h1>
      <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.users') }}">Pengguna</a></div>
              <div class="breadcrumb-item">Edit Pengguna</div>
        </div>
  </div>
  <div class="section-body">
      <profile-component user='{!! $user->toJson() !!}'></profile-component>
  </div>
</section>
@endsection
