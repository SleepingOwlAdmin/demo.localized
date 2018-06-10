<div {!! $attributes !!}>
    <div class="panel-heading bg-primary collapsed"
         role="button"
         data-toggle="collapse"
         data-parent="#accordion"
         href="#{{ $id }}"
         aria-expanded="false"
         aria-controls="{{ $id }}">
        <h4 class="panel-title">
            {{ $title }}
        </h4>
    </div>
    <div id="{{ $id }}" class="panel-collapse collapse {{ $expanded }}" role="tabpanel">
        <div class="panel-body">
            @include(AdminTemplate::getViewPath('form.partials.elements'), ['items' => $elements])
        </div>
    </div>
</div>
