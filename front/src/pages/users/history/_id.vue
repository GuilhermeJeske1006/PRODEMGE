<template>
    <v-container>
      <v-row justify="space-around">
        <v-card width="10000">
          <v-img
            height="200"
            src="https://cdn.vuetifyjs.com/docs/images/cards/purple-flowers.jpg"
            cover
            class="text-white"
          >
            <v-row
              align="center"
              class="fill-height ma-0"
            >
              <v-col>
                <v-card-title class="text-h5">
                  <span class="ml-2">Nome: {{ data.name }}</span>


                </v-card-title>
              </v-col>
            </v-row>
          </v-img>
  
          <v-card-text>
            <div class="font-weight-bold ms-1 mb-2">
              Históricos de endereços
            </div>
  
            <v-timeline density="compact" align="start">
              <v-timeline-item
                v-for="item in data.adress"
                :key="item.time"

                size="x-small"
              >
                <div class="mb-4">
                  <div class="font-weight-normal">
                    <strong>{{ item.tipo_endereco }} - {{ item.logradouro }}</strong> ,{{ item.numero }}
                  </div>
                  <div>{{ item.bairro }}, {{ item.cidade }}/ {{ item.estado }}</div>
                </div>
              </v-timeline-item>
            </v-timeline>
          </v-card-text>
        </v-card>
      </v-row>
    </v-container>
  </template>


<script setup>
  import { useAppStore } from '@/store/app'
import { computed, onMounted } from 'vue'
  import { useRouter } from 'vue-router'


const store = useAppStore()

const router = useRouter()

const data = computed(() => store.$state.details)

onMounted(() => {
  store.showUser(router.currentRoute.value.params.id)
})
</script>