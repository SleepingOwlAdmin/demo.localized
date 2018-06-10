@yield('before.panel')

<div class="panel panel-default">
    <div class="panel-heading">

        @foreach($buttons as $locale => $data)
            <a href="{{ url($data['url']) }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> {{ $data['text'] }}
            </a>
        @endforeach

        @yield('panel.buttons')
        <div class="pull-right">
            @yield('panel.heading.actions')
        </div>
    </div>
    @yield('panel.heading')

    <div class="panel-body">
        <div class="dd nestable" {!! $attributes !!} data-url="{{ $url }}/reorder">
            <ol class="dd-list">
                @include('admin.display.tree_children', ['children' => $items])
            </ol>
        </div>
    </div>

    @yield('panel.footer')
</div>

@yield('after.panel')
