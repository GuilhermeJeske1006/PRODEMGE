<template>
  <v-form>
    <v-container>
      <v-row>


      </v-row>
      <v-row>
        <div>
          <v-col cols="12">

            <v-btn @click="backList">Voltar para listagem</v-btn>
          </v-col>

        </div>

      </v-row>
      <v-row>


      </v-row>
      <v-row>
        <div>Dados do usuário</div>

      </v-row>
    </v-container>
    <v-container>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.name" disabled label="Nome completo" required hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_social" disabled label="Nome social" hide-details required></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.email" disabled label="E-mail" hide-details required></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.cpf" label="CPF" disabled required hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_pai" disabled label="Nome do pai" hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_mae" disabled label="Nome da mãe" hide-details required></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.telefone" disabled label="Telefone" hide-details></v-text-field>
        </v-col>
      </v-row>
    </v-container>

    <v-form @submit.prevent="submitAdress">
      <v-container>
      </v-container>
      <v-container>
        <v-row>
          <v-col cols="12" md="4">

            <div>Dados do Endereço</div>
          </v-col>


        </v-row>
        <v-container v-for="(adress, index) in data.adress" :key="index">
          <v-row>
            <v-col cols="12" md="4">
              Endereco {{ adress.tipo_endereco }} - {{ adress.numero }}
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-select v-model="adress.tipo_endereco" label="Select" :items="['Residencial', 'Comercial']"></v-select>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.cep" @input="getAdress(index)" label="Cep" hide-details
                required></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.logradouro" :readonly="adress.logradouroPreenchido" label="Logradouro"
                hide-details></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-text-field v-model="adress.numero" label="Número" hide-details></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.complemento" :readonly="adress.complementoPreenchido" label="Complemento"
                hide-details></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.bairro" :readonly="adress.bairroPreenchido" label="Bairro" hide-details
                required></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="4">
              <v-text-field v-model="adress.cidade" :readonly="adress.cidadePreenchida" label="Cidade" required
                hide-details></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.estado" :readonly="adress.estadoPreenchido" label="Estado" hide-details
                required></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-col cols="12" md="4">
          <v-btn type="submit">
            Editar
          </v-btn>
        </v-col>
      </v-container>
    </v-form>

  </v-form>
</template>

<script setup>
import { computed, onMounted, } from "vue";
import axios from 'axios'
import { useAppStore } from '@/store/app'
import { useRouter } from "vue-router";



const router = useRouter()
onMounted(() => {
  store.showUser(router.currentRoute.value.params.id)
})

const data = computed(() => store.$state.details)

const store = useAppStore();

const submitAdress = async () => {
  try {
    for (const endereco of data.value.adress) {
      if (endereco.tipo_endereco == 'Residencial') {
        endereco.tipo_endereco = 0
      }
      if (endereco.tipo_endereco == 'Comercial') {
        endereco.tipo_endereco = 1
      }
      await store.updateAdress({
        id: endereco.id,
        user_id: router.currentRoute.value.params.id,
        tipo_endereco: endereco.tipo_endereco,
        cep: endereco.cep,
        logradouro: endereco.logradouro,
        numero: endereco.numero,
        complemento: endereco.complemento,
        bairro: endereco.bairro,
        cidade: endereco.cidade,
        estado: endereco.estado
      });
    }
  } catch (error) {
    console.error('Error submitting address data:', error);
  }
};

const backList = () => {
  router.push('/')
}

const getAdress = async (index) => {
  try {
    const response = await axios.get(`https://viacep.com.br/ws/${data.value.endereco[index].cep}/json/`);
    const endereco = response.data;

    data.value.endereco[index].logradouro = endereco.logradouro;
    data.value.endereco[index].logradouroPreenchido = endereco.logradouro !== '';

    data.value.endereco[index].complemento = endereco.complemento;
    data.value.endereco[index].complementoPreenchido = endereco.complemento !== '';

    data.value.endereco[index].bairro = endereco.bairro;
    data.value.endereco[index].bairroPreenchido = endereco.bairro !== '';

    data.value.endereco[index].cidade = endereco.localidade;
    data.value.endereco[index].cidadePreenchida = endereco.localidade !== '';

    data.value.endereco[index].estado = endereco.uf;
    data.value.endereco[index].estadoPreenchido = endereco.uf !== '';
  } catch (error) {
    console.error('Erro ao buscar endereço:', error);
  }
};



</script>