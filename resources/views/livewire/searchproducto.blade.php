<div>
    <div x-data="{
        selectedIndex: 0,
        query: @entangle('query'),
        dataresults: @entangle('dataresults'),
        selectedItem: null,
        selectCurrent(i = null) {
            if (i !== null) {
                this.selectedIndex = i;
            }
            var item = null
            if (this.query) {
                var item = this.dataresults[this.selectedIndex];
            }
            if (item) {
                this.query = item.name;
                this.selectedItem = item; // Guardar el elemento seleccionado
                this.dataresults = [];
                this.selectedIndex = 0;
                $wire.selectItem(this.selectedItem.id);
            }
        }
    }" class="relative col">
        <input type="text" x-model="query" @input="$wire.set('query', query)"
            @keydown.arrow-up.prevent="selectedIndex = Math.max(selectedIndex - 1, 0)"
            @keydown.arrow-down.prevent="selectedIndex = Math.min(selectedIndex + 1, dataresults.length - 1)"
            @keydown.enter.prevent="selectCurrent()" placeholder="Buscar Productos..." class="form-control">

        <!-- Mostrar la lista solo si hay resultados y el query no está vacío -->
        <ul class="list-group mt-2 position-absolute w-100 bg-white" x-show="dataresults.length > 0 && query.length > 0"
            style="z-index: 1000;">
            <template x-for="(result, i) in dataresults" :key="i">
                <li :class="{ 'active': selectedIndex === i }" class="list-group-item text-sm px-2 py-1"
                    @click="selectCurrent(i); $wire.selectItem(result.id);" @mouseover="selectedIndex = i"
                    x-text="result.name">
                </li>
            </template>
        </ul>

        <!-- Mostrar los detalles del elemento seleccionado -->
        <div class="mt-4" x-show="selectedItem">
            <h4>Detalles del Producto seleccionado</h4>
            <p><strong>Nombre:</strong> <span x-text="selectedItem ? selectedItem.name : ''"></span></p>
            <p><strong>Descripción:</strong> <span x-text="selectedItem ? selectedItem.id : ''"></span></p>
            <p><strong>Precio:</strong> <span x-text="selectedItem ? selectedItem.costo : ''"></span></p>
        </div>
    </div>
</div>
