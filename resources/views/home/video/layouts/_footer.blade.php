<!-- footer -->
<div class="footer">
    <div class="agileinfo_footer_bottom1">
        <div class="container">
            <div class="agileinfo_footer_bot_left">
                <ul>
                    <li><a href="index.html">今日看点</a><span> |</span></li>
                    <li>Power by <span>Garsen</span></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //footer -->

<div class="float-ads">
    @foreach($_ads['right'] as $item)
        <div class="show-hidden" data-target="kf">
            <a href="{{ $item['url'] }}" title="{{ $item['title'] }}" target="_blank">
                <img src="{{ get_admin_file_url($item['picture']) }}" class="icon-btn" alt="{{ $item['title'] }}">
            </a>
        </div>
    @endforeach
</div>

<div class="left-float-ads">
    @foreach($_ads['left'] as $item)
        <div class="show-hidden" data-target="kf">
            <a href="{{ $item['url'] }}" title="{{ $item['title'] }}" target="_blank">
                <img src="{{ get_admin_file_url($item['picture']) }}" class="icon-btn" alt="{{ $item['title'] }}">
            </a>
        </div>
    @endforeach
</div>