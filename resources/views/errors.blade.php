@if ($errors->get($name))
    <ul class="field mt-6 list-reset">
        <li class="text-sm text-red">{{ $errors->first($name) }}</li>
    </ul>
@endif
