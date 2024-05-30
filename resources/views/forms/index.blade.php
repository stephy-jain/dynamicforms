@extends('layouts.auth')
@section('content')

    <div class="card">
        <div class="card-header">Forms List</div>
        <div class="card-body">
            <a href="{{ route('forms.create') }}" class="btn btn-primary mb-3">Create New Form</a>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->name }}</td>
                        <td>
                            <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('forms.destroy', $form->id) }}" method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
