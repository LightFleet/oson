@if($list_item)
    <style>
        .review_item{

            width: 100%;
        }
        .bravo_wrap .page-template-content .bravo-testimonial .item{

            width: 90%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
    <div class="bravo-testimonial slider_reviews">
        <div class="container">
            <h3>{{$title}}</h3>
            <div class="row">
                <div class="owl-carousel">
                @foreach($list_item as $item)
                    <?php $avatar_url = get_file_url($item['avatar'], 'full') ?>
                    <div class="review_item">
                        <div class="item has-matchHeight">
                            <div class="author">
                                <img src="{{$avatar_url}}" alt="{{$item['name']}}">
                                <div class="author-meta">
                                    <h4>{{$item['name']}}</h4>
                                    @if($item['number_star'])
                                        <div class="star">
                                            @for($i = 0 ; $i < $item['number_star'] ; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p>
                                {{$item['desc']}}
                            </p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endif