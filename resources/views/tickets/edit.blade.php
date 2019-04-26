<!-- Stored in resources/views/tickets/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Ticket Details - Edit')

@section('content')

    <div class="container">
        <h3>Ticket # {{ $ticket[0]->ticket_id }} - Edit</h3>
        <br>

        <form method="post" action="..\update\{{ $ticket[0]->ticket_id }}">
            @csrf

            <div class="form-group">
                <label for="ticketDescription">Description</label>
                <input class="form-control" name="ticketDescription" minlength="4" maxlength="255" value="{{ $ticket[0]->description }}">
            </div>

            <div class="form-group">
                <label for="ticketNotes">Other Notes</label>
                <textarea class="form-control" name="ticketNotes" maxlength="255" rows="3">{{ $ticket[0]->other_notes }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection