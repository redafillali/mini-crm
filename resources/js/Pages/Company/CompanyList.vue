<template>
    <div>
      <h1>Liste des sociétés</h1>
      <ul>
        <li v-for="company in companies" :key="company.id">
          {{ company.name }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        companies: [],
      };
    },
    created() {
      // Récupérer la liste des sociétés depuis l'API Laravel
      this.$http.get('/api/companies')
        .then(response => {
          this.companies = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  };
  </script>
  