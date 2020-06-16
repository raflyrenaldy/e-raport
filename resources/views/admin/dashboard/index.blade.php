@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Admin</h1>
      <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Dashboard</div>
      </div>
  </div>

  <div class="section-body">
      <admin-dashboard-component></admin-dashboard-component>
  </div>
</section>
@endsection
