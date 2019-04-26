<!-- Stored in resources/views/inventories/inventories.blade.php -->

@extends('layouts.app')

<!-- Title for 'layouts/master.blade.php' -->
@section('title', 'Inventories')

<!-- Content section for 'layouts/master.blade.php' -->
@section('content')

    <div class="container">
        <h3>Inventory - {{ $branch[0]->location }}</h3>

        <p><a href="\inventories\add\1" class="btn btn-primary" role="button">Add Part to Stock List</a></p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <!-- Creates a table row for each object within array $customers -->
                @foreach ($inventory as $part)
                    <tr>

                        <!-- Creates table cells for values in $customer-->
                        @foreach ($part as $key => $value)

                            <!-- Uses <th> when the key is 'customer_id' -->
                            @if ($key === 'part_id')
                                <th scope="row"> {{ $value }} </th>
                            <!-- Exclude branch_id -->
                            @elseif ($key === 'branch_id')
                            @else
                                <td> {{ $value }} </td>
                            @endif

                        @endforeach

                        <!-- Creates a hyperlink to edit customer details at the end of every row -->
                        <td><a href="/inventories/edit/{{$part->branch_id}}/{{$part->part_id}}"> Edit </a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
