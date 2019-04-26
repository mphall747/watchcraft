<!-- Stored in resources/views/inventories/parts/parts.blade.php -->

@extends('layouts.app')

<!-- Title for 'layouts/master.blade.php' -->
@section('title', 'Parts')

<!-- Content section for 'layouts/master.blade.php' -->
@section('content')

    <div class="container">
        <h3>Parts - All</h3>

        <p><a href="\inventories\parts\add" class="btn btn-primary" role="button">Add New Part</a></p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <!-- Creates a table row for each object within array $parts -->
                @foreach ($parts as $part)
                    <tr>

                        <!-- Creates table cells for values in $part-->
                        @foreach ($part as $key => $value)

                            <!-- Uses <th> when the key is 'part_id' -->
                            @if ($key === 'part_id')
                                <th scope="row"> {{ $value }} </th>
                            <!-- Link to supplier website in new tab -->
                            @elseif ($key === 's_name')
                                <td><a href="{{ $part->web_address }}" target="_blank"> {{ $value }} </td>
                            <!-- Exclude web_address -->
                            @elseif ($key === 'web_address')
                            @else
                                <td> {{ $value }} </td>
                            @endif

                        @endforeach

                        <!-- Creates a hyperlink to edit part details at the end of every row -->
                        <td><a href="/inventories/parts/edit/{{$part->part_id}}"> Edit </a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
