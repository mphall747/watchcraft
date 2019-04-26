<!-- Stored in resources/views/inventories/suppliers/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')

    <div class="container">
        <h3>Edit Supplier - {{ $supplier[0]->name }}</h3>

        <form method="post" action="\inventories\suppliers\update\{{ $supplier[0]->supplier_id }}">
        @csrf

            <div class="form-group">
                <label for="supplierName">Supplier Name</label>
                <input class="form-control" name="supplierName" minlength="1" maxlength="45" value="{{ $supplier[0]->name }}">
            </div>

            <div class="form-group">
                <label for="supplierWeb">Web Address</label>
                <input class="form-control" name="supplierWeb" type="url" maxlength="45" value="{{ $supplier[0]->web_address }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection