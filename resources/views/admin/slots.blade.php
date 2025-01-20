@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Parking Slots</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Slot ID</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $slot)
                    <tr>
                        <td>{{ $slot->slot_id }}</td>
                        <td>{{ $slot->status == 0 ? 'Kosong' : 'Terisi' }}</td>
                        <td>{{ $slot->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
