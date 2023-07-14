<template>
    <div>
      <h1>Modifier la société "{{ company.name }}"</h1>
      <form @submit.prevent="updateCompany">
        <label for="name">Nom de la société:</label>
        <input type="text" id="name" v-model="company.name" required>
        <button type="submit">Mettre à jour</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        company: null,
      };
    },
    created() {
      // Récupérer les détails de la société depuis l'API Laravel
      const companyId = this.$route.params.id;
      this.$http.get(`/api/companies/${companyId}`)
        .then(response => {
          this.company = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    methods: {
      updateCompany() {
        // Envoyer les données du formulaire à l'API Laravel pour mettre à jour la société
        const companyId = this.company.id;
        this.$http.put(`/api/companies/${companyId}`, { name: this.company.name })
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
  