<x-col size="12">
    <h3>{{ count($files) }} Error Logs </h3>
    <ol>
        @foreach ($files as $file)
            <li>
                <a href="?_act=artisan&cmd=error-show&log={{ $file->getFilename() }}">{{ $file->getFilename() }}</a>
            </li>
        @endforeach
    </ol>
    <pre>
        {{ dddx($matches) }}
    {!! $content !!}
    </pre>
</x-col>
