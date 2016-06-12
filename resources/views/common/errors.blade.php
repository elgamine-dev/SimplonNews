@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="ui message error">
        <strong>Whoops! Something went wrong!</strong>

        <br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
