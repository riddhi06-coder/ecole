  @php
      $contact_us = \App\Models\ContactUs::whereNull('deleted_by')->first();
      $social_links = $contact_us && $contact_us->social_media_links ? json_decode($contact_us->social_media_links, true) : [];
  @endphp
  
  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <!-- Footer About / Logo -->
            <div class="col-lg-4 col-md-4 footer-about">
                <a href="{{ route('frontend.index') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('frontend/assets/img/emws-logo.png') }}" alt="EMWS Logo">
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ $contact_us->desc ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, officiis!' }}</p>
                </div>
                <div class="social-links d-flex">
                    @foreach($social_links as $link)
                        @php
                            $icon = '';
                            switch($link['platform']) {
                                case '1': $icon = 'fa-facebook-f'; break;
                                case '2': $icon = 'fa-twitter'; break;
                                case '3': $icon = 'fa-instagram'; break;
                                case '4': $icon = 'fa-linkedin-in'; break;
                                case '5': $icon = 'fa-youtube'; break;
                                case '6': $icon = 'fa-pinterest'; break;
                            }
                        @endphp
                        <a href="{{ $link['link'] }}" target="_blank"><i class="fa-brands {{ $icon }}"></i></a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 footer-links">
                        <h4>Quick Links</h4>
                    </div>
                    <div class="col-lg-4 col-md-4 footer-links">
                        <ul>
                            <li><a href="{{ route('frontend.what_sets_us_apart') }}">About</a></li>
                            <li><a href="{{ route('frontend.contact_us') }}">Contact Us</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-8 footer-links">
                        <ul>
                            <li><a href="{{ route('frontend.privacy_policy') }}">Privacy Policy</a></li>
                            <li><a href="https://sites.google.com/ecolemondiale.org/ecoleprimarylibrary" target="_blank">Primary Library</a></li>
                            <li><a href="https://ecole.managebac.com/login" target="_blank">ManageBac Login</a></li>
                            <li><a href="https://ecole-rsic.follettdestiny.com/common/welcome.jsp?context=saas38_8511046" target="_blank">Destiny Library Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-4 footer-newsletter">
                <h4>Contact Us</h4>
                <ul class="footer-contact">
                    @if($contact_us)
                        @if($contact_us->address)
                            <li class="address-foo-location">
                                <a href="{{ $contact_us->map_url }}" target="_blank">{{ $contact_us->address }}</a>
                            </li>
                        @endif
                        @if($contact_us->contact_number)
                            <li class="call-foo-phone">
                                <a href="tel:{{ $contact_us->contact_number }}">{{ $contact_us->contact_number }}</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© 2025 École Mondiale | Brought to Life by <a href="https://www.matrixbricks.com/">Matrix Bricks</a></p>
    </div>

  </footer>