        <footer>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 text-center footer-branding">
                            <a class="footer-logo" href="{{url('/')}}"><img src="{{url('/frontend/images/WebLogoFooter.png')}}"></a>
                            <p class="mt-3">CLICK | SHOP | DELIVER</p>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6 quick-links">
                            <h6>About</h6>
                            <ul>
                                <li><a href="{{url('/about-us')}}">JacknDeals</a></li>
                                <li><a href="{{url('/our-team')}}">Our Team</a></li>
                                <li><a href="{{url('/service-location')}}">Service Location</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6 quick-links">
                            <h6>Information</h6>
                            <ul>
                                <li><a href="{{url('/faq')}}">FAQ</a></li>
                                <li><a href="{{url('/return-refund')}}">Return & Refund Policy</a></li>
                                <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('/terms')}}">Terms & Conditions</a></li>
                                <li><a href="{{url('/disclaimer')}}">Disclaimer</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6 footer-social">
                            <h6>Follow us on</h6>
                            <ul class="social-links">
                                <li>
                                    <a href="https://www.facebook.com/jackndeals">
                                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                        <span>Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.twitter.com/jackndeals">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                        <span>Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/jackndeals">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                        <span>Instagram</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube/jackndeals">
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                        <span>YouTube</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-6 col-xs-6 col-6 customer-support">
                            <h6>Customer Support</h6>
                            <p>Call us at 9742559746</p>
                            <p>Customer Service Hours:</p>
                            <p>Sunday - Friday: 9 AM to 8 PM (Call) | 9 AM to 11 PM (Social Media)</p>
                            <p>{{--Saturday: 9 AM to 4 PM (Call Center) | --}}9 AM to 11 PM (Social Media)</p>
                            <p>You can also mail us at <a href="mailto:support@jackndeals.com">support@jackndeals.com</a></p>








                        </div>
                    </div>
                </div>

            </div>
            <div class="container-fluid footer-bottom">
                <p class="text-center mb-0">&copy {{Carbon\Carbon::now()->year}} <a href="{{url('/')}}">{{config('app.name')}} Pvt. Ltd.</a>. All Rights Reserved. Developed and Maintained By <a href="https://prabidhee.com"> Prabidhee Innovations Pvt. Ltd.</a> </p>
            </div>
        </footer>
        <script src="{{url('frontend/ecommerce.js')}}"></script>
    </body>
</html>
