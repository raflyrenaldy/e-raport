<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Stisla Laravel') &mdash; {{ env('APP_NAME') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="manifest" href="{{request()->root()}}/manifest.json">
{{--    <link rel="manifest" href="{{ asset('manifest.json') }}>--}}
  <!-- CSS Libraries -->
    <script src="{{ asset("css/select2.min.css") }}"></script>
    <script src="{{ asset("css/bootstrap-timepicker.min.css") }}"></script>
    <script src="{{ asset("css/daterangepicker.css") }}"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">

      <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD8ADkD6V6JK6NUu1hIaZXrZA8lPYYM8dQ",
    authDomain: "appointment-dc30b.firebaseapp.com",
    databaseURL: "https://appointment-dc30b.firebaseio.com",
    projectId: "appointment-dc30b",
    storageBucket: "appointment-dc30b.appspot.com",
    messagingSenderId: "264715538570",
    appId: "1:264715538570:web:aae23b9487bb32bff69d73",
    measurementId: "G-XT7YPRC3QG"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

    // Retrieve Firebase Messaging object.
const messaging = firebase.messaging();
messaging.usePublicVapidKey("BM2VcMHlY0tk-yhAiGg8Q5MALbVJF5_RTQa1JMuV2L5HdT--HCyVLIIAryyZ5VNFEfj_nr9NL04cBiTbJ8B9HmE");
messaging.requestPermission().then(function() {
  console.log('Notification permission granted.');

  // TODO(developer): Retrieve an Instance ID token for use with FCM.
  // ...
}).catch(function(err) {
  console.log('Unable to get permission to notify.', err);
});
messaging.onMessage((payload) => {
  console.log('Message received. ', payload);
  // ...
});



</script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        @include('student.partials.topnav')
      </nav>
      <div class="main-sidebar">
        @include('student.partials.sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        @include('student.partials.footer')
      </footer>
    </div>
  </div>

  <script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
  <script src="{{ route('js.dynamic') }}"></script>
  <script src="{{ asset('js/app.js') }}?{{ uniqid() }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset("js/select2.full.min.js") }}"></script>
  <script src="{{ asset("js/bootstrap-timepicker.min.js") }}"></script>
  <script src="{{ asset("js/daterangepicker.js") }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{  asset('assets/js/page/bootstrap-modal.js') }}"></script>

  @yield('scripts')
</body>
</html>
