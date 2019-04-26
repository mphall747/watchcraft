@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <a class="btn btn-primary" href="/customers/add" role="button">Add a New Customer</a> 
                </div>
            </div>
              
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <a class="btn btn-primary" href="/tickets/add" role="button">Create a New Ticket</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[0]->name }}</h5>
                    <p class="card-text">{{ $counts[0][0]->count }}</p>
                    <a href="/tickets/instore" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[1]->name }}</h5>
                    <p class="card-text">{{ $counts[1][0]->count }}</p>
                    <a href="/tickets/send" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[2]->name }}</h5>
                    <p class="card-text">{{ $counts[2][0]->count }}</p>
                    <a href="/tickets/workshop" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[3]->name }}</h5>
                    <p class="card-text">{{ $counts[3][0]->count }}</p>
                    <a href="/tickets/return" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[4]->name }}</h5>
                    <p class="card-text">{{ $counts[4][0]->count }}</p>
                    <a href="/tickets/complete" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $categories[5]->name }}</h5>
                    <p class="card-text">{{ $counts[5][0]->count }}</p>
                    <a href="/tickets/paid" class="btn btn-primary">View Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
