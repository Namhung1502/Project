@extends('frontend.layouts.app')

@section('content')
@if(session('msg'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{session('msg')}}
</div>
@endif
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    <div class="single-blog-post">
        @if(!empty($data))
        {{-- {{dd($data)}} --}}
        <h3>{{$data['title']}}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Mac Doe</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
            <!-- <span>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
            </span> -->
        </div>
        <a href="">
            <img src="{{asset('uploads/user/blog/' . $data['avatar'])}}" alt="">
        </a>
        {!! $data['content'] !!}
        @endif
        <div class="pager-area">
            <ul class="pager pull-right">
                @if(!empty($previous))
                <li><a href="{{ URL::to('blog-list/blog-detail/' . $previous)}}">Pre</a></li>
                @endif
                @if(!empty($next))
                <li><a href="{{ URL::to('blog-list/blog-detail/' . $next)}}">Next</a></li>
                @endif
            </ul>
        </div>
    </div>
</div><!--/blog-post-area-->

<div class="rating-area">
    <div class="rate">
        <div class="vote">
            @for($i=1; $i<=5; $i++)
                @if($i <= $dataRate)
                    <div class="star_1 ratings_stars ratings_over"><input value="{{$i}}" type="hidden"></div>
                @else
                    <div class="star_1 ratings_stars"><input value="{{$i}}" type="hidden"></div>
                @endif
            @endfor

            <span class="rate-np">{{$dataRate}}</span>
        </div>
    </div>
    <ul class="tag">
        <li>TAG:</li>
        <li><a class="color" href="">Pink <span>/</span></a></li>
        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
        <li><a class="color" href="">Girls</a></li>
    </ul>
</div><!--/rating-area-->

<div class="socials-share">
    <a href=""><img src="images/blog/socials.png" alt=""></a>
</div><!--/socials-share-->

<!-- <div class="media commnets">
    <a class="pull-left" href="#">
        <img class="media-object" src="images/blog/man-one.jpg" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Annie Davis</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="blog-socials">
            <ul>
                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
            </ul>
            <a class="btn btn-primary" href="">Other Posts</a>
        </div>
    </div>
</div> -->
<!--Comments-->
<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul class="media-list">
        @if($dataCommentUser)
        @foreach($dataCommentUser as $value)
            @if($value->level == 0)
            <li class="media" id="{{$value->id}}">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset('uploads/user/avatar/' . $value->avatar)}}" alt="">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{$value->name}}</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    <p>{{$value->cmt}}</p>
                    <a class="btn btn-primary btn-reply" ><i class="fa fa-reply"></i>Replay</a>
                    <div class="formReply reply-form" style="display: none;">
                        <input type="text" class="form-control reply-input" placeholder="Your reply...">
                        <button class="btn btn-primary btn-submit-reply" data-id="{{$value->id}}">Submit</button>
                    </div>
                </div>
            </li>
            @endif
            @foreach($dataCommentUser as $item)
                @if($item->level == $value->id)
                    <li class="media second-media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="{{asset('uploads/user/avatar/' . $item->avatar)}}" alt="">
                        </a>
                        <div class="media-body">
                            <ul class="sinlge-post-meta">
                                <li><i class="fa fa-user"></i>{{$item->name}}</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <p>{{$item->cmt}}</p>
                            <a class="btn btn-primary btn-reply" ><i class="fa fa-reply"></i>Replay</a>
                            <div class="formReply reply-form" style="display: none;">
                                <input type="text" class="form-control reply-input" placeholder="Your reply...">
                                <button class="btn btn-primary btn-submit-reply" data-id="{{$item->id}}">Submit</button>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        @endforeach
        @else
        <li>Không có dữ liệu</li>
        @endif
    </ul>
</div>
<!--/Response-area-->
<form action="" method="POST">
<div class="replay-box">
    <div class="row">
        <div class="col-sm-12">
            <h2>Leave a replay</h2>

            <div class="text-area">
                <div class="blank-arrow">
                    <label>Your Name</label>
                </div>
                <span>*</span>
                <textarea id="destination" name="message" rows="11"></textarea>
                <a class="btn btn-primary btn-comment">post comment</a>
            </div>
        </div>
    </div>
