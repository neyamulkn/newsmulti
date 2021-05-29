@php 
	$total_votes =  $results->sum('votes');
@endphp
<div class="col-12">
    <div class="card" style="text-align: center;">
        <h1 class="card-subtitle">Total Poll</h1>
        <h1> {{$total_votes}} </h1>
    </div>
</div>

@foreach($results as $result)
@php 
	$percent = ($total_votes > 0) ? round(($result->votes/$total_votes)  * 100, 2) : 0;
@endphp
<div class="col-12">
    <div class="card">
        <h6 class="card-subtitle">{{$result->option}}</h6>
        <div class="progress">
            <div class="progress-bar bg-success" style="width: {{ $percent }}%; height:20px;color:#000" role="progressbar">{{ $percent }}%</div>
        </div>
    </div>
</div>
@endforeach