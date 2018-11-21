@php
    $filter = request('filter', 'all');
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="/appointments" class="d-inline-block">
            <button class="btn btn-link" {{ $filter === 'all' ? 'disabled' : '' }}>Show All</button>
        </a>
        <a href="/appointments?filter=booked" class="d-inline-block">
            <button class="btn btn-link" {{ $filter === 'booked' ? 'disabled' : '' }}>Show Booked</button>
        </a>
    </div>
    @foreach ($appointments as $year => $yearApmts)
        <h2 class="mb-1 text-right">{{ $year }}</h2>
        <div class="year-container" style="background-color: whitesmoke;">
            @foreach ($yearApmts as $month => $monthApmts)
                <div class="px-3 py-2">
                    <h4>{{ monthName($month) }}</h4>
                    @foreach ($monthApmts as $apmt)
                        <div class="px-5 py-2 d-flex align-items-center apmt-slot {{ $apmt['status'] }}">
                            <span class="badge mr-2">{{ $apmt['status'] }}</span>
                            {{ $apmt['starts_at']->format('jS H:i') }} - {{ $apmt['ends_at']->format('H:i') }}
                            <form action="/appointments/{{ $apmt->id }}/book" method="POST" class="ml-auto book"> @csrf
                                <button class="btn btn-sm btn-primary">Book</button>
                            </form>
                            <form action="/appointments/{{ $apmt->id }}/cancel" method="POST" class="ml-auto cancel"> @csrf
                                <button class="btn btn-sm btn-danger">Cancel</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@push('styles')
<style type="text/css">
    .apmt-slot {
        background-color: rgba(0,0,0,.05);
        margin: 0 -1rem;
    }
    .apmt-slot:not(:last-child) {
        border-bottom: 0.5px solid lightgray;
    }
    .year-container {
        margin-bottom: 30px;
    }
    .badge { width: 60px; }
    .Available .badge { background-color: #69F0AE; }
    .Pending .badge { background-color: #FFFF00; }
    .Confirmed .badge { background-color: #FFAB40; }
    .Rejected .badge { background-color: #F5F5F5; }

    .Available form.cancel { display: none; }
    .Pending form.book { display: none; }
    .Confirmed form { display: none; }
    .Rejected form { display: none; }
</style>
@endpush