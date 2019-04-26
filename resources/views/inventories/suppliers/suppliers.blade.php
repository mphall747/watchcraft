<!-- Stored in resources/views/inventories/suppliers/suppliers.blade.php -->

@extends('layouts.app')

<!-- Title for 'layouts/master.blade.php' -->
@section('title', 'Parts')

<!-- Content section for 'layouts/master.blade.php' -->
@section('content')

    <div class="container">
        <h3>Suppliers</h3>

        <p><a href="\inventories\suppliers\add" class="btn btn-primary" role="button">Add New Supplier</a></p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Supplier</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <!-- Creates a table row for each object within array $parts -->
                @foreach ($suppliers as $supplier)
                    <tr>

                        <!-- Creates table cells for values in $part-->
                        @foreach ($supplier as $key => $value)

                            <!-- Uses <th> when the key is 'part_id' -->
                            @if ($key === 'supplier_id')
                                <th scope="row"> {{ $value }} </th>
                            <!-- Link to supplier website in new tab -->
                            @elseif ($key === 'name')
                                <td><a href="{{ $supplier->web_address }}" target="_blank"> {{ $value }} </td>
                            <!-- Exclude web_address -->
                            @elseif ($key === 'web_address')
                            @else
                                <td> {{ $value }} </td>
                            @endif

                        @endforeach

                        <!-- Creates a hyperlink to edit supplier details at the end of every row -->
                        <td><a href="/inventories/suppliers/edit/{{$supplier->supplier_id}}"> Edit </a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
