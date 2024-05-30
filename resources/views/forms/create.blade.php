@extends('layouts.auth')
@section('content')

            <div class="card">
                <div class="card-header">Create Form</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('forms.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Form Title</label>
                            <input type="text" name="name" class="form-control" id="title" required>
                        </div>

                        <div class="form-group" id="dynamic-fields">
                            <label for="fields">Add Fields</label>
                            <div class="input-group mb-3">
                                <select class="custom-select field-type" name="type[]">
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="select">Select</option>
                                </select>
                                @error('type.*')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" name="label[]" placeholder="Field Label">
                                @error('label.*')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="add-field">Add Field</button>
                                </div>
                            </div>
                            <div class="form-group mt-2 options-field d-none">
                                <label>Options (comma separated)</label>
                                <input type="text" class="form-control" name="options[]">
                                @error('options.*')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Form</button>
                    </form>
                </div>
            </div>


<script>
    $(document).ready(function() {
        function toggleOptionsField($element) {
            if ($element.val() == 'select') {
                $element.closest('.input-group').next('.options-field').removeClass('d-none');
            } else {
                $element.closest('.input-group').next('.options-field').addClass('d-none');
            }
        }
        $('#add-field').click(function() {
            var fieldHTML = '<div class="input-group mb-3">' +
                '<select class="custom-select field-type" name="type[]">' +
                '<option value="text">Text</option>' +
                '<option value="number">Number</option>' +
                '<option value="select">Select</option>' +
                '</select>' +
                '<input type="text" class="form-control" name="label[]" placeholder="Field Label">' +
                '<div class="input-group-append">' +
                '<button class="btn btn-outline-secondary remove-field" type="button">Remove</button>' +
                '</div>' +
                '</div>' +
                '<div class="form-group mt-2 options-field d-none">' +
                '<label>Options (comma separated)</label>' +
                '<input type="text" class="form-control" name="options[]">' +
                '</div>';
            $('#dynamic-fields').append(fieldHTML);
        });
        $(document).on('click', '.remove-field', function() {
            $(this).closest('.input-group').next('.options-field').remove();
            $(this).closest('.input-group').remove();
        });
        $(document).on('change', '.field-type', function() {
            toggleOptionsField($(this));
        });
        $('.field-type').each(function() {
            toggleOptionsField($(this));
        });
    });
</script>

@endsection
