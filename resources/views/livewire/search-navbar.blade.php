<div class="input-group-overlay d-none d-lg-block mx-4">
    <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
    <input class="form-control prepended-form-control appended-form-control" type="text" placeholder="Buscar productos">
    <div class="input-group-append-overlay">
        <select class="custom-select">
            @foreach ($categories as $category)
            <option>{{ $category->name }}</option>   
            @endforeach
        </select>
    </div>
</div>
