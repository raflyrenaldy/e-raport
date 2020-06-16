@extends('layouts.student-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Student</h1>
  </div>

  <div class="section-body">
      <student-dashboard-component path='{!! $student->path_download !!}'></student-dashboard-component>
  </div>
</section>
@endsection
