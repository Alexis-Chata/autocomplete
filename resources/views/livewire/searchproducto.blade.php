<div>
    <div x-data="{
        selectedIndex_producto: 0,
        query_producto: @entangle('query_producto'),
        dataresults_producto: @entangle('dataresults_producto'),
        selectedItem_producto: null,
        selectCurrent_producto(i = null) {
            if (i !== null) {
                this.selectedIndex_producto = i;
            }
            var item = null
            if (this.query_producto) {
                var item = this.dataresults_producto[this.selectedIndex_producto];
            }
            if (item) {
                this.query_producto = item.name;
                this.selectedItem_producto = item; // Guardar el elemento seleccionado
                this.dataresults_producto = [];
                this.selectedIndex_producto = 0;
                $wire.selectItem_producto(this.selectedItem_producto.id);
            }
        }
    }" class="relative col">
        <input type="text" x-model="query_producto" @input="$wire.set('query_producto', query_producto)"
            @keydown.arrow-up.prevent="selectedIndex_producto = Math.max(selectedIndex_producto - 1, 0)"
            @keydown.arrow-down.prevent="selectedIndex_producto = Math.min(selectedIndex_producto + 1, dataresults_producto.length - 1)"
            @keydown.enter.prevent="selectCurrent_producto()" placeholder="Buscar Productos..." class="form-control">

        <!-- Mostrar la lista solo si hay resultados y el query_producto no está vacío -->
        <ul class="list-group mt-2 position-absolute w-100 bg-white" x-show="dataresults_producto.length > 0 && query_producto.length > 0"
            style="z-index: 1000;">
            <template x-for="(result, i) in dataresults_producto" :key="i">
                <li :class="{ 'active': selectedIndex_producto === i }" class="list-group-item text-sm px-2 py-1"
                    @click="selectCurrent_producto(i); $wire.selectItem_producto(result.id);" @mouseover="selectedIndex_producto = i"
                    x-text="result.name">
                </li>
            </template>
        </ul>

        <!-- Mostrar los detalles del elemento seleccionado -->
        <div class="mt-4" x-show="selectedItem_producto">
            <h4>Detalles del Producto seleccionado</h4>
            <p><strong>Nombre:</strong> <span x-text="selectedItem_producto ? selectedItem_producto.name : ''"></span></p>
            <p><strong>Descripción:</strong> <span x-text="selectedItem_producto ? selectedItem_producto.id : ''"></span></p>
            <p><strong>Precio:</strong> <span x-text="selectedItem_producto ? selectedItem_producto.costo : ''"></span></p>
        </div>
    </div>
</div>
