<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<body class="bg-light">
<nav class="navbar navbar-light bg-secondary">
  <div class="container">
    <h4 class="text-white text-center fw-bold">CREATE NEW USER<i><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
</svg><i></h4>
    <a type='button' class='btn btn-primary fw-bold' href='{{route("show")}}'>Show All Users</a>
  </div>
</nav>


<div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="container card">
<form action='{{route("store")}}' class="container">
    @csrf
  <div class="my-3">
    <label for="name" class="form-label fw-bolder">Full name</label>
    <input type="text" class="form-control form-control-sm border border-secondary" id="name" aria-describedby="emailHelp" name="name" value="{{old('name')}}" required>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
    <div class="mb-3">
    <label for="user" class="form-label fw-bolder">User name</label>
    <input type="text" class="form-control form-control-sm border border-secondary" id="user" id="exampleInputEmail1" aria-describedby="emailHelp name" name="user" value="{{old('user')}}" required>
    @error('user')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
  <div class="mb-3">
    <label for="email" class="form-label fw-bolder">Email address</label>
    <input type="email" class="form-control form-control-sm border border-secondary" id="email" aria-describedby="emailHelp" name="email" value="{{old('email')}}">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label fw-bolder">Phone number</label>
    <input type="number" class="form-control form-control-sm border border-secondary" id="phone" aria-describedby="emailHelp" name="phone" value="{{old('phone')}}">
    @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="address" class="form-label fw-bolder">Address</label>
    <input type="text" class="form-control form-control-sm border border-secondary" id="address" aria-describedby="emailHelp" name="address" value="{{old('address')}}" required>
    @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
  <button type="submit" class="btn btn-primary fw-bold">Create</button>
</form>
</div>
</div>
</body>

<script>

function show(message, message_type){
  Swal.fire({
  title: message_type,
  text: message,
  icon: message_type,
  timer:2000
});
}
</script>


@if(Session::has('success'))
<script> show('{{Session::get("success")}}', "success")
</script>
@else
  <script> show('{{Session::get("error")}}', "error")
</script>
@endif