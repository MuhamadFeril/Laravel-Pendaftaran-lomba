@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Dashboard</h1>
        <div class="text-muted small">Ringkasan data pendaftaran</div>
    </div>
    <div>
        <a href="{{ route('registrations.create') }}" class="btn btn-sm btn-primary">+ New Registration</a>
    </div>
</div>

<div class="row g-3 mb-4">
    {{-- Metric cards --}}
    <div class="col-sm-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                      <path d="M13 7c0 1.1-.9 2-2 2s-2-.9-2-2  .9-2 2-2 2 .9 2 2zM6 7c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2z"/>
                      <path fill-rule="evenodd" d="M0 13s1-1 4-1 4 1 4 1v1H0v-1zm8 0s1-1 4-1 4 1 4 1v1H8v-1z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-muted small">Users</div>
                    <div class="h5 mb-0">{{ $usersCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                      <path d="M11 6.5a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1h-1.5a.5.5 0 0 1-.5-.5z"/>
                      <path d="M3.5 0a.5.5 0 0 0 0 1H4v1h8V1h.5a.5.5 0 0 0 0-1H12V0a.5.5 0 0 0-1 0v1H5V0a.5.5 0 0 0-1 0v1h-.5zM1 3h14v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-muted small">Events</div>
                    <div class="h5 mb-0">{{ $eventsCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                      <path d="M10 1.5V2h1a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h1v-.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-muted small">Registrations</div>
                    <div class="h5 mb-0">{{ $registrationsCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                      <path d="M3 2v4l6 6 5-5-6-6H3z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-muted small">Categories</div>
                    <div class="h5 mb-0">{{ $categoriesCount ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                Recent Registrations
            </div>
            <div class="card-body">
                @if($recentRegistrations->isEmpty())
                    <div class="text-center text-muted py-4">No registrations yet.</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($recentRegistrations as $reg)
                        <li class="list-group-item d-flex align-items-start gap-3">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                                {{ strtoupper(substr($reg->name,0,1) ?? 'U') }}
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $reg->name }} <small class="text-muted">@if(optional($reg->user)) by {{ $reg->user->name }} @endif</small></div>
                                <div class="small text-muted">Team: {{ $reg->team_name ?? '—' }} · Event: {{ optional($reg->event)->title ?? '—' }} · Sub: {{ optional(optional($reg->event)->subcategory)->name ?? '—' }}</div>
                            </div>
                            <div class="text-end small text-muted">
                                @if(!empty($reg->created))
                                    {{ \Carbon\Carbon::parse($reg->created)->format('d M Y') }}
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">Events by Category</div>
            <div class="card-body">
                @php $maxCat = $eventsByCategory->max('events_count') ?: 1; @endphp
                @foreach($eventsByCategory as $cat)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="fw-medium">{{ $cat->name }}</div>
                            <div class="text-muted">{{ $cat->events_count }}</div>
                        </div>
                        <div class="progress mt-1" style="height:8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ round(($cat->events_count / $maxCat) * 100,1) }}%;" aria-valuenow="{{ $cat->events_count }}" aria-valuemin="0" aria-valuemax="{{ $maxCat }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">Events by Subcategory</div>
            <div class="card-body">
                @php $maxSub = $eventsBySubcategory->max('events_count') ?: 1; @endphp
                @foreach($eventsBySubcategory as $sub)
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small text-muted">
                            <div>{{ $sub->name }}</div>
                            <div>{{ $sub->events_count }}</div>
                        </div>
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ round(($sub->events_count / $maxSub) * 100,1) }}%;" aria-valuenow="{{ $sub->events_count }}" aria-valuemin="0" aria-valuemax="{{ $maxSub }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">Quick Links</div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">Events</a>
                    <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary btn-sm">Registrations</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">Categories</a>
                    <a href="{{ route('subcategories.index') }}" class="btn btn-outline-secondary btn-sm">Subcategories</a>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection