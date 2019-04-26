<!-- Stored in resources/views/tickets/add.blade.php -->
@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')

    <div class="container">
        <h3>New Ticket</h3>

        <form method="post" action="\tickets\insert\">
        @csrf

            <div class="form-group">
                <label for="ticketStatus">Order Status</label>
                <select class="form-control" name="ticketStatus">

                    <!-- Loop through categories and add them as options -->
                    @foreach ($categories as $category)

                        <!-- Only add options one and two for new tickets-->
                        @if ($category->ticket_category_code <= 3)
                            <option value="{{ $category->ticket_category_code }}">{{ $category->name }}</option>
                        @endif

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="ticketBranch">Added at</label>
                <select class="form-control" name="ticketBranch">

                    <!-- Loop through branches and add them as options -->
                    @foreach ($branches as $branch)
                            <option value="{{ $branch->branch_id }}">{{ $branch->location }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="ticketCustomer">Customer</label>
                <select class="form-control" name="ticketCustomer">

                    <!-- Loop through customers and add them as options -->
                    @foreach ($customers as $customer)
                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_id.' - '.$customer->first_name.' '.$customer->last_name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="ticketDescription">Description</label>
                <input class="form-control" name="ticketDescription" minlength="4" maxlength="255">
            </div>

            <div class="form-group">
                <label for="ticketNotes">Other Notes</label>
                <textarea class="form-control" name="ticketNotes" rows="3" maxlength="255"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

@endsection