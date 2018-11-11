<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="single-footer-widget">
                    <h6>关于我们</h6>
                    <p>
                        东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司 东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司 东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司 东莞市瑞安信息科技有限公司
                        东莞市瑞安信息科技有限公司
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="single-footer-widget">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <h6>联系我们</h6>
                            </div>
                            <div class="col-sm-12 footer-social switch-wrap justify-content-between">
                                <p><a href="tencent://message/?uin={{ config('contact.qq', '') }}&Site=klinson.com&Menu=yes" style="color: #777777 !important;"><i class="fa fa-qq"></i>&nbsp;&nbsp;{{ config('contact.qq', '未设置') }}</a></p>
                                <p><a href="javascript:void(0)" style="color: #777777 !important;"><i class="fa fa-weixin"></i>&nbsp;&nbsp;{{ config('contact.weixin') }}</a></p>
                                <p><a href="mailto:{{ config('contact.email', '') }}" style="color: #777777 !important;"><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{ config('contact.email', '未设置') }}</a></p>
                                <p><a href="javascript:void(0)" style="color: #777777 !important;"><i class="fa fa-phone"></i>&nbsp;&nbsp;{{ config('contact.mobile', '未设置') }}</a></p>
                                <p><a href="javascript:void(0)" style="color: #777777 !important;"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;{{ config('contact.location', '未设置') }}</a></p>
                                <p><a href="{{ config('contact.site_link', 'javacript:void(0);') }}" style="color: #777777 !important;"><i class="fa fa-globe"></i>&nbsp;&nbsp;{{ config('contact.site_name') }}</a></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset(config('contact.weixin_qrcode')) }}" alt="" class="img-responsive" style="max-width: 105%;max-height: 200px;">
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="footer-text text-center">
                    Copyright &copy;2018 All rights reserved | by <a href="{{ config('contact.site_link', '') }}" target="_blank" title="{{ config('contact.owner', 'klinson') }}">{{ config('contact.owner', 'klinson') }}</a> | {{ config('contact.icp', '') }}
                </p>
            </div>

        </div>
    </div>
</footer>
<!-- End footer Area -->