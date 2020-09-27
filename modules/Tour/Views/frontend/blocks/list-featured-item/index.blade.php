@if($list_item)
    <div class="bravo-featured-item {{$style ?? ''}} layout_carousel">
        <div class="container">
            <div class="row">
                @if(count($list_item) > 3)
                    <div class="owl-carousel">
                        @foreach($list_item as $k=>$item)
                        <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                            <div class="featured-item">
                                <div class="image">
                                    @if(!empty($style) and $style == 'style2')
                                    <span class="number-circle">{{$k+1}}</span>
                                    @else
                                    <img src="{{$image_url}}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        {{$item['title']}}
                                    </h4>
                                    <div class="desc">{!! clean($item['sub_title']) !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(count($list_item) <= 3)
                    @foreach($list_item as $k=>$item)
                    <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                    <div class="col-md-4">
                        <div class="featured-item">
                            <div class="image">
                                @if(!empty($style) and $style == 'style2')
                                <span class="number-circle">{{$k+1}}</span>
                                @else
                                <img src="{{$image_url}}" class="img-fluid">
                                @endif
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    {{$item['title']}}
                                </h4>
                                <div class="desc">{!! clean($item['sub_title']) !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif
