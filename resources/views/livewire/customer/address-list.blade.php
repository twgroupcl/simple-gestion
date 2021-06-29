<div class="table-responsive font-size-md">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>Calle</th>
                <th>Número</th>
                <th>Referencia</th>
                <th>Comuna</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $addresses_data = is_array($customer->addresses_data)
                    ? $customer->addresses_data
                    : json_decode($customer->addresses_data, true) ?? [];

                $paginator = paginate($addresses_data, 10, null, [
                    'path'  => request()->url(),
                    'query' => request()->query(),
                ]);
                @endphp
            @forelse ($paginator as $address)
                <livewire:customer.address-item :communes="$communes" :address="$address" :key="$loop->index">
            @empty
            <tr>
                <td class="py-3 align-middle">No se encontraron direcciones</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <hr class="pb-4">
    <!-- Pagination-->
    {{ $paginator->links() }}
</div>