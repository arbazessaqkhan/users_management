<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css " rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- datatabes -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</head>


<body class="bg-light">
  
<nav class="navbar navbar-light bg-secondary">
  <div class="container">
    <h4 class="text-white text-center fw-bold">USERS MANAGEMENT<i><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
</svg><i></h4>
    <a type='button' class='btn btn-primary fw-bold' href='{{route("index")}}'>Create New User</a>
  </div>
</nav>
<div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="container card">
<div class='m-2 mt-3'>
  <div class="card shadow bg-body rounded mt-2">
  <div class='table-responsive'>
    <table class="table" id="showTable">
      <thead class="card-header">
        <tr>
          <th scope="col">NAME</th>
          <th scope="col">USER NAME</th>
          <th scope="col">EMAIL</th>
          <th scope="col" style="text-align:left">PHONE NUMBER</th>
          <th scope="col">ADDRESS</th>
          <th scope="col">EDIT</th>
          <th scope="col">DELETE</th>
        </tr>
      </thead>

      <tbody class="card-body">
        @if($users->isNotEmpty())
        @foreach($users as $user)
        <tr>
            <td class="font-monospace">{{$user->full_name}}</td>
            <td class="font-monospace">{{$user->user_name}}</td>
            <td class="font-monospace">{{$user->email}}</td>
            <td class="font-monospace" style="text-align:left">{{$user->phone_number}}</td>
            <td class="font-monospace">{{$user->address}}</td>
            <td><a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#modal_{{$user->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg></a>

            <!-- Modal -->
    <div class="modal fade"  id="modal_{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Update User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          @isset($user)
          @csrf
          <form action='{{route("update",$user->id)}}' class="m-0">
          @endisset
          <div class="row">
            <div class="col-6">
            <label for="name" class="form-label ">Full name</label>
            <input type="text" name="name{{$user->id}}" id="{{$user->id}}" class="form-control fw-light border border-dark" aria-describedby="emailHelp" @isset($user) value="{{old('name'.$user->id, $user->full_name)}}" @endisset required>

            @error('name'.$user->id)
            <div class="alert alert-danger">The name field is required.</div>
            @enderror
            </div>
            <div class="col-6">
            <label for="user" class="form-label ">User name</label>
            <input type="text" class="form-control fw-light border border-dark" id="exampleInputEmail1" aria-describedby="emailHelp name" name="user{{$user->id}}" @isset($user) value="{{old('user'.$user->id,$user->user_name)}}" @endisset  required>
            @error('user'.$user->id)
            <div class="alert alert-danger">The user field is required.</div>
            @enderror
            </div>
          <div>

          <div class="row mt-2">
            <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control fw-light border border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" name="email{{$user->id}}" @isset($user) value="{{old('email'.$user->id,$user->email)}}" @endisset required>
          @error('email'.$user->id)
            <div class="alert alert-danger">The email field is required when phone is not present.</div>
            @enderror
            </div>
            <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Phone number</label>s
            <input type="number" class="form-control fw-light border border-dark" id="examplInputEmail1" aria-describedby="emailHelp" name="phone{{$user->id}}" @isset($user) value="{{old('phone'.$user->id, $user->phone_number)}}" @endisset required>
            @error('phone'.$user->id)
            <div class="alert alert-danger">The phone field is required when email is not present.</div>
            @enderror
            </div>
          </div>
        <div class="row">
          <div class="mt-2 col-6">
            <label for="exampleInputEmail1" class="form-label">Address</label>
            <input type="text" class="form-control fw-light border border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" name="address{{$user->id}}" @isset($user) value="{{old('address'.$user->id,$user->address)}}" @endisset  required>
            @error('address'.$user->id)
            <div class="alert alert-danger">The address field is required.</div>
            @enderror
            </div>
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
        </form>
                  </div>
                </div>
            </td>
            <td>
            <!-- onclick = "deleteUser('{{$user->id}}')" , href="{{route('delete', $user->id)}}"-->
            <a class="btn btn-danger" onclick = "deleteUser('{{$user->id}}')" >
            <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
            </svg></i>
          </a>
          </td>
        </tr>
    
              </div>
            </div>
            @endforeach
            @endif
          </tbody>
      </div>
</div>

</table>
</div>
</div>
</div>

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
@endif



<script>

table = new DataTable('#showTable', {
  responsive:true,
})

document.addEventListener('DOMContentLoaded', function(){
   let userId = "{{Session::get('user_id')}}"
   let alertDivs = document.querySelectorAll('.alert')
   alertDivs.forEach(alert => {
    console.log(alert.innerHTML)
    if(alert.innerHTML){
      // input = alert.previousSibling()
      // console.log(input)

      $('#modal_'+userId).modal('show')
    }
   })
})


function deleteUser(id) {

    console.log(id)
    Swal.fire({
                title: "Confirm Deletion",
                text: "Are you sure to delete it!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                closeOnConfirm: true
            }).then((result) => {
              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
              if (result.isConfirmed){
                $.ajax({
                type: "POST",
                url: 'delete/'+id,
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function(results) {
                  if(results.success === true){
                    Swal.fire({
                      title: results.success,
                      text: results.msg,
                      icon: results.success,
                      timer: "2000"
                    });
                  }else{
                    Swal.fire({
                      title: results.success,
                      text: results.msg,
                      icon: results.success,
                      timer: "2000"
                    }).then((result)=> {
                      if(result.isConfirmed){
                        window.location.reload();
                      }
                      else{
                        setTimeout(() => {
                        window.location.reload();
                      }, 500);
                      }
                  });
                  }
                  
                  
                }
              })  
                
                    
                }
              } 
        );
};

</script>

