
<!DOCTYPE html>
<html>
<head>
    <title>{{ $form->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $form->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('forms.submit', $form->id) }}">
                        @csrf
                        @foreach($form->fields as $field)
                            <div class="form-group">
                                <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                                @if($field->type == 'text')
                                    <input type="text" name="fields[{{ $field->id }}]" class="form-control" id="field-{{ $field->id }}">
                                @elseif($field->type == 'number')
                                    <input type="number" name="fields[{{ $field->id }}]" class="form-control" id="field-{{ $field->id }}">
                                @elseif($field->type == 'select')
                                    <select name="fields[{{ $field->id }}]" class="form-control" id="field-{{ $field->id }}">
                                        @foreach(json_decode($field->options) as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
