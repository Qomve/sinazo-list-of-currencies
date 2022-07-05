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

            <input id="user_id" value="{{$listOfCurrency->id}}" hidden>
        <div class="row col s8">
            <form style="width: 400px" id="add" method="post" action="{{url('update-list-of-currency/'.$listOfCurrency->id)}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h4>UPDATE</h4>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" value="{{$listOfCurrency->code}}" name="code" id="code"
                           placeholder="Enter code">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{$listOfCurrency->name}}" name="name" id="name"
                           placeholder="Enter name">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
