<!-- Stored in resources/views/inventories/suppliers/add.blade.php -->
@extends('layouts.app')

@section('title', 'Add Supplier')

@section('content')

    <div class="container">
        <h3>New Supplier</h3>

        <form method="post" action="\inventories\suppliers\insert\">
        @csrf

            <div class="form-group">
                <label for="supplierName">Supplier Name</label>
                <input class="form-control" name="supplierName" minlength="1" maxlength="45">
            </div>

            <div class="form-group">
                <label for="supplierWeb">Web Address</label>
                <input class="form-control" name="supplierWeb" type="url" maxlength="45">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection