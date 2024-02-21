<template>
  <v-form @submit.prevent="submit">
    <v-container>
      <v-row>
        <div>
          <v-col cols="12">

            <v-btn @click="backList">Voltar para listagem</v-btn>
          </v-col>

        </div>

      </v-row>
      <v-row>
        <div>Dados do usuário</div>

      </v-row>
    </v-container>
    <v-container>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome" label="Nome completo" required hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_social" label="Nome social" hide-details required></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.email" :rules="emailRules" label="E-mail" hide-details required></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.cpf" label="CPF" required hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_pai" label="Nome do pai" hide-details></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="data.nome_mae" label="Nome da mãe" hide-details required></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="data.telefone" label="Telefone" hide-details></v-text-field>
        </v-col>
      </v-row>
      <v-row v-if="!adressTrue">
        <v-col cols="12" md="4">
          <v-btn type="submit">
            Salvar
          </v-btn>
        </v-col>
      </v-row>
    </v-container>

    <v-form @submit.prevent="submitAdress">

      <v-container v-if="adressTrue">


      </v-container>

      <v-container v-if="adressTrue">
        <v-row>
          <v-col cols="12" md="4">

            <div>Dados do endereço</div>
          </v-col>


        </v-row>
        <v-container v-for="(adress, index) in data.endereco" :key="index">

          <v-row>
            <v-col cols="12" md="4">
              <v-select v-model="adress.tipo_endereco" label="Select" :items="['Residencial', 'Comercial']"></v-select>
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field v-model="adress.cep" @input="getAdress(index)" label="Cep" hide-details required></v-text-field>
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

          <v-row>
            <v-col cols="12" md="4">
              <v-btn @click="increment()">
                + Adicionar
              </v-btn>
              <v-btn @click="decrement(index)">
                - remover
              </v-btn>
            </v-col>
          </v-row>

         
        </v-container>
        <v-col cols="12" md="4">
            <v-btn type="submit">
              Salvar
            </v-btn>
          </v-col>
      </v-container>
    </v-form>

  </v-form>
</template>

<script setup>
import { ref } from "vue";
import axios from 'axios'
import { useAppStore } from '@/store/app'
import { useRouter } from "vue-router";

const adressTrue = ref(false)

const data = ref({
  nome: '',
  nome_social: '',
  cpf: '',
  email: '',
  telefone: '',
  nome_pai: '',
  nome_mae: '',
  endereco: [{
    tipo_endereco: 0,
    cep: '',
    logradouro: '',
    logradouroPreenchido: false, // Indica se o campo foi preenchido via API
    complemento: '',
    complementoPreenchido: false,
    bairro: '',
    bairroPreenchido: false,
    cidade: '',
    cidadePreenchida: false,
    estado: '',
    estadoPreenchido: false,
    numero: '',
  }]
})

const increment = () => {
  data.value.endereco.push({
    tipo_endereco: 0,
    cep: '',
    logradouro: '',
    logradouroPreenchido: false, // Indica se o campo foi preenchido via API
    complemento: '',
    complementoPreenchido: false,
    bairro: '',
    bairroPreenchido: false,
    cidade: '',
    cidadePreenchida: false,
    estado: '',
    estadoPreenchido: false,
    numero: '',
  })
}

const decrement = (index) => {
  data.value.endereco.splice(index, 1)
}

const store = useAppStore();

const router = useRouter()

const backList = () => {
  router.push('/')
}

const submit = () => {

  store.storeUser({
    name: data.value.nome,
    nome_social: data.value.nome_social,
    cpf: data.value.cpf,
    email: data.value.email,
    telefone: data.value.telefone,
    nome_pai: data.value.nome_pai,
    nome_mae: data.value.nome_mae,
    password: 'password'
  }).then(response => {
    if (response) {
      adressTrue.value = true
    }
  }).catch(error => {
    console.log(error, 'error');
  })


};

const submitAdress = async () => {
  try {
    for (const endereco of data.value.endereco) {
      if(endereco.tipo_endereco == 'Residencial'){
        endereco.tipo_endereco = 0
      }
      if(endereco.tipo_endereco == 'Comercial'){
        endereco.tipo_endereco = 1
      }
      await store.storeAdress({
        id: store.$state.details.id,
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