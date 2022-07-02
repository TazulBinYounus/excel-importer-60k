<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Import</title>
</head>
<body>


<div class="container my-5">
    <h1 class="fs-5 fw-bold text-center">Import CSV</h1>

    <form action="{{ route('customer.search') }}" method="POST" id=searchSubmit" >
        @csrf
        <div class="row">
            <select class="selectpicker" name="branch_id" id="branch_id">
                <option selected disabled>Select Branch</option>
                <option value="1">Branch 1</option>
                <option value="2">Branch 2</option>
            </select>
            <select class="selectpicker" name="gender" id="gender">
                <option selected disabled>Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>

            <button type="submit" id=searchSubmit" class="btn btn-primary btn-green">Submit</button>
        </div>
    </form>



    <div class="row">
        <div class="d-flex my-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Data
            </button>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Branch Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $key => $item)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $item->branch_id }}</td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->gender }}</td>
                </tr>
            @endforeach


            </tbody>
        </table>

    </div>

</div>
<div class="row text-center item-center">
    {{ $customers->links('') }}

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $('form').submit( function(ev){

        ev.preventDefault();
        let branch_id = $('#branch_id').val();
        let gender = $('#gender').val();

        $.ajax({
            type: "POST",
            url: "{{ route('customer.search') }}",
            data: {
                branch_id:branch_id,
                gender:gender,
            },
            success: function( msg ) {
                alert( msg );
            }
        });

    });

</script>
</body>
</html>
