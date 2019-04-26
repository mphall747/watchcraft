<!-- Stored in resources/views/inventories/parts/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Part')

@section('content')

    <div class="container">
        <h3>Edit Part - {{ $part[0]->name }}</h3>

        <form method="post" action="\inventories\parts\update\{{ $part[0]->part_id }}">
        @csrf

            <div class="form-group">
                <label for="partSupplier">Supplier</label>
                <select class="form-control" name="partSupplier">

                    <!-- Loop through suppliers and add them as options -->
                    @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_id }} - {{ $supplier->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="partName">Part Name</label>
                <input class="form-control" name="partName" minlength="1" maxlength="45" value="{{ $part[0]->name }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection