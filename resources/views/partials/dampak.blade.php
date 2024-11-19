@foreach ($dampak as $option)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="selected_options[]" value="{{ $option->id }}" id="option{{ $option->id }}">
        <label class="form-check-label" for="option{{ $option->id }}">
            {{ $option->nama_dampak }}
        </label>
    </div>
@endforeach