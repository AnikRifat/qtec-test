@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Search History</h1>

    <form id="search-form" method="GET">
        <div class="form-group">
            <label for="keywords">All Keywords:</label>
            @foreach($keywords as $keyword => $count)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="keywords[]" value="{{ $keyword }}"
                  id="keyword-{{ $loop->index }}" @if(in_array($keyword, $selectedKeywords)) checked @endif>
                <label class="form-check-label" for="keyword-{{ $loop->index }}">{{ $keyword }} ({{ $count }} times
                    found)</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="users">All Users:</label>
            @foreach($users as $user)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}"
                  id="user-{{ $user->id }}" @if(in_array($user->id, $selectedUsers)) checked @endif>
                <label class="form-check-label" for="user-{{ $user->id }}">{{ $user->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Time Range:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="time_range[]" value="yesterday"
                  id="time-range-yesterday" @if(in_array('yesterday', $selectedTimeRanges)) checked @endif>
                <label class="form-check-label" for="time-range-yesterday">See data from yesterday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="time_range[]" value="last_week"
                  id="time-range-last-week" @if(in_array('last_week', $selectedTimeRanges)) checked @endif>
                <label class="form-check-label" for="time-range-last-week">See data from last week</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="time_range[]" value="last_month"
                  id="time-range-last-month" @if(in_array('last_month', $selectedTimeRanges)) checked @endif>
                <label class="form-check-label" for="time-range-last-month">See data from last month</label>
            </div>
        </div>

        <div class="form-group">
            <label>Select Date:</label><br>
            <input type="text" class="form-control" name="start_date" id="start-date" placeholder="Enter start date"
              value="{{ $selectedStartDate }}">
            <input type="text" class="form-control" name="end_date" id="end-date" placeholder="Enter end date"
              value="{{ $selectedEndDate }}">
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>


    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>Keyword</th>
                <th>User</th>
                <th>Search Time</th>
                <th>Search Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchHistory as $item)
            <tr>
                <td>{{ $item->keyword }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->search_time }}</td>
                <td>{{ $item->search_results }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  const filterForm = document.getElementById('filter-form');

  filterForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(filterForm);

    fetch('/search-history', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      const searchResults = document.getElementById('search-results');
      searchResults.innerHTML = data;
    })
    .catch(error => {
      console.error(error);
    });
  });
});

</script>

@endsection