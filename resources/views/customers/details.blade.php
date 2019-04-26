<!-- Stored in resources/views/customers/details.blade.php -->
@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')

    <div class="container">
        <!-- Displays data for individual customer -->
        <h3>Customer # {{ $customer[0]->customer_id }}</h3>
        
        <ul>
            <li>Name: {{ $customer[0]->first_name }} {{ $customer[0]->last_name }}</li>
            <li>Phone: {{ $customer[0]->phone }}</li>
            @if (isset($customer[0]->email))
                <li>Email: {{ $customer[0]->email }}</li>
            @endif
        </ul>

        <!-- Table of customer's tickets -->
        <h5>Customer # {{ $customer[0]->customer_id }} - Tickets</h5>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Displays customers tickets in a table -->
                @if (count($tickets) > 0)
                    <!-- Creates a table row for each object within array $tickets -->
                    @foreach ($tickets as $ticket)
                        <tr>
                            <!-- Creates table cells for values in $ticket
                            Uses <th> when the key is 'ticket_id' -->
                            @foreach ($ticket as $key => $value)
                                @if ($key === 'ticket_id')
                                    <th scope="row"> {{ $value }} </th>
                                @else
                                    <td> {{ $value }} </td>
                                @endif
                            @endforeach
                            <!-- Creates a hyperlink to edit ticket details at the end of every row -->
                            <td><a href="/tickets/id/{{$ticket->ticket_id}}"> Details/Edit </a></td>
                        </tr>
                    @endforeach
                <!-- Informs the user if the current customer has no ticket history -->
                @else
                    <td>No tickets found.</td>
                    <td></td>
                    <td></td>
                @endif
            </tbody>
        </table>

        <a href="..\edit\{{ $customer[0]->customer_id }}" class="btn btn-primary" role="button">Edit Customer</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModal">
            Remove Personal Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Overwrite Personal Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to overwrite this user?<br>This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="\customers\delete\{{ $customer[0]->customer_id }}" class="btn btn-primary" role="button">Delete</a>
                </div>
                </div>
            </div>
        </div>
    </div>
        

@endsection