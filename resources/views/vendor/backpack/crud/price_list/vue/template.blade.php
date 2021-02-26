<div id="custom-vue-app">
  <v-app id="app"> 
        <v-card class="mt-4 mx-6">
            <v-card-title>
                Nutrition
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details>
                </v-text-field>
            </v-card-title>
            <v-data-table attach auto :headers="headers" :items="desserts" :search="search">
                <template v-slot:item.actions="{ item }">
                    acciones
                </template>
            </v-data-table>
        </v-card>

      </v-app>
</div> 

