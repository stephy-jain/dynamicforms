@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">{{ $form->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('forms.submit', $form->id) }}">
                @csrf
                @foreach($form->fields as $field)
                    <div class="form-group">
                        <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                        @if($field->type == 'text')
                            <input type="text" name="fields[{{ $field->id }}]" class="form-control"
                                   id="field-{{ $field->id }}">
                            @error("fields.{$field->id}")
                            <span class="text-danger" role="alert">
                                      {{ $message }}
                                    </span>
                            @enderror
                        @elseif($field->type == 'number')
                            <input type="number" name="fields[{{ $field->id }}]" class="form-control"
                                   id="field-{{ $field->id }}">
                            @error("fields.{$field->id}")
                            <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                            @enderror
                        @elseif($field->type == 'select')
                            <select name="fields[{{ $field->id }}]" class="form-control" id="field-{{ $field->id }}">
                                @foreach(json_decode($field->options) as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error("fields.{$field->id}")
                            <span class="text-danger" role="alert">
                                       {{ $message }}
                                    </span>
                            @enderror
                        @endif
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
