
<style>
.card-body .tab-pane ul li a{
 color: rgb(0, 4, 255);
 text-decoration: none;
}
.card-body .tab-pane ul li a:hover{
 color: red;
}
</style>

<div class="col-lg-4 ps-3">
    <div class="card mb-4 border-0">
        <div class="card-header border-0" style="padding:0px;">
            <ul class="m-0 nav nav-fill nav-justified nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation"> <button class="active nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Recent Post</button></li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Most View Post</button></li>
            </ul>
        </div>
        <div class="card-body tab-content border border-gray-100 border-top-0 py-1">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <ul class="g-0">
                @foreach ($recentPost as $post)
                    <li><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}"><i class="fa-solid fa-caret-right"></i> {{ $post->title }}</a> {{ Carbon\Carbon::parse($post->created_at)->subMinutes()->locale('en_BD')->diffForHumans()}}</li>
                @endforeach
                </ul>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <ul class="g-0">
                @foreach ($mostView as $post)
                    <li><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}"><i class="fa-solid fa-caret-right"></i> {{ $post->title }} </a>({{ $post->views }})</li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header text-center" style="font-size:20px; font-weight:600;">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 side-widget-cat">
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories as $category)
                        <?php $dash=''; ?>
                        @if ($category->posts->count() > 0)
                        <li><i class="fa-solid fa-angles-right"></i> <a href="{{ route('post-category', $category->slug) }}">{{ $category->name }} ({{ $category->posts->count() }})</a></li>
                        @endif
                        @if(count($category->subcategory))
                        @include('livewire.frontend.common.sub-category-list', ['subcategories' => $category->subcategory])
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @if ($rightWidgets->count() > 0)
        @foreach ($rightWidgets as $rightwidget)
        <div class="card mb-4 text-center">
                <div class="card-header" style="font-size:20px; font-weight:600;">{{ $rightwidget->title }}</div>
                <div class="card-body"> {!! eval('?>'.Blade::compileString($rightwidget->body)) !!} </div>
        </div>
        @endforeach
    @endif


</div>
