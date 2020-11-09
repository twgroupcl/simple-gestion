@extends(backpack_view('blank'))

    <div class="container">
        <div class="row mt-5">
            <div class="col-12  text-center">

                <div class="display-4 text-center ">Ocurrio un error </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                {{-- <img src="{{ asset('images/site/loading.gif') }}"
                    class="img-fluid w-50 mx-auto"> --}}
                <!-- Primary spinner -->
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>


    </div>



