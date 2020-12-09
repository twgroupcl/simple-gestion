<div class='container text-center'>
    <div class="row">
        <div class='card text-left col-md-6'>
            @if (session()->get('user.pos.selectedCustomer'))
            @php
                $selectedCustomer = \App\Models\Customer::find(session()->get('user.pos.selectedCustomer'));
            @endphp
                <div class="row">
                    <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">$selectedCustomer->first_name</h5>
                        <p class="card-text">$selectedCustomer->email</p>
                        <p class="card-text">$selectedCustomer->uid</p>
                        </div>
                        <a href="#" class="btn btn-outline-primary mb-3">Pago en efectivo</a>
                        <a href="#" class="btn btn-outline-primary mb-3">Pago con transbank</a>
                    </div>
                    </div>
                </div>
            @endif
        </div>
        <div class='card col-md-6'>
            <div class='card-body'>
                <input class='input' id='display' disabled>
            </div>
            <div class='card-body'>
                <table class='table table-sm table-borderless'>
                    <tbody>
                        <tr>
                            <td><button class='btn btn-lg' onclick='chr("7")'>7</button></td>
                            <td><button class='btn btn-lg' onclick='chr("8")'>8</button></td>
                            <td><button class='btn btn-lg' onclick='chr("9")'>9</button></td>
                        </tr>
                        <tr>
                            <td><button class='btn btn-lg' onclick='chr("4")'>4</button></td>
                            <td><button class='btn btn-lg' onclick='chr("5")'>5</button></td>
                            <td><button class='btn btn-lg' onclick='chr("6")'>6</button></td>
                        </tr>
                        <tr>
                            <td><button class='btn btn-lg' onclick='chr("1")'>1</button></td>
                            <td><button class='btn btn-lg' onclick='chr("2")'>2</button></td>
                            <td><button class='btn btn-lg' onclick='chr("3")'>3</button></td>
                        </tr><tr>
                            <td><button class='btn btn-lg' onclick='chr(".")'>.</button></td>
                            <td><button class='btn btn-lg' onclick='chr("0")'>0</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
