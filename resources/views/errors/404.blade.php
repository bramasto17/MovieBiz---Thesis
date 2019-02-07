@extends('Layout.master')
@section('Title')
    Page Not Found
@endsection
@section('Content')
    <section class="gallery-area section-padding list" id="gallery_page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="text-center">
                        <h3 class="blue-color">Page Not Found</h3>
                        <p>Sorry, the page you're looking for is not found (404)</p>
                    </div>
                </div>
                <div class="space-40"></div>

            </div>
        </div>
    </section>

    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title text-center">
                        <h5 class="title">What's next?</h5>
                        <h5 class="dark-color">1. Double-check that the URL you entered is correct.</h5>
                        <h5 class="dark-color">2. You can go back to <a href="home" style="color: red;">home</a>. </h5>
                        <h5 class="dark-color">3. It will better to navigate using our link instead of typing directly.</h5>
                        <div class="space-40"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection