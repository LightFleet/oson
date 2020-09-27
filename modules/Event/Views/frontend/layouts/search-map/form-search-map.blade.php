<form action="{{url( app_get_locale(false,false,'/').env('EVENT_ROUTE_PREFIX','event') )}}" class="form bravo_form d-flex justify-content-start" method="get">
    @php $event_map_search_fields = setting_item_array('event_map_search_fields');

    $event_map_search_fields = array_values(\Illuminate\Support\Arr::sort($event_map_search_fields, function ($value) {
        return $value['position'] ?? 0;
    }));

    @endphp
    @if(!empty($event_map_search_fields))
        @foreach($event_map_search_fields as $field)
            @switch($field['field'])
                @case ('location')
                    @include('Event::frontend.layouts.search-map.fields.location')
                @break
                @case ('attr')
                    @include('Event::frontend.layouts.search-map.fields.attr')
                @break
                @case ('date')
                    @include('Event::frontend.layouts.search-map.fields.date')
                @break
                @case ('price')
                    @include('Event::frontend.layouts.search-map.fields.price')
                @break
                @case ('advance')
                <div class="filter-item filter-simple">
                    <div class="form-group">
                        <span class="filter-title toggle-advance-filter" onclick="showHideAdvancesBlock();">{{__('More filters')}} <i class="fa fa-angle-down"></i></span>
                    </div>
                    <div class="advances-block" id="advances-block">
                        @php
                            $selected = (array) Request::query('terms');
                        @endphp
                        @foreach ($attributes as $item)
                            @php
                                $translate = $item->translateOrOrigin(app()->getLocale());
                            @endphp
                            <h4> {{$translate->name}} </h4>
                            @php
                                $translate = $item->translateOrOrigin(app()->getLocale());
                            @endphp
                            <ul>
                                @foreach($item->terms as $key => $term)
                                    @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                    <li @if($key > 2 and empty($selected)) class="hide" @endif>
                                        <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                        <span class="checkmark"></span>
                                @endforeach
                            </ul>
                        @endforeach
                        <div class="form-group advances-block__apply-filter-btn">
                            <input onclick="showHideAdvancesBlock();" class="btn btn-primary btn-search" type="button" value="{{__('Apply Filters')}}">
                        </div>
                    </div>
                </div>
                @break

            @endswitch
        @endforeach
    @endif
    <div class="filter-item filter-simple">
        <div class="form-group">
            <input class="btn btn-primary btn-search" type="submit" value="{{__('Search')}}">
        </div>
    </div>
</form>
