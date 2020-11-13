@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Content-->
<!-- Hero section with search-->
<section class="bg-dark bg-size-cover bg-cp-gradient bg-position-center-x position-relative py-5 mb-5"><span class="bg-overlay bg-darker" style="opacity: .0;"></span>
    <div class="bg-overlay-content container py-4 my-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-light text-center">¿Cómo te podemos ayudar?</h1>
            </div>
        </div>
    </div>
</section>
<!-- Topics grid-->
<!--
    <section class="container py-3">
        <h2 class="h3 text-center">Selecciona un tema</h2>
        <div class="row pt-4 m-auto">
            @foreach($faqTopic as $topic)
                <div class="col-lg-4 col-sm-6 mb-grid-gutter">
                    <a class="card border-0 box-shadow" href="#">
                        <div class="card-body text-center">{!!$topic->icon!!}</i>
                            <h6>{{$topic->title}}</h6>
                            <p class="font-size-sm text-muted pb-2">{{$topic->description}}</p>
                            <div class="btn btn-outline-primary btn-sm mb-2">Aprende más</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
-->
<!-- FAQ-->
<section class="container pt-4 pb-5">
    <h2 class="h3 text-center">Preguntas Frecuentes</h2>
    <div class="row pt-4">
        <div class="col-md-12">
            @foreach($faqs as $faq)
                <div class="accordion" id="methods">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="accordion-heading"><a href="#method{{$faq->id}}" class="text-capitalize collapsed" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="methodOne">{{$faq->question}}<span class="accordion-indicator"></span></a></h3>
                        </div>
                        <div class="collapse" id="method{{$faq->id}}" data-parent="#methods">
                            <div class="card-body font-size-md">
                                <p>{{$faq->answer}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--
            <div class="col-sm-6">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">How long will delivery take?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">What payment methods do you accept?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">Do you ship internationally?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">Do I need an account to place an order?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">How can I track my order?</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">What are the product refund conditions?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">Do you have discounts for returning customers?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">How do your referral program work?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">Where I can view and download invoices for my orders?</a></li>
                    <li class="d-flex align-items-center border-bottom pb-3 mb-3"><i class="czi-book text-muted mr-2"></i><a class="nav-link-style" href="#">Do you provide technical support after the purchase?</a></li>
                </ul>
            </div>
        -->
    </div>
</section>
<!-- Submit request-->
<!--
    <section class="container text-center pt-1 pb-5 mb-2">
        <h2 class="h4 pb-3">Haven't found the answer? We can help.</h2><i class="czi-help h3 text-primary d-block mb-4"></i><a class="btn btn-primary" href="help-submit-request.html">Submit a request</a>
        <p class="font-size-sm pt-4">Contact us and we’ll get back to you as soon as possible.</p>
    </section>
-->
@endsection
