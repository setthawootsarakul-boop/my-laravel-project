@extends('layouts.app')

@section('content')
<h2 class="mb-4">Customer Reviews</h2>

<div class="row">
    @foreach($reviews as $rev)
        <div class="col-md-6 mb-3">
            <div class="p-3 border rounded bg-white shadow-sm h-100">
                <h5 class="mt-0">
                    {{ $rev->customer_name ?? 'Anonymous' }}
                    <small class="text-muted">
                        - {{ \Carbon\Carbon::parse($rev->created_at)->format('d M Y') }}
                    </small>
                </h5>
                <p class="mb-2">{{ $rev->comment ?? '' }}</p>
                <div class="text-warning">
                    Rating: {{ $rev->rating ?? '-' }} / 5
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
