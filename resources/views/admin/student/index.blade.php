@extends('layouts.admin-master')

@section('title')
Students
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Students</h1>
      <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Students</div>
      </div>
  </div>

  <div class="section-body">
      <admin-student-component></admin-student-component>
  </div>
</section>
@endsection
