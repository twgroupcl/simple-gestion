<tr>
    <td class="py-3 align-middle">{{ $address['street'] }}</td>
    <td class="py-3 align-middle">{{ $address['number']}}</td>
    <td class="py-3 align-middle">{{ $address['extra'] ?? '' }}</td>
    <td class="py-3 align-middle">{{ $communes[$address['commune_id']] }}</td>
    <td class="py-3 align-middle"><a class="nav-link-style mr-2" wire:click="updateAddress" href="#modal-form" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove"></a></td>
</tr>