</div><!--/Repaly Box-->
</form>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote');
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function(){
            //gọi auth php vào
            var checkLogin = "{{Auth::check()}}";
            if(checkLogin){
                var rate = $(this).find("input").val();
                // alert(rate);
                if($(this).hasClass('ratings_over')){
                    $('.ratings_stars').removeClass('ratings_over');
                    $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }

                $.ajax({
                    type: 'POST',
                    url:'{{url("blog-list/blog-detail/rate/ajax")}}',
                    data:{
                        rate:rate,
                        id_blog:{{$data['id']}}
                    },
                    success:function(data){
                          console.log(data.success);
                    }
                });
                var currentRate = $(this).closest("div.vote").find("span.rate-np");
                // alert(currentRate)
                currentRate.text(rate);
            } else {
                alert('vui long login de rate');
            }

        });

        $('.btn-comment').click(function(){
            var checkLogin = "{{Auth::check()}}";
            var message = $(this).closest('.text-area').find('textarea#destination').val();
            var html = "";
            if(checkLogin){
                // alert('ddax login');
                $.ajax({
                    type: 'POST',
                    url:'{{url("blog-list/blog-detail/cmt/ajax")}}',
                    data:{
                        cmt: message,
                        id_blog:{{$data['id']}},
                        id_user:{{Auth::id()}},
                        up: 1
                    },
                    success:function(data){
                        var img = "{{asset('uploads/user/avatar/')}}" +"/"+ data.data[0]['avatar'];
                        if(data.up == 1){


                        html += '<li class="media">'+
                                    '<a class="pull-left" href="#">'+
                                        '<img class="media-object" src="' + img + '" alt="">'+
                                    '</a>'+
                                    '<div class="media-body">'+
                                        '<ul class="sinlge-post-meta">'+
                                            '<li><i class="fa fa-user"></i>Janis Gallagher</li>'+
                                            '<li><i class="fa fa-clock-o"></i> 1:33 pm</li>'+
                                            '<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>'+
                                        '</ul>'+
                                        '<p>'+ data.data[0]['cmt']+'</p>'+
                                        '<a class="btn btn-primary btn-reply" href=""><i class="fa fa-reply"></i>Replay</a>'+
                                    '</div>'+
                                '</li>';
                        $(".response-area .media-list").append(html);
                        }
                    }
                });

            } else {
                alert('Vui lòng login để commment');
            }
        });

        $('.btn-reply').click(function(){
            $('.formReply').hide();
            // Tìm đến phần tử cha chứa nút reply đã click
            var parentMedia = $(this).closest(".media");

            // Hiển thị form reply tương ứng
            parentMedia.find(".reply-form").show();

        });
        $('.btn-submit-reply').click(function(){
            var checkLogin = "{{Auth::check()}}";
            var message = $(this).closest('.reply-form').find('input').val();
            var id = $(this).data('id');

            var html = "";
            if(checkLogin){
                $.ajax({
                    type: 'POST',
                    url:'{{url("blog-list/blog-detail/cmt/ajax")}}',
                    data:{
                        cmt: message,
                        id_blog:{{$data['id']}},
                        id_user:{{Auth::id()}},
                        id_cmt: id,
                        up:2
                    },
                    success:function(data){
                        console.log(data);
                        var img = "{{asset('uploads/user/avatar/')}}" +"/"+ data.data[0]['avatar'];
                        if(data.up == 2){
                        html += '<li class="media second-media">'+
                                    '<a class="pull-left" href="#">'+
                                        '<img class="media-object" src="' + img + '" alt="">'+
                                    '</a>'+
                                    '<div class="media-body">'+
                                        '<ul class="sinlge-post-meta">'+
                                            '<li><i class="fa fa-user"></i>Janis Gallagher</li>'+
                                            '<li><i class="fa fa-clock-o"></i> 1:33 pm</li>'+
                                            '<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>'+
                                        '</ul>'+
                                        '<p>'+ data.data[0]['cmt']+'</p>'+
                                        '<a class="btn btn-primary btn-reply" href=""><i class="fa fa-reply"></i>Replay</a>'+
                                    '</div>'+
                                '</li>';
                        $(".media-list #" + id).append(html);
                        }
                    }
                })
            } else {
                alert('vui lòng login để reply')
            }
        });
    });
</script>
@endsection


