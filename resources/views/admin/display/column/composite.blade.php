@foreach($columns as $column)
    <h5><strong>{{ $column->getHeader()->getTitle() }}</strong></h5>
    {!! $column->render() !!}
@endforeach