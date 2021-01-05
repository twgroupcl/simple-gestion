<div class="btn-group">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Mas opciones
    </button>
    <div class="dropdown-menu">
        @if ($crud->hasAccess('generate_dte') && !($entry->quotation_status === 'EMITIDO' || $entry->quotation_status === 'FACTURADO'))
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/to-invoice') }} " target="_blank" class="dropdown-item">Generar DTE</a>
        @endif
        
        @if ($crud->hasAccess('duplicate'))
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/duplicate') }} " target="_blank" class="dropdown-item">Duplicar</a>
        @endif
    </div>
  </div>