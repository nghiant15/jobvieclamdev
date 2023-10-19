@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Company cover -->

<!-- Inner Page Title start -->
<!-- Inner Page Title end -->
{{-- @if(null!==($blog))


<div class="">
    <section id="blog-content">
        <div class="container">
            <?php
            $cate_ids = explode(",", $blog->cate_id);
            $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
            $cate_array = array();
            foreach ($data as $cat) {
                $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
            }
            ?>
            <!-- Blog start -->
            <div class="row">
                <div class="col-lg-9">
                    <!-- Blog List start -->
                    <div class="blogWraper">
                        <div class="blogList">
                            <div class="blog-detail bloginner pb-5">
                                <h2>{{$blog->heading}}</h2>
<div class="postimg">{{$blog->printBlogImage()}}</div>
<div class="post-header">
    <!-- <div class="postmeta">Category : {!!implode(', ',$cate_array)!!}</div> -->
</div>
<p>{!! $blog->content !!}</p>
</div>
</div>
</div>
</div>

<div class="col-lg-3">

    <div class="sidebar">
        <!-- Search -->
        <div class="widget">
            <h5 class="widget-title">{{__('Search')}}</h5>
            <div class="search">
                <form action="{{route('blog-search')}}" method="GET">
                    <input type="text" class="form-control" placeholder="{{__('Search')}}" name="search">
                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <!-- Categories -->
        @if(null!==($categories))
        <div class="widget">
            <h5 class="widget-title">{{__('Categories')}}</h5>
            <ul class="categories">
                @foreach($categories as $category)
                <li><a href="{{url('/blog/category/').'/'.$category->slug}}">{{$category->heading}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
</div>
</div>
</section>
<div class="container">
    <hr>
</div>
<section class="">
    <div class="container">

        <h3 class="section-title aline-left mb-3">{{__('Related post')}}</h3>
        <div class="blogwrapper">
            <div class="blogList">
                <div class="row">
                    @if(!empty($data))
                    @foreach($data as $item)
                    @php($posts = \App\Blog::where('cate_id', 'like', $item->id)->where('id','!=',$blog->id)->get())
                    @foreach($posts as $related_post)
                    <div class="col-xl-3 col-lg-4 col-md-4 mb-3">
                        <a href="{{route('blog-detail',$related_post->slug)}}" class="bloginner">
                            <div class="postimg">{{$related_post->printBlogImage()}}</div>
                            <div class="post-header li-text">

                                <h4>
                                    <span class="li-head">{{$related_post->heading}}</span>
                                </h4>

                            </div>

                        </a>
                    </div>
                    @endforeach
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
</div>

@endif

--}}


<div class="blog-single gray-bg">
    <div class="container">
        <?php
        $cate_ids = explode(",", $blog->cate_id);
        $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
        $cate_array = array();
        foreach ($data as $cat) {
            $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
        }
        ?>
        <div class="row align-items-start">
            <div class="col-lg-12 m-15px-tb">
                <article class="article">
                    <div class="article-title">
                        <h6><a href="#">KỸ NĂNG CÔNG SỞ</a></h6>
                        <h2>{{$blog->heading}}</h2>
                        <div class="media">
                            
                            <div class="media-body">
                                <span>Thứ năm, 19/10/2023, 13:40 (GMT+7)</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-img">
                        {{$blog->printBlogImage()}}
                    </div>
                    <div class="article-content" bis_skin_checked="1">
                        <p>Chúng ta luôn có những cột mốc đánh dấu sự trưởng thành của bản thân. Năm bạn 12 tuổi, bạn băn khoăn làm sao để có thể giành được những con điểm tốt nhất khiến bố mẹ tự hào. Năm bạn 15 tuổi, bạn nhận ra điểm số cũng quan trọng nhưng nó không quan trọng bằng việc bạn hiểu vấn đề đó như thế nào.</p>
                        <p>Năm bạn 17 tuổi, bạn đang đứng giữa ranh giới của sự chín chắn và chút ngây thơ vì chưa từng được va vấp, không biết nên đi theo định hướng sẵn có, với những nhu cầu của công việc xã hội hay đi theo đam mê của bản thân?</p>
                        <h4>Liệu bạn có đang suy nghĩ làm cách nào để chọn được công việc tốt nhất?</h4>

                        <p>Một công việc tốt nhất, là điều mà chúng ta luôn nghĩ đến. Nhưng thế nào mới là tốt?&nbsp; Là lợi ích từ công việc đó mang đến cho bạn? Là bạn có thể kiếm được rất nhiều tiền từ công việc bạn chọn, hay là vì nó giúp bạn có thêm được những kinh nghiệm. Vì chúng ta đều rất do dự giữa nhu cầu của xã hội và đam mê của chính bản thân, phân vân giữa năng lực của bản thân với những yêu cầu khắt khe của cuộc sống, của công việc. Vậy chúng ta cần làm gì?</p>
                        <p>Không có một công việc nào được đánh giá là tốt nhất, nó giống như việc bạn đang so sánh giữa một người với một người vậy. Có phải rằng chẳng ai trong chúng ta là hoàn hảo, cũng giống như công việc, chẳng có cái nào là tốt nhất, chỉ có thể tốt hơn, hoặc ổn định hơn mà thôi. Vì thế khi chọn một công việc cho bản thân, nhất định điều quan trọng bạn phải làm đó là chọn một công việc đủ ổn định về kinh tế và thât phù hợp với năng lực của mình.</p>
                        <h4>Làm sao để chọn được công việc phù hợp với năng lực?</h4>
                        <p>Chúng ta đang sống trong thời đại của công nghệ, sống trong những áp lực của xã hội mà nhân tố con người là điều quan trọng nhất. Có ba điều chúng ta cần phải xác định chắc chắn trước khi chọn công việc rằng :</p>
                        <ul>
                            <li>Bạn nhận thấy bản thân mình có ưu điểm nhiều nhất về lĩnh vực nào?</li>
                            <li>Sẽ mất khoảng bao lâu để bạn được đào tạo và tiếp xúc với công việc đó?</li>
                            <li>Thu nhập từ công việc đó có thể ổn định được cuộc sống của bạn không? Có đáp ứng được những nhu cầu của bản thân bạn không?</li>
                        </ul>
                        <p>Khi bạn đang phân vân với những lựa chọn của mình, hãy trả lời ba câu hỏi trên. Có thể điều đó sẽ giúp ích được bạn phần nào trong việc lựa chọn nghề của mình. Chúng ta cần một công việc, nhưng không phải công việc nào cũng có thể phù hợp với bạn, quan trọng là bạn phải biết năng lực của mình đang nằm ở đâu. Giống như câu “cá gặp nước”, có ở đúng trong môi trường phù hợp, chúng ta mới có thể phát huy được hết những khả năng trong con người mình.</p>
                        <p>Việc xác định năng lực bản thân chính là bước đầu tiên để bạn chọn một công việc phù hợp. Bạn có thể tìm hiểu tất cả các công việc, ngành nghề&nbsp; thông qua các phương tiện truyền thông, thật dễ dàng chỉ với một cú click chuột là chúng ta có thể tiếp cận được với những thứ ta đang muốn biết về chúng. Từ đó bạn sẽ dễ dàng cập nhật thông tin, quan sát, theo dõi khả năng của bản thân để chọn được một công việc phù hợp nhất.</p>

                        <h4>Nên chọn nghề theo định hướng gia đình hay đam mê của bản thân?</h4>


                        <p>Hãy gọi đó là một bước ngoặt lớn trong sự trưởng thành của chính bạn. Nếu bạn đang phân vân điều đó, hãy tự hỏi bản thân mình rằng những điều bạn được định hướng sẽ giúp bạn điều gì và việc bạn đang định làm sẽ giúp bạn điều gì.</p>
                        <p>Mong muốn của các bậc phụ huynh, vì là người đi trước nên tâm lí của họ luôn muốn bạn hướng đến một công việc ổn định, và đi theo hướng đó bạn sẽ có nhiều cơ hội hơn để có được khoản thu nhập tạm gọi là tốt cho bản thân. Tuy nhiên, vì nó nằm trong vòng an toàn nên có lẽ sẽ không giúp bạn thử thách được bản thân.</p>
                        <p>Đam mê chỉ đúng khi năng lực bạn phù hợp với nó, vì nếu đam mê nhưng không có năng lực chuyên môn, bạn cũng sẽ bị đào thải nhanh chóng. Hãy suy nghĩ về đam mê trong khả năng mà bạn có thể bảo đảm rằng bạn làm được. Nếu như vậy, kết quả sẽ rất tuyệt vời, vì vừa có được công việc mình mong muốn, vừa có được niềm vui.</p>
                        <p>Chưa nói về thu nhập nhưng có một công việc khiến bạn cảm thấy vui và lúc nào cũng sẵn sàng hết mình vì nó, đó không phải là một tin hiệu tốt sao? Theo định hướng hay đam mê, đó là do quyết định của cá nhân, nhưng nếu có một lựa chọn khiến bạn nên cân nhắc thì đó nên là một công việc đúng với ý thích của bạn và mang lại cho bạn nguồn thu nhập ổn định để gia đình bạn có thể thật yên tâm và tự hào về bạn.</p>

                    </div>
                    <!-- <div class="nav tag-cloud">
                        <a href="#">Design</a>
                        <a href="#">Development</a>
                        <a href="#">Travel</a>
                        <a href="#">Web Design</a>
                        <a href="#">Marketing</a>
                        <a href="#">Research</a>
                        <a href="#">Managment</a>
                    </div> -->
                    <div class="media">
                            <div class="media-body">
                                <label>Phạm Thị Thu Hiền</label>
                            </div>
                        </div>
                </article>

            </div>
        </div>
    </div>

    <div class="container">
        <hr>
    </div>

    <div class="container">
        <h3 class="section-title aline-left mb-3">{{__('Related post')}}</h3>
        <div class="row align-items-start " bis_skin_checked="1">
            <div class="col-md-6 col-lg-4 mb-4 " bis_skin_checked="1">
                <div class="figure" bis_skin_checked="1">
                    <a href="http://localhost:8000/blog/cau-chuyn-chn-ngh" class="figure-images"><img src="https://contenthub-static.grammarly.com/blog/wp-content/uploads/2017/11/how-to-write-a-blog-post.jpeg" alt=""></a>
                    <div class="figcaption" bis_skin_checked="1">
                        <h3 class="figcaption__category-name"><a href="#">KỸ NĂNG CÔNG SỞ</a></h3>
                        <div class="figcaption__title" bis_skin_checked="1"><a href="#">Flex là gì? Làm sao thoát flexing đồng nghiệp hay
                                khoe khoang?</a></div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 " bis_skin_checked="1">
                <div class="figure" bis_skin_checked="1">
                    <a href="" class="figure-images"><img src="https://nghenghiep.vieclam24h.vn/wp-content/uploads/2023/08/do-loi.jpg" alt=""></a>
                    <div class="figcaption" bis_skin_checked="1">
                        <h3 class="figcaption__category-name"><a href="#">KỸ NĂNG CÔNG SỞ</a></h3>
                        <div class="figcaption__title" bis_skin_checked="1"><a href="#">Tìm việc trực tuyến an toàn và cảnh
                                giác trước
                                các công việc nhẹ lương cao</a></div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 " bis_skin_checked="1">
                <div class="figure" bis_skin_checked="1">
                    <a href="" class="figure-images"><img src="https://nghenghiep.vieclam24h.vn/wp-content/uploads/2023/08/ket-ban-voi-dong-nghiep.jpg" alt=""></a>
                    <div class="figcaption" bis_skin_checked="1">
                        <h3 class="figcaption__category-name"><a href="#">THỊ TRƯỜNG LAO ĐỘNG</a></h3>
                        <div class="figcaption__title" bis_skin_checked="1"><a href="#">Những nguyên tắc ngầm khi giao tiếp, kết bạn với
                                đồng nghiệp nơi công sở </a></div>

                    </div>
                </div>
            </div>
        </div>
    </div>



















    @include('templates.vietstar.includes.footer')
    @endsection
    @push('styles')
    <style>
        .blog-listing {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .article-img {
            width: 100%;
            padding-top: 50%;
            position: relative;
            height: 350px;
            margin-bottom: 10px;

        }

        .article-img img {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            object-fit: contain;

        }

        .gray-bg {
            background-color: #f5f5f5;
        }

        /* Blog 
---------------------*/
        .blog-grid {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .blog-grid .blog-img {
            position: relative;
        }

        .blog-grid .blog-img .date {
            position: absolute;
            background: #fc5356;
            color: #ffffff;
            padding: 8px 15px;
            left: 10px;
            top: 10px;
            border-radius: 4px;
        }

        .blog-grid .blog-img .date span {
            font-size: 22px;
            display: block;
            line-height: 22px;
            font-weight: 700;
        }

        .blog-grid .blog-img .date label {
            font-size: 14px;
            margin: 0;
        }

        .blog-grid .blog-info {
            padding: 20px;
        }

        .blog-grid .blog-info h5 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .blog-grid .blog-info h5 a {
            color: #20247b;
        }

        .blog-grid .blog-info p {
            margin: 0;
        }

        .blog-grid .blog-info .btn-bar {
            margin-top: 20px;
        }


        /* Blog Sidebar
-------------------*/
        .blog-aside .widget {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 15px;
            margin-bottom: 15px;
            width: 100%;
            display: inline-block;
            vertical-align: top;
        }

        .blog-aside .widget-body {
            padding: 15px;
        }

        .blog-aside .widget-title {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .blog-aside .widget-title h3 {
            font-size: 20px;
            font-weight: 700;
            color: #fc5356;
            margin: 0;
        }

        .blog-aside .widget-author .media {
            margin-bottom: 15px;
        }

        .blog-aside .widget-author p {
            font-size: 16px;
            margin: 0;
        }

        .blog-aside .widget-author .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
        }

        .blog-aside .widget-author h6 {
            font-weight: 600;
            color: var(--bs-primary);
            font-size: 22px;
            margin: 0;
            padding-left: 20px;
            margin-top: 10px;
        }

        .blog-aside .post-aside {
            margin-bottom: 15px;
        }

        .blog-aside .post-aside .post-aside-title h5 {
            margin: 0;
        }

        .blog-aside .post-aside .post-aside-title a {
            font-size: 18px;
            color: #20247b;
            font-weight: 600;
        }

        .blog-aside .post-aside .post-aside-meta {
            padding-bottom: 10px;
        }

        .blog-aside .post-aside .post-aside-meta a {
            color: #6F8BA4;
            font-size: 12px;
            text-transform: uppercase;
            display: inline-block;
            margin-right: 10px;
        }

        .blog-aside .latest-post-aside+.latest-post-aside {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .blog-aside .latest-post-aside .lpa-right {
            width: 90px;
        }

        .blog-aside .latest-post-aside .lpa-right img {
            border-radius: 3px;
        }

        .blog-aside .latest-post-aside .lpa-left {
            padding-right: 15px;
        }

        .blog-aside .latest-post-aside .lpa-title h5 {
            margin: 0;
            font-size: 15px;
        }

        .blog-aside .latest-post-aside .lpa-title a {
            color: #20247b;
            font-weight: 600;
        }

        .blog-aside .latest-post-aside .lpa-meta a {
            color: #6F8BA4;
            font-size: 12px;
            text-transform: uppercase;
            display: inline-block;
            margin-right: 10px;
        }

        .tag-cloud a {
            padding: 4px 15px;
            font-size: 13px;
            color: #ffffff;
            background-color: var(--bs-primary);
            border-radius: 3px;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .tag-cloud a:hover {
            background: #fc5356;
        }

        .blog-single {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .article {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            padding: 50px;
            margin: 15px 0 30px;
        }

        .article .article-title {
            padding: 15px 0 20px;
        }

        .article .article-title h6 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--bs-primary);
        }

        .article .article-title h6 a {
            text-transform: uppercase;
            color: var(--bs-primary);
            border-bottom: 1px solid var(--bs-primary);
        }

        .article .article-title h2 {
            color: var(--text-main);
            font-weight: 600;
            font-size: 3rem;
        }

        .article .article-title .media {
            padding-top: 15px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 20px;
        }

        .article .article-title .media .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
        }

        .article .article-title .media .media-body {
            padding-left: 8px;
        }

        .article .article-title .media .media-body label {
            font-weight: 600;
            color: #fc5356;
            margin: 0;
        }

        .article .article-title .media .media-body span {
            display: block;
            font-size: 14px;
        }

        .article .article-content h1,
        .article .article-content h2,
        .article .article-content h3,
        .article .article-content h4,
        .article .article-content h5{
            color: var(--text-main);
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .article-content p {
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: 500;
            line-height: 2.0rem;

        }

        .article-content ul li {
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: 500;
            line-height: 1.5rem;
        }

        .article .article-content blockquote {
            max-width: 600px;
            padding: 15px 0 30px 0;
            margin: 0;
        }

        .article .article-content blockquote p {
            font-size: 20px;
            font-weight: 500;
            color: #fc5356;
            margin: 0;
        }

        .article .article-content blockquote .blockquote-footer {
            color: #20247b;
            font-size: 16px;
        }

        .article .article-content blockquote .blockquote-footer cite {
            font-weight: 600;
        }

        .article .tag-cloud {
            padding-top: 10px;
        }

        .article-comment {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            padding: 20px;
        }

        .article-comment h4 {
            color: #20247b;
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 22px;
        }

        img {
            max-width: 100%;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        /* Contact Us
---------------------*/
        .contact-name {
            margin-bottom: 30px;
        }

        .contact-name h5 {
            font-size: 22px;
            color: #20247b;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .contact-name p {
            font-size: 18px;
            margin: 0;
        }

        .social-share a {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            color: #ffffff;
            text-align: center;
            margin-right: 10px;
        }

        .social-share .dribbble {
            box-shadow: 0 8px 30px -4px rgba(234, 76, 137, 0.5);
            background-color: #ea4c89;
        }

        .social-share .behance {
            box-shadow: 0 8px 30px -4px rgba(0, 103, 255, 0.5);
            background-color: #0067ff;
        }

        .social-share .linkedin {
            box-shadow: 0 8px 30px -4px rgba(1, 119, 172, 0.5);
            background-color: #0177ac;
        }

        .contact-form .form-control {
            border: none;
            border-bottom: 1px solid #20247b;
            background: transparent;
            border-radius: 0;
            padding-left: 0;
            box-shadow: none !important;
        }

        .contact-form .form-control:focus {
            border-bottom: 1px solid #fc5356;
        }

        .contact-form .form-control.invalid {
            border-bottom: 1px solid #ff0000;
        }

        .contact-form .send {
            margin-top: 20px;
        }

        @media (max-width: 767px) {
            .contact-form .send {
                margin-bottom: 20px;
            }
        }

        .section-title h2 {
            font-weight: 700;
            color: #20247b;
            font-size: 45px;
            margin: 0 0 15px;
            border-left: 5px solid #fc5356;
            padding-left: 15px;
        }

        .section-title {
            padding-bottom: 45px;
        }

        .contact-form .send {
            margin-top: 20px;
        }

        .px-btn {
            padding: 0 50px 0 20px;
            line-height: 60px;
            position: relative;
            display: inline-block;
            color: #20247b;
            background: none;
            border: none;
        }

        .px-btn:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            border-radius: 30px;
            background: transparent;
            border: 1px solid rgba(252, 83, 86, 0.6);
            border-right: 1px solid transparent;
            -moz-transition: ease all 0.35s;
            -o-transition: ease all 0.35s;
            -webkit-transition: ease all 0.35s;
            transition: ease all 0.35s;
            width: 60px;
            height: 60px;
        }

        .px-btn .arrow {
            width: 13px;
            height: 2px;
            background: currentColor;
            display: inline-block;
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            right: 25px;
        }

        .px-btn .arrow:after {
            width: 8px;
            height: 8px;
            border-right: 2px solid currentColor;
            border-top: 2px solid currentColor;
            content: "";
            position: absolute;
            top: -3px;
            right: 0;
            display: inline-block;
            -moz-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    @endpush
    @push('scripts')
    @include('templates.vietstar.includes.immediate_available_btn')
    <script>
    </script>
    @endpush