@extends('app.app')
<div class="container mt-4">
    <!-- Booking Form -->
    <div class="row">
        <div class="col-md-6">
            <div class="feature-card">
                <h4><i class="fas fa-calendar-plus me-2"></i>Make a Reservation</h4>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="table_number" class="form-label">Table Number</label>
                        <select class="form-control" id="table_number" name="table_number" required>
                            <option value="">Select a table</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Table {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (hours)</label>
                        <input type="number" class="form-control" id="duration" name="duration" min="1" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Book Now</button>
                </form>
            </div>
        </div>

        <!-- Booking List -->
        <div class="col-md-6">
            <div class="feature-card">
                <h4><i class="fas fa-list me-2"></i>Your Bookings</h4>
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings ?? [] as $booking)
                            <tr>
                                <td>{{ $booking->table_number }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->time }}</td>
                                <td>{{ $booking->duration }} hours</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $booking->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $booking->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit_table_number" class="form-label">Table Number</label>
                                                    <select class="form-control" name="table_number" required>
                                                        @for ($i = 1; $i <= 8; $i++)
                                                            <option value="{{ $i }}" {{ $booking->table_number == $i ? 'selected' : '' }}>
                                                                Table {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" name="date" value="{{ $booking->date }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_time" class="form-label">Time</label>
                                                    <input type="time" class="form-control" name="time" value="{{ $booking->time }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_duration" class="form-label">Duration (hours)</label>
                                                    <input type="number" class="form-control" name="duration" value="{{ $booking->duration }}" min="1" max="5" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No bookings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')
<div class="container mt-4">
    <!-- Booking Form -->
    <div class="row">
        <div class="col-md-6">
            <div class="feature-card">
                <h4><i class="fas fa-calendar-plus me-2"></i>Make a Reservation</h4>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="table_number" class="form-label">Table Number</label>
                        <select class="form-control" id="table_number" name="table_number" required>
                            <option value="">Select a table</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Table {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (hours)</label>
                        <input type="number" class="form-control" id="duration" name="duration" min="1" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Book Now</button>
                </form>
            </div>
        </div>

        <!-- Booking List -->
        <div class="col-md-6">
            <div class="feature-card">
                <h4><i class="fas fa-list me-2"></i>Your Bookings</h4>
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings ?? [] as $booking)
                            <tr>
                                <td>{{ $booking->table_number }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->time }}</td>
                                <td>{{ $booking->duration }} hours</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $booking->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $booking->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit_table_number" class="form-label">Table Number</label>
                                                    <select class="form-control" name="table_number" required>
                                                        @for ($i = 1; $i <= 8; $i++)
                                                            <option value="{{ $i }}" {{ $booking->table_number == $i ? 'selected' : '' }}>
                                                                Table {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" name="date" value="{{ $booking->date }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_time" class="form-label">Time</label>
                                                    <input type="time" class="form-control" name="time" value="{{ $booking->time }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_duration" class="form-label">Duration (hours)</label>
                                                    <input type="number" class="form-control" name="duration" value="{{ $booking->duration }}" min="1" max="5" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No bookings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
