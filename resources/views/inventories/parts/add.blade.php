<!-- Stored in resources/views/inventories/parts/add.blade.php -->
@extends('layouts.app')

@section('title', 'Add Part')

@section('content')

    <div class="container">
        <h3>New Part</h3>

        <form method="post" action="\inventories\parts\insert\">
        @csrf

            <div class="form-group">
                <label for="partSupplier">Supplier</label>
                <select class="form-control" name="partSupplier">

                    <!-- Loop through categories and add them as options -->
                    @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_id }} - {{ $supplier->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="partName">Part Name</label>
                <input class="form-control" name="partName" minlength="1" maxlength="45">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection