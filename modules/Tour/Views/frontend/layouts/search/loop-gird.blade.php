@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
{{--{{dd($row)}}--}}
<div class="item-tour {{$wrap_class ?? ''}}">
    @if($row->is_featured == "1")
        <div class="featured">
            {{__("Featured")}}
        </div>
    @endif
    <div class="thumb-image">
        @if($row->discount_percent)
            <div class="sale_info">{{$row->discount_percent}}</div>
        @endif
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            @if($row->image_url)
                @if(!empty($disable_lazyload))
                    <img src="{{$row->image_url}}" class="img-responsive" alt="{{$location->name ?? ''}}">
                @else
                    {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$row->title]) !!}
                @endif
            @endif
        </a>
        <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
            <i class="fa fa-heart"></i>
        </div>
    </div>
    <div class="location">
        @if(!empty($row->location->name))
            @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
            <i class="icofont-paper-plane"></i>
            {{$location->name ?? ''}}
        @endif
    </div>
    <div class="item-title">
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            {{$translation->title}}
        </a>
    </div>
    @if(setting_item('tour_enable_review'))
    <?php
    $reviewData = $row->getScoreReview();
    $score_total = $reviewData['score_total'];
    ?>
    <div class="service-review tour-review-{{$score_total}}">
        <div class="list-star">
            <ul class="booking-item-rating-stars">
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
            </ul>
            <div class="booking-item-rating-stars-active" style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                <ul class="booking-item-rating-stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </ul>
            </div>
        </div>
        <span class="review">
            @if($reviewData['total_review'] > 1)
                {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
            @else
                {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
            @endif
        </span>
    </div>
    @endif
    <div class="info">
        <div class="duration">
            <i class="icofont-wall-clock"></i>
            {{duration_format($row->duration)}}
        </div>
        <div class="g-price">
            <div class="prefix">
                <i class="icofont-flash"></i>
                <span class="fr_text">{{__("from")}}</span>
            </div>
            <div class="price">
                <span class="onsale">{{ $row->display_sale_price }}</span>
                <span class="text-price">{{ $row->display_price }}</span>
            </div>
        </div>
    </div>


        <style>
            .hotel_more_btn {
                text-align: right;
                margin-top: 22px;
                color: #ecd9d9;
            }
            .btn_hotel_more_btn {
                padding-left : 12px;
                width : 90%;
            }
            .btn_hotel_buy_btn{
                width : 90%;
                margin-left : 10px;
            }
            .btn_hotel_more_btn {
                box-shadow: rgba(0, 0, 0, 0.4) 0px 1px 7px 0px;
                background: rgb(255, 255, 255);
                color: #ecd9d9;
            }
            .btn_hotel_more_btn:hover {
                color: #fff;
            }
        </style>

        <div class="hotel-buttons-block">
            <div class="hotel_more_btn">
                <a class="btn btn-primary btn_hotel_more_btn head-rating" target="_blank"  href="{{$row->getDetailUrl()}}">{{__("Link More")}}</a>
            </div>
            <div class="hotel_buy_btn">
                <a class="btn btn-outline-primary btn_hotel_buy_btn" href="{{$row->getDetailUrl() . '?quickbuy=true'}}">{{__("Book")}}</a>
            </div>
        </div>
</div>
