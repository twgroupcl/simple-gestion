{{-- <div wire:loading wire:target="products" class="loading"></div> --}}
<div class="container">
    <div class="row mt-2 mb-2">


    
            <div class="col-2 text-center " id="menu-mobile">
                <i class="las la-bars menu-mobile" style="font-size: 32px;"></i>
            </div>
            <div class="col-md-12 col-8 p-0 text-center">
                <form class="form-inline search-products">
                    <input id="search" class="form-control w-100 input-search" type="search" placeholder="Buscar producto"
                        aria-label="Search"  wire:model="searchProduct">
               </form>
            </div>
            <div class="col-2 p-0 " id="cart-mobile">
                <span class="las la-shopping-cart " style="font-size:32px;">
    
                <span
                    class="custom-badge badge-cart-view  "  @if( !empty($cartproducts)) id="mobile-cart-view" @endif> {{ empty($cartproducts)?0:count($cartproducts) }}</span>
                </span>
            </div>
    
    </div>
    @if(!$productNotFound)
    <div class="row">
        @foreach ($products as $product)
            @livewire('pos.product', ['product' => $product], key($product->id))
        @endforeach
    </div>
    @else
    <div class="row">
        <div class="col-12 text-center">
            <div class="custom-text-info mt-5">
                No se encontro el producto ingresado
            </div>
        </div>

        <div class="col-12 text-center">
            <button type="button" class="btn btn-primary" wire:click="showAddProductModal">Agregar producto</button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        </div>
    </div>
    @endif

    <!-- Add To cart -->
    <!-- Modal -->
    <div class="modal fade" id="showAddFastProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Agregar el producto al carro?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnAddFastConfirm" wire:click="addToCart">Agregar</button>
        </div>
      </div>
    </div>
    <!-- Order Details Modal-->
    <div
        class="modal fade"
        id="productAttributesModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="productAttributesModalLabel"
        aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <livewire:pos.product-custom-attributes>
            </div>
        </div>
</div>
@push('after_scripts')
    <script>
        /* window.addEventListener('showAddFastProduct', event => {
            $('#showAddFastProduct').appendTo("body").modal('show');
            // let value = @this.address['commune_id']
            // $('#product-attributes-modal').find(`option[value="${value}"]`).prop('selected', 'selected').change();

        })
        */
        window.addEventListener('showAddFastProduct', event => {
            $('#addProduct').appendTo("body").modal('show');
            // let value = @this.address['commune_id']
            // $('#product-attributes-modal').find(`option[value="${value}"]`).prop('selected', 'selected').change();

        })


        // window.addEventListener('close-modal-form', event => {
        //     $('#productAttributesModal').appendTo("body").modal('hide');
        // })

        // window.addEventListener('openSaleBoxModal', event => {
        // $('#showSaleBoxModal').appendTo("body").modal('show');
        //})
    </script>
@endpush
