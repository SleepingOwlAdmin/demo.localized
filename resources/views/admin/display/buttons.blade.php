@foreach($urls as $locale => $data)
<a href="{{ url($data['url']) }}" class="btn btn-primary">
    <i class="fa fa-plus"></i> {{ $data['text'] }}
</a>
@endforeach