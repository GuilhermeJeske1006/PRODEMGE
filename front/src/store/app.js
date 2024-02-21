// Utilities
import { defineStore } from 'pinia'
import axios from 'axios'
import { useToast } from 'vue-toast-notification'

export const useAppStore = defineStore('app', {
  state: () => ({
    data: [],
    adress: {},
    details: {},
    isLoading: false,

  }),

  actions: {
    getUsers(data){
      this.isLoading = true
      return new Promise((resolve, reject) => {
        axios.get('users', {
          params: data
        })
          .then(response => {
            this.data = response.data.data
            resolve(response)
          })
          .catch(error => {
            useToast().error("Erro ao capturar os dados!");
            reject(error)
          }).finally(() => {
            this.isLoading = false
          })
      })  
    },

    showUser(id){
      this.isLoading = true
      return new Promise((resolve, reject) => {
        axios.get(`user/${id}`)
          .then(response => {
            this.details = response.data.data
            resolve(response)
          })
          .catch(error => {
            reject(error)
            useToast().error("Erro ao capturar os dados!");
          }).finally(() => {
            this.isLoading = false
          })
      })
    },

    storeUser(data){
      this.isLoading = true
      return new Promise((resolve, reject) => {
        axios.post('/user', data)
          .then(response => {
            this.details = response.data
            resolve(response)
            useToast().success("Usuario criado com sucesso!");


          })
          .catch(error => {
            reject(error)
            useToast().error("Erro ao criar o usuario!");
          }).finally(() => {
            this.isLoading = false
          })
      })
    },

    storeAdress(data){
      this.isLoading = true

      return new Promise((resolve, reject) => {
        axios.post('/adress', data)
          .then(response => {
            resolve(response)
            useToast().error("Endereço criado com sucesso!");

          })
          .catch(error => {
            useToast().error("Erro ao criar o endereço!");
            reject(error)
          }).finally(() => {
            this.isLoading = false
          })
      })
    },

    updateAdress(data){
      this.isLoading = true

      return new Promise((resolve, reject) => {
        axios.put(`/adress/${data.id}`, data)
          .then(response => {
            resolve(response)
            useToast().success("Endereço alterado com sucesso!");

          })
          .catch(error => {
            reject(error)
            useToast().error("Erro ao alterar o endereço!");

          }).finally(() => {
            this.isLoading = false
          })
      })
    }

  },



})
