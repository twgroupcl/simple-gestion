<div id="custom-vue-app">
    <v-app id="app">
        <v-main>
            <v-card class="mt-4 mx-6">
                <v-row class="mx-2">
                    <v-col>
                        <v-text-field 
                            label="Nombre"
                            v-model="priceList.name"
                        >
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row class="mx-2">
                    <v-col>
                        <v-text-field 
                            label="Codigo"
                            v-model="priceList.code"
                        >
                        </v-text-field>
                    </v-col>
                </v-row>

                 {{-- Botones acciones --}}
                <v-col>
                    <v-btn color="success" @click="saveChanges" class="mb-3">Guardar</v-btn>
                    {{-- <v-btn color="info" @click="dialogConfirm = true" class="mb-3">Aplicar precios</v-btn> --}}
                    <v-btn color="grey" class="mb-3 white--text" href="{{ backpack_url('pricelist') }}">Volver</v-btn>
                </v-col>

                <v-card-title>
                    Productos
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line hide-details>
                    </v-text-field>
                </v-card-title>

                {{-- Tabla --}}
                <v-data-table attach auto :headers="headers" :items="products" :search="search">
                    <template v-slot:item.cost="{ item }">
                        <div style="text-align: right">
                            @{{ item.cost | formatNumberFilter }}
                        </div>
                    </template>
                    <template v-slot:item.price="{ item }">
                        <div style="text-align: right">
                            @{{ item.price | formatNumberFilter }}
                        </div>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn color="primary" @click="openEditModal(item)" small>Editar</v-btn>
                    </template>
                </v-data-table>

                {{-- Botones acciones --}}
                <v-col>
                    <v-btn color="success" @click="saveChanges" class="mb-3">Guardar</v-btn>
                    {{-- <v-btn color="info"  @click="dialogConfirm = true" class="mb-3">Aplicar precios</v-btn> --}}
                    <v-btn color="grey" class="mb-3 white--text" href="{{ backpack_url('pricelist') }}">Volver</v-btn>
                </v-col>
            </v-card>

            {{-- Modal editar precio y cost --}}
            <v-dialog v-model="dialog" width="500">
                <v-card>
                    <v-card-title class="headline lighten-2">
                        Editar producto
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col>
                                <v-text-field
                                    label="Precio"
                                    hide-details="auto"
                                    v-model="selectedProduct.price"
                                    ref="modalFieldPrice"
                                    @focus="$event.target.select()"
                                    @keyup.enter="updateProduct"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field
                                    label="Costo"
                                    hide-details="auto"
                                    v-model="selectedProduct.cost"
                                    @keyup.enter="updateProduct"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        
                        <v-btn type="submit" color="primary" text @click="updateProduct">
                            Aceptar
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            {{-- Modal confirmacion aplicar precios --}}
            <v-dialog v-model="dialogConfirm" width="500">
                <v-card>
                    <v-card-title class="headline">
                        ¿Está seguro que desea aplicar esta lista de precios?
                    </v-card-title>
                    <v-card-text>Al aplicar se cambiara el precio y costo de todos productos por los precios y costos designados en la lista.</v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        color="red darken-1"
                        text
                        @click="dialogConfirm = false"
                      >
                        Cancelar
                      </v-btn>
                      <v-btn
                        color="green darken-1"
                        text
                        @click="applyPrices(); dialogConfirm = false"
                      >
                        Aceptar
                      </v-btn>
                    </v-card-actions>
                  </v-card>
            </v-dialog>
        </v-main>
    </v-app>
</div>
