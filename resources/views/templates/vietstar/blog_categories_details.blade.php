@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('templates.vietstar.includes.inner_page_title', ['page_title'=>__('Blog')])
<!-- Inner Page Title end -->

<header id="joblisting-headerwrap" class="d-none d-sm-block">
    <div class="container-fluid">
        <section id="joblisting-header " role="search">
            <div class="container">
                <h2 class="mt-4 mb-4">{{$category->heading}}</h2>
            </div>
        </section>
    </div>
</header>
<section id="blog-content">
    <div class="container">

        <!-- Blog start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog List start -->
                <div class="blogwrapper">
                    <div class="blogList">
                        <div class="row">
                            @if(null!==($blogs))
                                <?php
                                $count = 1;
                                ?>
                                @foreach($blogs as $blog)
                                    <?php
                                    $cate_ids = explode(",", $blog->cate_id);
                                    $data = DB::table('blog_categories')->whereIn('id', $cate_ids)->get();
                                    $cate_array = array();
                                    foreach ($data as $cat) {
                                        $cate_array[] = "<a href='" . url('/blog/category/') . "/" . $cat->slug . "'>$cat->heading</a>";
                                    }
                                    ?>
                                    <div class="col-xl-3 col-lg-4 col-md-4 mb-3">
                                        <a class="bloginner" href="{{route('blog-detail',$blog->slug)}}">
                                            <div class="postimg">{{$blog->printBlogImage()}}</div>

                                            <div class="post-header li-text">
                                                <h4><span class="li-head" >{{$blog->heading}}</span> </h4>
                                              
                                            </div>

                                        </a>
                                    </div>
                                    <?php $count++; ?>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagiWrap">
                    <nav aria-label="Page navigation example">
                        @if(isset($blogs) && count($blogs))
                            {{ $blogs->appends(request()->query())->links() }} @endif
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 d-none">

                <div class="sidebar">
                    <!-- Search -->
                    <div class="widget">
                        <h5 class="widget-title">{{__('Search')}}</h5>
                        <div class="search">
                            <form action="{{route('blog-search')}}" method="GET">
                                <input type="text" class="form-control" placeholder="{{__('Search')}}"
                                       name="search">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5"></div>
    </div>
</section>
@include('templates.vietstar.includes.footer')
@endsection
@push('styles')
<style>
.plus-minus-input {
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.plus-minus-input .input-group-field {
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    padding: 0rem;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
}

.plus-minus-input .input-group-button .circle {
    border-radius: 50%;
    padding: 0.25em 0.8em;
}
</style>
@endpush
@push('scripts')
@include('templates.vietstar.includes.immediate_available_btn')
<script>
</script>
@endpush
