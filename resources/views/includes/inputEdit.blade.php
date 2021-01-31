<label for="{{ $fieldId }}">{{ $labelText }}</label>
<input value="{{ $fieldValue }}" type="text" class="form-control
            {{ $errors->has($fieldId) ? 'is-invalid' : '' }}" 
        name="{{ $fieldId }}" id="{{ $fieldId }}" placeholder="{{ $placeholderText }}">

@include('includes/validationErr', ['errFieldName' => $fieldId])
        