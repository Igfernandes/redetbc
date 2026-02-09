<style>
    .nav-list {
        justify-content: center;
    }

    .nav-list li a {
        color: #003583;
        border-color: #1a2b47;
        padding: 7px 25px;
        border-radius: 3px 3px 0 0;
        font-size: 14px;
        margin-right: 1px;
        text-decoration: none;
        display: block;
    }

    @media (max-width: 766px) {
        .nav-list li a {
            padding: 7px 20px;
        }
    }

    @media (max-width: 460px) {
        .nav-list li a {
            padding: 7px 0px;
        }
    }

    .nav-list li a .nav-icon {
        height: 60px;
        width: 60px;
        border: 7px solid #fff;
        box-shadow: 1px 1px 5px black;
        border-radius: 100%;
        background: #003583;
        margin: 0 auto;
        color: #fff;
    }

    @media (max-width: 460px) {
        .nav-list li a .nav-icon {
            height: 45px;
            width: 45px;
            border: 4px solid #fff;
        }
    }
</style>
<div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2" 
style="background-image: url('{{$bg_image_url}}') !important;">
    <div class="container space-2 space-top-xl-4">
        <div class="row justify-content-center py-5 pb-xl-8">
            <div class="py-8 py-xl-10 pb-5">
                <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold">{{$title ?? ''}}</h1>
                <p class="font-size-20 font-weight-normal text-white">{{$sub_title ?? ''}}</p>
            </div>
        </div>
        <div class=" mb-lg-n1">
            <ul class="nav nav-list flex-nowrap tab-nav-shadow  @if(!empty($single_form_search)) d-none @endif" role="tablist">
                <li class="nav-item" role="bravo_hotel">
                    <a class="font-weight-medium"
                        id="bravo_hotel-tab"
                        href="/page/hotel">
                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;" src="{{asset('images/icons/features/hotels-icon.png')}}" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{__('Hotéis')}}
                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_space">
                    <a class="font-weight-medium"
                        id="bravo_space-tab"
                        href="/page/space">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="{{asset('images/icons/features/spaces-icon.png')}}" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{__('Espaços')}}
                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_tour">
                    <a class="font-weight-medium"
                        id="bravo_tour-tab"
                        href="/page/tour">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="{{asset('images/icons/features/tours-icon.png')}}" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{__('Passeios')}}
                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_assistances">
                    <a class="font-weight-medium"
                        id="bravo_assistances-tab"
                        href="/page/service">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="{{asset('images/icons/features/services-icon.png')}}" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{__('Serviços')}}
                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_blog">
                    <a class="font-weight-medium"
                        id="bravo_blog-tab"
                        href="/page/blog">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="{{asset('images/icons/features/blogs-icon.png')}}" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                {{__('Blogs')}}
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>