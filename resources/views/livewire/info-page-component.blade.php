<div>
    @if($info_page_template->component_name == 'one-column-info-page')
        <main class="main">
            <section class="home-slider position-relative pt-50">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-12 col-md-12">
                            <img class="animated" src="{{ asset('assets/imgs/info-pages') }}/{{$info_page->image}}" alt="">
                            <div class="hero-slider-content-2 home-main-text-container">
                                <h1 class="animated fw-900 text-brand">{{ $info_page->values['title'] }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-20">
                            <h4 class="fw-600 mb-20">{{ $info_page->values['column_title'] }}</h4>
                            <p class="wow fadeIn animated" style="white-space: pre-wrap;">{{ $info_page->values['column'] }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @elseif($info_page_template->component_name == 'two-column-info-page')
        <main class="main">
            <section class="home-slider position-relative pt-50">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-12 col-md-12">
                            <img class="animated" src="{{ asset('assets/imgs/info-pages') }}/{{$info_page->image}}" alt="">
                            <div class="hero-slider-content-2 home-main-text-container">
                                <h1 class="animated fw-900 text-brand">{{ $info_page->values['title'] }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-20">
                            <h4 class="fw-600 mb-20">{{ $info_page->values['column1_title'] }}</h4>
                            <p class="wow fadeIn animated" style="white-space: pre-wrap;">{{ $info_page->values['column1'] }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-20">
                            <h4 class="fw-600 mb-20">{{ $info_page->values['column2_title'] }}</h4>
                            <p class="wow fadeIn animated" style="white-space: pre-wrap;">{{ $info_page->values['column2'] }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endif
</div>
