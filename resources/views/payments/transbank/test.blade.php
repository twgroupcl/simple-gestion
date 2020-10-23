@extends('layouts.base')
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="h3 text-center">Test Transbank Services</div>
                    </div>
                    <div class="card-body">
                            <div class="row ">
                                <div class="col-10 border border-primary rounded mx-auto -3 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="display-4">Webpay Plus</div>
                                        </div>
                                    </div>
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputOrden">Orden</label>
                                            <input type="number" class="form-control" id="inputOrden" aria-describedby="ordenHelp" placeholder="1">
                                            <small id="ordenHelp" class="form-text text-muted">Ingrese un número de orden.</small>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputImporte">Importe</label>
                                            <input type="number" class="form-control" id="inputImporte" aria-describedby="ordenHelp" placeholder="0">
                                            <small id="importeHelp" class="form-text text-muted">Ingrese un importe.</small>

                                          </div>
                                          <div class="form-group">
                                            <button type="submit" class="btn btn-primary ">Enviar</button>
                                          </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 border border-success rounded mx-auto -3 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="display-4">Webpay Plus Mall</div>
                                        </div>
                                    </div>
                                    <form action="{{route('transbank.webpayplus.mall.redirect')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputOrder">Orden</label>
                                            <input type="number" class="form-control"  name="order" id="inputOrder" aria-describedby="orderHelp" placeholder="0">
                                            <small id="orderHelp" class="form-text text-muted">Ingrese un número de orden.</small>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputAmount">Amount</label>
                                            <input type="number" class="form-control" name="amount" id="inputAmount" aria-describedby="amountHelp" placeholder="0">
                                            <small id="amountHelp" class="form-text text-muted">Ingrese un importe.</small>

                                          </div>
                                          <div class="form-group">
                                            <button type="submit" class="btn btn-primary ">Enviar</button>
                                          </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 border border-info rounded mx-auto -3 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="display-4">OneClick</div>
                                        </div>
                                    </div>
                                    <form action="">
                                        <div class="form-group">
                                            <label for="inputOrden">Orden</label>
                                            <input type="number" class="form-control" id="inputOrden" aria-describedby="ordenHelp" placeholder="1">
                                            <small id="ordenHelp" class="form-text text-muted">Ingrese un número de orden.</small>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputImporte">Importe</label>
                                            <input type="number" class="form-control" id="inputImporte" aria-describedby="ordenHelp" placeholder="0">
                                            <small id="importeHelp" class="form-text text-muted">Ingrese un importe.</small>

                                          </div>
                                          <div class="form-group">
                                            <button type="submit" class="btn btn-primary ">Enviar</button>
                                          </div>
                                    </form>
                                </div>
                            </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
