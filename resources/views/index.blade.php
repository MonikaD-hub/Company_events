
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Company Events</h1>

        <!-- Form for filtering bookings -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Filter Bookings</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('bookings.index') }}">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="employee_name" class="form-label">Employee Name</label>
                            <input type="text" id="employee_name" name="employee_name" class="form-control" value="{{ request('employee_name') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" id="event_name" name="event_name" class="form-control" value="{{ request('event_name') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" id="event_date" name="event_date" class="form-control" value="{{ request('event_date') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ request('price') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        @if($bookings->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bookings List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->employee_name }}</td>
                                    <td>{{ $booking->event_name }}</td>
                                    <td>{{ $booking->event_date }}</td>
                                    <td>{{ number_format($booking->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total Price:</strong></td>
                                <td><strong>{{ number_format($total_price, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                No results found.
            </div>
        @endif
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>