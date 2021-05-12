<div>
    <p><strong>Para: </strong>{{ $seller->visible_name }}</p>
    <div>
        <textarea wire:model="order.arrange_messages.{{$seller->id}}"></textarea>
    </div>
    <a wire:click.prevent="send()" class="btn btn-primary mt-3" href="#">&nbsp; Enviar</a>
</div>
