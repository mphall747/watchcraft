<!-- Stored in resources/views/customers/customers.blade.php -->

@extends('layouts.app')

<!-- Title for 'layouts/master.blade.php' -->
@section('title', 'Customers')

<!-- Content section for 'layouts/master.blade.php' -->
@section('content')

    <div class="container">
        <h3>Customers</h3>

        <p><a href="\customers\add" class="btn btn-primary" role="button">Add New Customer</a></p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Creates a table row for each object within array $customers -->
                @foreach ($customers as $customer)
                    <tr>
                        <!-- Creates table cells for values in $customer-->
                        @foreach ($customer as $key => $value)
                            <!-- Uses <th> when the key is 'customer_id' -->
                            @if ($key === 'customer_id')
                                <th scope="row"> {{ $value }} </th>
                            <!-- Concatenate first_name and last_name into a single cell -->
                            @elseif ($key === 'first_name')
                                <td> {{ $value." " }}
                            @elseif ($key === 'last_name')
                                {{ $value }} </td>
                            @else
                                <td> {{ $value }} </td>
                            @endif
                        @endforeach
                        <!-- Creates a hyperlink to edit customer details at the end of every row -->
                        <td><a href="/customers/id/{{$customer->customer_id}}"> Details/Edit </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
