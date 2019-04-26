<!-- Stored in resources/views/inventories/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Quantity')

@section('content')

    <div class="container">
        <h3>Edit Quantity - {{ $item[0]->name }} @ {{ $item[0]->location }}</h3>

        <form method="post" action="\inventories\update\{{ $item[0]->branch_id }}\{{ $item[0]->part_id }}\">
        @csrf

            <div class="form-group">
                <label for="itemQuantity">Quantity</label>
                <input class="form-control" name="itemQuantity" type="number" minlength="1" maxlength="11" min="0" step="1" value="{{ $item[0]->quantity }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection