<!-- Stored in resources/views/inventories/add2.blade.php -->
@extends('layouts.app')

@section('title', 'Add Item')

@section('content')

    <div class="container">
        <h3>New Inventory Item</h3>

        <form method="post" action="\inventories\insert">
        @csrf

            <div class="form-group">
                <label for="itemBranch">Branch</label>
                <select class="form-control" name="itemBranch">
                
                    <!-- Load selected branch -->
                    @foreach ($branches as $branch)
                        @if ($branch->branch_id === $item_branch)
                            <option value="{{ $branch->branch_id }}" selected="selected">{{ $branch->branch_id }} - {{ $branch->location }}</option>
                        @else
                            <option value="{{ $branch->branch_id }}" disabled>{{ $branch->branch_id }} - {{ $branch->location }}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="itemSupplier">Supplier</label>
                <select class="form-control" name="itemSupplier">

                    <!-- Load selected supplier -->
                    @foreach ($suppliers as $supplier)
                        @if ($supplier->supplier_id === $item_supplier)
                            <option value="{{ $supplier->supplier_id }}" selected="selected">{{ $supplier->supplier_id }} - {{ $supplier->name }}</option>
                        @else
                            <option value="{{ $supplier->supplier_id }}" disabled>{{ $supplier->supplier_id }} - {{ $supplier->name }}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="itemPart">Part</label>
                <select class="form-control" name="itemPart">

                    <!-- Loop through parts and add them as options -->
                    @foreach ($parts as $part)
                    
                            <!-- Compare parts to the currently selected inventory and only allow new parts -->
                            @if (!in_array($part->part_id, $inventoryArray))
                                <option value="{{ $part->part_id }}">{{ $part->part_id }} - {{ $part->name }}</option>
                            @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="itemQuantity">Quantity</label>
                <input class="form-control" name="itemQuantity" type="number" minlength="1" maxlength="11" min="0" step="1">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection