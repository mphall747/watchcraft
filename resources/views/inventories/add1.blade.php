<!-- Stored in resources/views/inventories/add1.blade.php -->
@extends('layouts.app')

@section('title', 'Add Item')

@section('content')

    <div class="container">
        <h3>New Inventory Item</h3>

        <form method="post" action="\inventories\add\2">
        @csrf

            <div class="form-group">
                <label for="itemBranch">Branch</label>
                <select class="form-control" name="itemBranch">

                    <!-- Loop through branches and add them as options -->
                    @foreach ($branches as $branch)
                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_id }} - {{ $branch->location }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="itemSupplier">Supplier</label>
                <select class="form-control" name="itemSupplier">

                    <!-- Loop through suppliers and add them as options -->
                    @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_id }} - {{ $supplier->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>

        </form>
    </div>

@endsection