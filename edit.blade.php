<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@isset($user)
<form action='{{route("update",$user["0"]->id)}}' class="container mt-3">
@endisset
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Full name</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" name="name" @isset($user) value="{{$user['0']->full_name}}" @endisset required>
    @error('name')
    <div class='form-text text-danger'>field can't be empty</div>
    @enderror
  </div>
    <div class="mb-3">
    <label for="name" class="form-label">User name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp name" name="user" @isset($user) value="{{$user['0']->user_name}}" @endisset  required>
    @error('user')
    <div class='form-text text-danger'>field can't be empty</div>
    @enderror
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" @isset($user) value="{{$user['0']->email}}" @endisset >
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    @error('email')
    <div class='form-text text-danger'>field can't be empty</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone number</label>s
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" @isset($user) value="{{$user['0']->phone_number}}" @endisset >
    @error('phone')
    <div class='form-text text-danger'>field can't be empty</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" @isset($user) value="{{$user['0']->address}}" @endisset  required>
    @error('address')
    <div class='form-text text-danger'>field can't be empty</div>
    @enderror
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>