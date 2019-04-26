<!-- Stored in resources/views/tickets/tickets.blade.php -->
@extends('layouts.app')

@section('title', 'Reports')

@section('content')

    <div class="container">
        <h3>Tickets</h3>

        <p><a href="\tickets\add" class="btn btn-primary" role="button">Add New Ticket</a></p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Ticket</th>
                    <th scope="col">Status</th>
                    <th scope="col">Branch</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>


@endsection
