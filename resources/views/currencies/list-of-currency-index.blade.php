@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_message') }}
            </div>
        @elseif (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row col s8">
            <form style="width: 400px" id="add" method="post" action="{{url('store-currency')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('post')
                <h4>CREATE</h4>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" id="code"
                           placeholder="Enter code">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="Enter name">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <br>
    <br>

    <div class="container">
        <input class="form-control col-md-3" id="userInput" type="text" placeholder="Search..">
        <p>Case sensitive.</p>
        <table class="table table-hover" id="deviceDatatable">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currency as $currencies)
                <tr>
                    <td>{{$currencies->code}}</td>
                    <td>{{$currencies->name}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" id="{{$currencies->id}}" onclick="editCurrency(this)">Edit</button>
                        <button type="button" class="btn btn-danger" id="{{$currencies->id}}" onclick="deleteCurrency(this)">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    @push('custom-scripts')
        <script>
            $(document).ready(function () {
                $("#userInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#deviceDatatable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            function editCurrency(obj) {
                let currency_id = obj.id;
                window.location.href = '/edit-list-of-currency/' + currency_id;
            }

            function deleteCurrency(obj) {
                let currency_id = obj.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete.'
                }).then((result) => {
                    if (result.value) {
                        $.get('/delete-list-of-currency/' + currency_id, function (data, status) {
                            if (status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Currency has been deleted. Page will reload.',
                                    'success'
                                );

                                setTimeout(function () {
                                    window.location.reload();
                                }, 1500);
                            }
                        });
                    }
                })
            }
        </script>
    @endpush
@endsection
