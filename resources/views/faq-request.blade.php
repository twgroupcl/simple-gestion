@extends('layouts.base')

@section('content')
<!-- Page title-->
<!-- Page Title (Light)-->
<div class="page-title-overlap bg-dark py-4 bg-cp-gradient">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        {{-- <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap"><a href="help-topics.html">Help center</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">Submit request</li>
                </ol>
            </nav>
        </div> --}}
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-light mb-2">Submit a request</h1>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container py-5 mt-md-2 mb-md-4">
    <div class="row">
        <div class="col-lg-3">
            <!-- Related articles sidebar-->
            <div class="cz-sidebar border-right" id="help-sidebar">
                <div class="cz-sidebar-header box-shadow-sm">
                    <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
                </div>
                <div class="cz-sidebar-body py-lg-1 pl-lg-0" data-simplebar data-simplebar-auto-hide="true">
                    <!-- Links-->
                    <div class="widget widget-links">
                        <h3 class="widget-title">Related articles</h3>
                        <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Managing account</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Working with dashboard</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Available payment methods</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Delivery information</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Order tracking instructions</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Refund policy</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Offers and discounts</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Reward points</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Affiliate program</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>After purchase support</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Service terms &amp; conditions</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Most popular questions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon czi-announcement"></i></div>Our friendly Support team is always here to help you. Begin by selecting a topic we can help you with.
            </div>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-topic">Select a topic <strong class='text-danger'>*</strong></label>
                            <select class="form-control custom-select" required id="help-topic">
                                <option value>—</option>
                                <option value="Managing Account">Managing Account</option>
                                <option value="Working with Dashboard">Working with Dashboard</option>
                                <option value="Payment Methods">Payment Methods</option>
                                <option value="Delivery Information">Delivery Information</option>
                                <option value="Refund Policy">Refund Policy</option>
                                <option value="Affiliate Program">Affiliate Program</option>
                            </select>
                            <div class="invalid-feedback">Please choose a topic!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-subject">Request Subject </label>
                            <input class="form-control" type="text" id="help-subject">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="help-message">Request Message <strong class='text-danger'>*</strong></label>
                    <textarea class="form-control" rows="6" required id="help-message"></textarea>
                    <div class="invalid-feedback">Please provide a detailed description of your problem!</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-name">Your Name <strong class='text-danger'>*</strong></label>
                            <input class="form-control" type="text" required id="help-name">
                            <div class="invalid-feedback">Please enter your name!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-email">Your Email <strong class='text-danger'>*</strong></label>
                            <input class="form-control" type="email" required id="help-email">
                            <div class="invalid-feedback">Please enter valid email address!</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-url">Include a relevant URL</label>
                            <input class="form-control" type="text" id="help-url">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="help-file">Attachments</label>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="help-file">
                                <label class="custom-file-label" for="help-file">Choose file...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mr-4" type="submit">Submit a request</button><a class="nav-link-style d-inline-block align-middle font-size-sm py-2" href="#">Privacy policy</a>
            </form>
        </div>
    </div>
</div>
@endsection
