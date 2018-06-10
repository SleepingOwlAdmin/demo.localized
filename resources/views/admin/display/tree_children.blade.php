@foreach ($children as $entry)
    <li class="dd-item dd3-item {{ $reorderable ? '' : 'dd3-not-reorderable' }}" data-id="{{ $entry->id }}">
        @if ($reorderable)
            <div class="dd-handle dd3-handle"></div>
        @endif

        <div class="dd3-content">
            {{ $entry->title }}

            <div class="pull-right">
                @foreach ($entry->locale_buttons as $value)
                    {{ $value }}
                @endforeach

                @foreach ($controls as $control)
                    @if($control instanceof \SleepingOwl\Admin\Contracts\Display\ColumnInterface)
                        <?php
                            $control->setModel($entry);
                            $control->initialize();
                        ?>
                    @endif

                    {!! $control->render() !!}
                @endforeach
            </div>
        </div>
    </li>
@endforeach