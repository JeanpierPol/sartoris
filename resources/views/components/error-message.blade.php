@if ($errors->has($field))
    <div class="invalid-feedback">
    </div>
    <code>{{ $errors->first($field) }}</code>
@endif
