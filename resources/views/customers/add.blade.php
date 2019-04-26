<!-- Stored in resources/views/customers/add.blade.php -->
@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')

    <div class="container">
        <h3>New Customer</h3>

        <form method="post" action="\customers\insert\">
        @csrf

            <div class="form-group">
                <label for="customerFirstName">First Name</label>
                <input class="form-control" name="customerFirstName" minlength="1" maxlength="45">
            </div>

            <div class="form-group">
                <label for="customerLastName">Last Name</label>
                <input class="form-control" name="customerLastName" minlength="1" maxlength="45">
            </div>

            <div class="form-group">
                <label for="customerPhone">Telephone Number</label>
                <input class="form-control" name="customerPhone" minlength="11" maxlength="11">
            </div>

            <div class="form-group">
                <label for="customerEmail">Email Address</label>
                <input class="form-control" name="customerEmail" type="email" minlength="0" maxlength="255">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection