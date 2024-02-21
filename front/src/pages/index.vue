<template>
  <v-card class="mx-auto" color="grey-lighten-3">
    <v-layout>
      <v-main>
        <v-container fluid>
          <v-card flat title="Filtrar usuários">
            <template v-slot:text>
              <div class="d-flex">
                <v-text-field v-model="search.id" label="ID"></v-text-field>
                <div class="ms-3"></div>
                <v-text-field v-model="search.nome" label="Nome"></v-text-field>
                <div class="ms-3"></div>
                <v-text-field v-model="search.cpf" label="CPF"></v-text-field>
                <div class="ms-3"></div>
                <v-btn size="x-large" @click="filter()">
                  <v-icon>mdi-magnify</v-icon>
                </v-btn>
              </div>
            </template>


            <v-data-table :headers="headers" :items="item" :search="search">
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Listagem de usuários</v-toolbar-title>
                  <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ props }">
                      <v-btn color="primary" dark class="mb-2" v-bind="props" @click="redirectNewUser()">
                        Novo usuario
                      </v-btn>
                    </template>

                  </v-dialog>

                </v-toolbar>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-icon size="small" class="me-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon size="small" @click="historyItem(item)">
                  mdi-history
                </v-icon>
              </template>
            </v-data-table>

          </v-card>
        </v-container>
      </v-main>
    </v-layout>
  </v-card>
</template>
<script setup>
import { computed, ref } from 'vue'
import { onMounted } from 'vue'
import { useAppStore } from '@/store/app'
import router from '@/router';

const search = ref({
  id: '',
  nome: '',
  cpf: '',
})
const headers = ref([
  {
    align: 'start',
    key: 'id',
    sortable: false,
    title: 'ID',
  },
  { key: 'nome', title: 'Nome' },
  { key: 'cpf', title: 'CPF' },
  { key: 'email', title: 'email' },
  { key: 'actions', title: 'Ações', sortable: false },

])

const item = computed(() => {
  return data.value.map(item => ({
    id: item.id,
    nome: item.name,
    cpf: item.cpf,
    email: item.email,
  }))
})

const filter = () => {
  store.getUsers({
    id: search.value.id,
    nome: search.value.nome,
    cpf: search.value.cpf,

  })
}

const redirectNewUser = () => {
  router.push('/store')
}

const editItem = (item) => {
  router.push(`/users/${item.id}`)
  console.log(item, 'edit');
}

const historyItem = (item) => {
  router.push(`/users/history/${item.id}`)
  console.log(item, 'history');
}

const store = useAppStore()

const data = computed(() => store.$state.data)

onMounted(() => {
  store.getUsers()
})

</script>