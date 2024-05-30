@extends('layouts.auth')
@section('content')
    <div class="card">
        <div class="card-header">Edit Form</div>
        <div class="card-body">
            <form method="POST" action="{{ route('forms.update', $form->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Form Title</label>
                    <input type="text" name="name" class="form-control" id="title" value="{{ $form->name }}" required>
                </div>

                <div class="form-group" id="dynamic-fields">
                    <label for="fields">Edit Fields</label>
                    @foreach($form->fields as $field)
                        <div class="input-group mb-3">
                            <select class="custom-select field-type" name="type[]">
                                <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="number" {{ $field->type == 'number' ? 'selected' : '' }}>Number</option>
                                <option value="select" {{ $field->type == 'select' ? 'selected' : '' }}>Select</option>
                            </select>
                            <input type="text" class="form-control" name="label[]" placeholder="Field Label"
                                   value="{{ $field->label }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary remove-field" type="button">Remove</button>
                            </div>
                        </div>
                        <div class="form-group mt-2 options-field {{ $field->type == 'select' ? '' : 'd-none' }}">
                            <label>Options (comma separated)</label>
                            <input type="text" class="form-control" name="options[]"
                                   value="{{ $field->type == 'select' ? implode(',', json_decode($field->options, true)) : '' }}">
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mb-3" id="add-field">Add Field</button>
                <button type="submit" class="btn btn-primary">Update Form</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function toggleOptionsField($element) {
                if ($element.val() == 'select') {
                    $element.closest('.input-group').next('.options-field').removeClass('d-none');
                } else {
                    $element.closest('.input-group').next('.options-field').addClass('d-none');
                }
            }

            $('#add-field').click(function () {
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

            $(document).on('click', '.remove-field', function () {
                if ($('#dynamic-fields .input-group').length > 1) {
                    $(this).closest('.input-group').next('.options-field').remove();
                    $(this).closest('.input-group').remove();
                } else {
                    alert("You cannot remove the last field.");
                }
            });
            $(document).on('change', '.field-type', function () {
                toggleOptionsField($(this));
            });

            $('.field-type').each(function () {
                toggleOptionsField($(this));
            });
        });
    </script>

    {{--<script>--}}
    {{--    $(document).ready(function() {--}}
    {{--        // Function to show/hide options field based on selected type--}}
    {{--        function toggleOptionsField($element) {--}}
    {{--            if ($element.val() == 'select') {--}}
    {{--                $element.closest('.input-group').next('.options-field').removeClass('d-none');--}}
    {{--            } else {--}}
    {{--                $element.closest('.input-group').next('.options-field').addClass('d-none');--}}
    {{--            }--}}
    {{--        }--}}

    {{--        // Event handler for the 'Add Field' button--}}
    {{--        $('#add-field').click(function() {--}}
    {{--            var fieldHTML = '<div class="input-group mb-3">' +--}}
    {{--                '<select class="custom-select field-type" name="type[]">' +--}}
    {{--                '<option value="text">Text</option>' +--}}
    {{--                '<option value="number">Number</option>' +--}}
    {{--                '<option value="select">Select</option>' +--}}
    {{--                '</select>' +--}}
    {{--                '<input type="text" class="form-control" name="label[]" placeholder="Field Label">' +--}}
    {{--                '<div class="input-group-append">' +--}}
    {{--                '<button class="btn btn-outline-secondary remove-field" type="button">Remove</button>' +--}}
    {{--                '</div>' +--}}
    {{--                '</div>' +--}}
    {{--                '<div class="form-group mt-2 options-field d-none">' +--}}
    {{--                '<label>Options (comma separated)</label>' +--}}
    {{--                '<input type="text" class="form-control" name="options[]">' +--}}
    {{--                '</div>';--}}
    {{--            $('#dynamic-fields').append(fieldHTML);--}}
    {{--        });--}}

    {{--        // Event handler to remove a field--}}
    {{--        $(document).on('click', '.remove-field', function() {--}}
    {{--            $(this).closest('.input-group').next('.options-field').remove();--}}
    {{--            $(this).closest('.input-group').remove();--}}
    {{--        });--}}

    {{--        // Event handler to toggle options field based on type selection--}}
    {{--        $(document).on('change', '.field-type', function() {--}}
    {{--            toggleOptionsField($(this));--}}
    {{--        });--}}

    {{--        // Initial call to ensure correct visibility of options field--}}
    {{--        $('.field-type').each(function() {--}}
    {{--            toggleOptionsField($(this));--}}
    {{--        });--}}
    {{--    });--}}
    {{--</script>--}}

@endsection
