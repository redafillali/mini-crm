<template>
    <div>
      <h1>Créer une nouvelle société</h1>
      <form @submit.prevent="createCompany">
        <label for="name">Nom de la société:</label>
        <input type="text" id="name" v-model="name" required>
        <button type="submit">Créer</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
      };
    },
    methods: {
      createCompany() {
        // Envoyer les données du formulaire à l'API Laravel pour créer une nouvelle société
        this.$http.post('/api/companies', { name: this.name })
          .then(response => {
            // Rediriger vers la liste des sociétés ou une autre page appropriée
            this.$router.push('/companies');
          })
          .catch(error => {
            console.error(error);
          });
      },
    },
  };
  </script>
  