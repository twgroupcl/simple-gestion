@php
    if ($quotation->recurring_data['end_type'] === 'date') {
        $date = new Carbon\Carbon($quotation->recurring_data['end_date']);
    }
@endphp

@extends('layouts.gym.base')

@section('title')
    Terminar cotizacion recurrente
@endsection

@section('header-title')
Terminar Suscripción
@endsection

@section('content')
<div class="row px-0 mx-0 content">
    <div class="col-lg-8 col-md-12 inner-content">
        <div class="row mt-4 justify-content-center">
            @if($quotation->quotation_status === App\Models\Quotation::STATUS_ACCEPTED)
            <div class="col-md-10">
                <div class="row">
                    <div class="col">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Cliente</b>: {{ $quotation->customer->first_name }} {{ $quotation->customer->last_name }}</li>
                            @if ($quotation->recurring_data['end_type'] === 'date')
                            <li class="list-group-item"><b>Fecha de finalizacion</b>: {{ $date->format('d-m-Y') }}</li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- <div class="row  mt-4">
                    <div class="col">
                        <h4>Informacion de item</h4>
                    </div>
                </div> --}}

                <div class="row mt-4">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto / Servicio</th>
                                    <th>Cant.</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotation->quotation_items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ currencyFormat($item->price ?? 0, 'CLP', true) }}</td>
                                        <td>{{ currencyFormat($item->sub_total ?? 0, 'CLP', true) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <table class="table">
                            <tr>
                                <td colspan="3" class="table-foother-title"><strong>Subtotal</strong></td>
                                <td>{{ currencyFormat($quotation->sub_total ?? 0, 'CLP', true) }}</td>
                            </tr>
                            @if ($quotation->tax_amount)
                            <tr>
                                <td colspan="3" class="table-foother-title"><strong>IVA</strong></td>
                                <td>{{ currencyFormat($quotation->tax_amount ?? 0, 'CLP', true) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="table-foother-title"><strong>Total</strong></td>
                                <td>{{ currencyFormat($quotation->total ?? 0, 'CLP', true) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center mt-3 mb-3">
                    <div class="col-md-6">
                        <form 
                            action="{{ route('quotation.recurring.terminate.post', ['quotation' => $quotation, 'company' => $company ]) }}" 
                            method="POST"
                            id="form"
                        >
                            @csrf
                            <button class="btn btn-danger btn-block" type="submit" id="enviar-form">Terminar suscripción ahora</button>
                        </form>
                    </div>
                </div>
            </div>
            
            @else
            <div class="col-md-10">
                <div class="alert alert-primary">
                    No es posible terminar esta subscripcion.
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    let botonEnviar = document.querySelector('#enviar-form');

    botonEnviar.addEventListener('click', function (event) {
        event.preventDefault();

        let form = document.querySelector('#form')

        // Confirmation alert
        Swal.fire({
            title: 'Terminar subscripción',
            text: '¿Estas seguro que deseas terminar tu subscripción?',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'Terminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#f9464e',
            cancelButtonColor: 'gray',
        }).then( value => {
            if (value.isConfirmed) {
                form.submit()
            }
        })
    })
</script>
@endpush