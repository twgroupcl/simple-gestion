<div id="custom-vue-app">
    <v-app id="app">
        <v-main>
            <v-card class="mt-4 mx-6">
                <v-card-title>
                    Productos
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar" single-line hide-details>
                    </v-text-field>
                </v-card-title>
                <v-data-table attach auto :headers="headers" :items="products" :search="search">
                    <template v-slot:item.actions="{ item }">
                        <v-btn color="primary" @click="openEditModal(item)">Editar</v-btn>
                    </template>
                </v-data-table>
            </v-card>

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
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field
                                    label="Costo"
                                    hide-details="auto"
                                    v-model="selectedProduct.cost"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" text @click="updateProduct(selectedProduct)">
                            I accept
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-main>
    </v-app>
</div>
