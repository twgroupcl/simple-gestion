<div class="content">
    <div class="row">
        <div class="col-1">
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Punto de Venta </div>

                <ul class="pos-list-group list-group-flush">
                    <li class="pos-list-group-item text-center my-auto">
                        <a href="#" onclick="changeViewMode('productList')""
                            class="list-group-item-action ">
                            <i class="las la-calculator" style="font-size: 32px;"></i>
                            <br>
                            POS
                        </a>
                    </li>
                    <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                            <i class="las la-file-invoice-dollar" style="font-size: 32px;"></i>
                            <br>
                            Sales</a></li>
                    <li class="pos-list-group-item text-center"><a href="#"
                            onclick="changeViewMode('selectCustomer')" class="list-group-item-action ">
                            <i class="las la-user" style="font-size: 32px;"></i>
                            Customer</a></li>

                    <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                            <i class="las la-cash-register" style="font-size: 32px;"></i>
                            <br>
                            Cashier</a></li>
                    <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                        <i class="las la-boxes" style="font-size: 32px;"></i>
                            <br>
                            Products</a></li>
                    <li class="pos-list-group-item text-center  my-auto"><a href="#" class="list-group-item-action ">
                        <i class="las la-cog" style="font-size: 32px;"></i>
                            <br>
                            Setting</a></li>
                </ul>



            </div>
        </div>
        <div class="col-8">
            <div class="position-relative overflow-auto vh-100">
                <div id="productList">@livewire('pos.list-products', ['seller' => $seller, 'view' => $viewMode])</div>
                <div id="selectCustomer" style="display: none;">@livewire('pos.customer.customer-view')</div>
                <div id="paymentView" style="display: none;">@livewire('pos.payment.payment-view', ['seller' => $seller, 'view' => $viewMode])</div>
            </div>
        </div>
        <div class="col-3">
            <div class="position-relative overflow-hidden vh-100">
            @livewire('pos.cart.cart')</div>
            </div>
    </div>
</div>

@push('after_scripts')
<script>
    var currentView = 'productList';
    const changeViewMode = view => {
        $('#'+currentView).hide();
        $('#'+view).show();
        currentView = view;
    }
</script>
@endpush
