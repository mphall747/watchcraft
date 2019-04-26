<!-- Stored in resources/views/tickets/details.blade.php -->
@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')

    <div class="container">
        <!-- Displays data for individual ticket -->
        <h3>Ticket # {{ $ticket[0]->ticket_id }}</h3>
        

        <ul>
            <li>Status: {{ $ticket[0]->name }}</li>
            <li>Registed by: {{$ticket[0]->e_name}} @ {{$ticket[0]->location}}</li>
            <li>Registered on: {{$ticket[0]->date_received}}</li>
            <li>Customer: <a href="..\..\customers\id\{{ $ticket[0]->customer_id }}">{{$ticket[0]->c_first_name}} {{$ticket[0]->c_last_name}}</a></li>
            <li>Description: {{$ticket[0]->description}}</li>
        </ul>

        <!-- Display other_notes if they are set -->
        @if (isset($ticket[0]->other_notes))
            <h6>Other Notes</h6>
            <p>{{$ticket[0]->other_notes}}</p>
        @endif

        <ul>
            <!-- Display date_completed and price if they are set -->
            @if (isset($ticket[0]->date_completed))
                <li>Completed on: {{$ticket[0]->date_completed}}</li>
                <li>Price: &#163;{{$ticket[0]->price}}</li>
            @endif
            <!-- Display paid_date if it is set -->
            @if (isset($ticket[0]->paid_date))
                <li>Paid on: {{$ticket[0]->paid_date}}</li>
            @endif
        </ul>

        <!-- Display edit button if ticket is not complete -->
        @if ($ticket[0]->ticket_category_code < 4)
        <a href="..\edit\{{ $ticket[0]->ticket_id }}" class="btn btn-primary" role="button">Edit Ticket</a>
        @endif

        <!-- Display complete button on incomplete tickets -->
        @if ($ticket[0]->ticket_category_code === 1 || $ticket[0]->ticket_category_code === 3)
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#completeModal">
                Complete Ticket
            </button>
        @endif

        <!-- Display receive button on unrecieved tickets -->
        @if ($ticket[0]->ticket_category_code === 2)
        <a href="\tickets\receive\{{ $ticket[0]->ticket_id }}" class="btn btn-secondary" role="button">Received from Store</a>
        @endif

        <!-- Display return button on unreturned tickets -->
        @if ($ticket[0]->ticket_category_code === 4)
            <a href="\tickets\return\{{ $ticket[0]->ticket_id }}" class="btn btn-secondary" role="button">Return to Store</a>
        @endif

        <!-- Display payment button on completed tickets -->
        @if ($ticket[0]->ticket_category_code === 5)
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#paymentModal">
                Recieve Payment
            </button>
        @endif

        <!-- Complete ticket modal -->
        <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="completeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Complete Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="\tickets\complete\{{ $ticket[0]->ticket_id }}">
                @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ticketPrice">Enter price in pounds (&#163;)</label>
                            <input class="form-control" type="number" min="1" step=0.01 name="ticketPrice" minlength="1" maxlength="255" placeholder="e.g. '8.50'">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>

                </form>

                </div>
            </div>
        </div>

        <!-- Payment modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Complete Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="\tickets\pay\{{ $ticket[0]->ticket_id }}">
                @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="invoiceEmail">Send invoice via email?</label>
                            <select class="form-control" name="invoiceEmail">
                                <!-- Check if customer has an email address and enable email invoice option -->
                                @if (isset($ticket[0]->email))
                                    <option value="1">Yes</option>
                                @else
                                    <option value="1" disabled>Yes</option>
                                @endif
                                <option value="0" selected="selected">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>

@endsection