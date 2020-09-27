<form action="{{ route("space.search") }}" class="form bravo_form" method="get">
    <div class="g-field-search">
        <div class="row">
            @php $space_search_fields = setting_item_array('space_search_fields');
            $space_search_fields = array_values(\Illuminate\Support\Arr::sort($space_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($space_search_fields))
                @foreach($space_search_fields as $field)
                    <div class="col-md-{{ $field['size'] ?? "6" }} border-right elements-wrapper">
                        @switch($field['field'])
                            @case ('service_name')
                                @include('Space::frontend.layouts.search.fields.service_name')
                            @break
                            @case ('location')
                                @include('Space::frontend.layouts.search.fields.location')
                            @break
                            @case ('date')
                                @include('Space::frontend.layouts.search.fields.date')
                            @break
                            @case ('guests')
                                @include('Space::frontend.layouts.search.fields.guests')
                            @break
                        @endswitch
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="g-button-submit">
        <button class="btn btn-primary btn-search" type="submit">{{__("Search")}}</button>
    </div>
</form>
