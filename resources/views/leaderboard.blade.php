@extends('layouts.app')
@section('css')
<style>
    .star-rating { color:rgb(17, 17, 17); }
    .leaderboard-card {
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .leaderboard-header {
        background: linear-gradient(45deg, #ff6f61, #de4463);
        color: white;
        padding: 15px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .table th { 
        background:rgb(132, 139, 147);
        color: white; /* Adding white text color for better contrast */
    }
    .top-1 { color: gold; }
    .top-2 { color:rgb(82, 199, 127); }
    .top-3 { color: #cd7f32; }
</style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="card leaderboard-card">
            <div class="leaderboard-header text-center">
                <h2>🏆 Donor's Leaderboard</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Amount ({{ env("DONATION_CURRENCY", "INR") }})</th>
                        <th class="text-center">Rating</th>
                    </tr>
                    @if($donors->count())
                        @php
                            $maxAmount = $donors->max('amount');
                            $sortedDonors = $donors->sortByDesc('amount');
                        @endphp
                        @foreach ($sortedDonors as $index => $donor)
                            @php
                                $rating = ($donor->amount / $maxAmount) * 5;
                                $rating = number_format($rating, 1);
                                $ratingClass = $index < 3 ? 'top-' . ($index + 1) : '';
                            @endphp
                            <tr>
                                <td>{{ $donor->name }}</td>
                                <td class="text-center">{{ $donor->city_name }}, {{ $donor->country_name }}</td>
                                <td class="text-center">{{ $donor->created_at?->format('d M, Y') }}</td>
                                <td class="text-center">{{ number_format($donor->amount, 2, '.', ',') }}</td>
                                <td class="text-center">
                                    <span class="star-rating {{ $ratingClass }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa {{ $i <= floor($rating) ? 'fa-star' : ($i - $rating < 1 ? 'fa-star-half-o' : 'fa-star-o') }}"></i>
                                        @endfor
                                        <span>({{ $rating }})</span>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center"><i class="fa fa-ghost fa-lg"></i> <strong>Oops! </strong> No data to show</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection