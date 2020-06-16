@extends('layouts.auth-master')

@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Login</h4></div>

  <div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" id="token" name="token" value="">
      <div class="form-group">
        <label for="username">Username</label>
        <input aria-describedby="usernameHelpBlock" id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Registered username address" tabindex="1" value="{{ old('username') }}" autofocus>
        <div class="invalid-feedback">
          {{ $errors->first('username') }}
        </div>
      </div>

      <div class="form-group">
        <div class="d-block">
            <label for="password" class="control-label">Password</label>
          <div class="float-right">
            <a href="{{ route('password.request') }}" class="text-small">
              Forgot Password?
            </a>
          </div>
        </div>
        <input aria-describedby="passwordHelpBlock" id="password" type="password" placeholder="Your account password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">
        <div class="invalid-feedback">
          {{ $errors->first('password') }}
        </div>
      </div>

{{--      <div class="form-group">--}}
{{--        <div class="custom-control custom-checkbox">--}}
{{--          <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember"{{ old('remember') ? ' checked': '' }}>--}}
{{--          <label class="custom-control-label" for="remember">Remember Me</label>--}}
{{--        </div>--}}
{{--      </div>--}}

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          Login
        </button>
      </div>
    </form>
  </div>
</div>
    <link rel="manifest" href="{{request()->root()}}/manifest.json">
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
messaging.requestPermission().then(function() {
  console.log('Notification permission granted.');
  // TODO(developer): Retrieve an Instance ID token for use with FCM.
  // ...
}).catch(function(err) {
  console.log('Unable to get permission to notify.', err);
});

// Get Instance ID token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
messaging.getToken().then(function(currentToken) {
  if (currentToken) {
    console.log(currentToken);
    document.getElementById("token").value = currentToken;
    updateUIForPushEnabled(currentToken);
  } else {
    // Show permission request.
    console.log('No Instance ID token available. Request permission to generate one.');
    // Show permission UI.
    updateUIForPushPermissionRequired();
    setTokenSentToServer(false);
  }
}).catch(function(err) {
  console.log('An error occurred while retrieving token. ', err);
  showToken('Error retrieving Instance ID token. ', err);
  setTokenSentToServer(false);
});
function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    }

</script>
{{--<div class="mt-5 text-muted text-center">--}}
{{--  Don't have an account? <a href="{{ route('register') }}">Create One</a>--}}
{{--</div>--}}
@endsection
