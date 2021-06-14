<div {{-- wire:init="updateSellersShippings()" --}}>
    <div class="loading" wire:loading>Loading&#8230;</div>
    <div class="accordion mb-2" id="seller" role="tablist">
        @if ($sellers)
            @foreach ($sellers as $seller)
                @php
                $shippings = null;

                if (!empty($sellersShippings)) {
                    $indexSeller = array_search($seller->id, array_column($sellersShippings,'sellerId'), true);
                    $shippings = $sellersShippings[$indexSeller];
                }

                @endphp
            @endforeach
        @endif
    </div>

    <h2 class="h6 pb-3 mb-2">Seleccionar tipo de despacho</h2>

    <div class="table-responsive">
        <table class="table table-hover fs-sm border-top">
          <thead>
            <tr>
              <th class="align-middle"></th>
              <th class="align-middle">Tipo de despacho</th>
            </tr>
          </thead>
          <tbody>
              @if (isset($sellersShippingMethods[$seller->id]))      
                      
              @foreach ($sellersShippingMethods[$seller->id] as $shippingMethod)       
                      
              <tr>
                <td>
                  <div class="form-check mb-4">
                    <input 
                        class="form-check-input" 
                        wire:model="selectedShippingMethodId" 
                        wire:click="setShippingMethod"
                        type="radio" id="{{ 'sh' . $loop->index }}" 
                        name="shipping_method" 
                        value="{{ $shippingMethod['id'] }}"
                    >
                    <label class="form-check-label" for="{{ 'sh' . $loop->index }}"></label>
                  </div>
                </td>
                <td class="align-middle"><span class="text-dark fw-medium">{{ $shippingMethod['title'] }}</span><br><span class="text-muted">All addresses (default zone), United States &amp; Canada</span></td>
              </tr>
                
              @endforeach
            
              @endif
          </tbody>
        </table>
    </div>

    @if ($shippings)
    <div class="d-fle flex-column h-100 rounded-3 bg-secondary px-3 px-sm-4 py-4">  
        @foreach ($shippings as $item)
            @if (!empty($item['shipping']))

            <div class="d-flex justify-content-between fs-md">
                
                {{-- Shipping Method Title --}}
                <div class="col-md-6">
                    <span>{{ $item['shipping']['title'] }}</span>
                </div>

                {{-- Shipping cost or error message --}}
                <div class="col-md-6">
                    @if ($item['shipping']['isAvailable'])
                        <span class="text-heading">
                            @if (!is_null($item['shipping']['totalPrice']))
                                {{ currencyFormat($item['shipping']['totalPrice'] ? $item['shipping']['totalPrice'] : 0, 'CLP', true) }}
                            @endif
                        </span>
                    @else
                        <span class="text-heading">{{ $item['shipping']['message'] }}</span>
                    @endif
                </div>
            </div>

            @else
                @if (!empty($item['notConfigured']))
                    <span class="text-heading">
                        Esta tienda no tiene configurado metodos de envío
                        para la comuna seleccionada. Selecciona otra comuna de destino para continuar
                        o elimina los articulos de esta tienda.
                    </span>
                @endif
            @endif
        @endforeach
    </div>
    @endif

    {{-- <div class="d-none d-lg-flex pt-4">
        <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" wire:click="prevStep()"><i
                    class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to
                    Adresses</span><span class="d-inline d-sm-none">Back</span></a></div>
        <div class="w-50 pl-2"><a class="btn btn-primary btn-block" wire:click="nextStep()"><span
                    class="d-none d-sm-inline">Proceed to Payment</span><span class="d-inline d-sm-none">Next</span><i
                    class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
    </div> --}}
</div>
