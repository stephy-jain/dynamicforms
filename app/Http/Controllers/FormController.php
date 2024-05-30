<?php

namespace App\Http\Controllers;

use App\Jobs\SendFormCreatedNotification;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function edit($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('forms.edit', compact('form'));
    }

    public function show($slug)
    {
//        $form = Form::with('fields')->findOrFail($id);
//        return view('forms.show', compact('form'));
        $form = Form::with('fields')->where('slug', $slug)->firstOrFail();
        return view('forms.show', compact('form'));
    }


    public function store(Request $request)
    {
        $form = Form::create([
            'name' => $request->input('name'),
        ]);
        $rules = [
            'name' => 'required',
            'label.*' => 'required',
            'type.*' => 'required|in:text,number,select',
            'options.*' => 'sometimes|required_if:type.*,select'
        ];

        $messages = [
            'name.required' => 'The form title is required.',
            'label.*.required' => 'The field label is required.',
            'type.*.required' => 'The field type is required.',
            'type.*.in' => 'Invalid field type.',
            'options.*.required_if' => 'Options are required for select fields.'
        ];
        $request->validate($rules, $messages);
        $labels = $request->input('label');
        $types = $request->input('type');
        $options = $request->input('options', []);

        foreach ($labels as $index => $label) {
            $type = $types[$index];
            $fieldOptions = $type == 'select' ? json_encode(explode(',', $options[$index] ?? '')) : null;

            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'type' => $type,
                'options' => $fieldOptions,
            ]);
        }
        SendFormCreatedNotification::dispatch($form)->delay(now()->addMinutes(1));
        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        $form->update([
            'name' => $request->input('name'),
        ]);

        FormField::where('form_id', $form->id)->delete();

        $labels = $request->input('label');
        $types = $request->input('type');
        $options = $request->input('options', []);

        foreach ($labels as $index => $label) {
            $type = $types[$index];
            $fieldOptions = $type == 'select' ? json_encode(explode(',', $options[$index] ?? '')) : null;

            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'type' => $type,
                'options' => $fieldOptions,
            ]);
        }
        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form Deleted successfully.');
    }

    public function submit(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        $rules = [
            'fields.*' => 'required',
        ];

        $messages = [
            'fields.*.required' => 'The :attribute field is required.',
        ];
        $customAttributes = [];

        foreach ($form->fields as $field) {
            $customAttributes["fields.{$field->id}"] = $field->label;
        }

        $attributes = array_merge($customAttributes, $request->all());

        $this->validate($request, $rules, $messages, $attributes);
//        $request->validate($rules, $messages);
        foreach ($request->input('fields') as $fieldId => $value) {
            FormSubmission::create([
                'form_id' => $form->id,
                'form_field_id' => $fieldId,
                'value' => $value,
            ]);
        }

        return redirect()->route('forms.show', $form->slug)->with('success', 'Form submitted successfully.');
    }
}
