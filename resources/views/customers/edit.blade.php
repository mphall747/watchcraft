<!-- Stored in resources/views/customers/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Customer Details - Edit')

@section('content')

    <div class="container">
        <h3>Customer # {{ $customer[0]->customer_id }} - Edit</h3>
        <br>

        <form method="post" action="..\update\{{ $customer[0]->customer_id }}">
            @csrf

            <div class="form-group">
                <label for="customerFirstName">First Name</label>
                <input class="form-control" name="customerFirstName" minlength="1" maxlength="45" value="{{ $customer[0]->first_name }}">
            </div>

            <div class="form-group">
                <label for="customerLastName">Last Name</label>
                <input class="form-control" name="customerLastName" minlength="1" maxlength="45" value="{{ $customer[0]->last_name }}">
            </div>

            <div class="form-group">
                <label for="customerPhone">Telephone Number</label>
                <input class="form-control" name="customerPhone" minlength="11" maxlength="11" value="{{ $customer[0]->phone }}">
            </div>

            <div class="form-group">
                <label for="customerEmail">Email Address</label>
                <input class="form-control" name="customerEmail" type="email" minlength="0" maxlength="255" value="{{ $customer[0]->email }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection