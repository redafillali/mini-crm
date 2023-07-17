<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Flash from '@/Components/Flash.vue';
import { defineProps, ref, watch } from 'vue';

defineProps({
  invitations: Object,
  session: Object,
});

// Delete invitations using form
const form = useForm({
  _method: 'delete',
});

const deleteInvitation = (invitationId) => {
  if (confirm('Voulez-vous vraiment supprimer cette société?')) {
    form.delete(route('invitations.destroy', invitationId), {
      preserveScroll: true,
    });
  }
};

// Search Invitation
const search = ref('');

const companies = ref(usePage().props.companies);
watch(search, (value) => {
  companies.value = usePage().props.companies.filter((company) => {
    return company.name.toLowerCase().includes(value.toLowerCase());
  });
});

</script>

<template>
  <Head title="La liste des invitations" />
  <Flash v-if="$page.props.flash.message" class="mb-4" :message="$page.props.flash.message"
         :type="$page.props.flash.type" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">La liste des invitations</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 grid-cols-3">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="grid grid-cols-4 gap-6 justify-end mb-4">
            <select v-model="sort"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              <option value="">Trier par</option>
              <option value="name">Nom</option>
              <option value="address">Adresse</option>
              <option value="phone">Téléphone</option>
              <option value="email">Email</option>
            </select>
            <input type="text" placeholder="Rechercher une société ou un employé"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   v-model="search" />
            <div class="flex justify-end col-span-2">
              <a :href="route('invitations.create')"
                 class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded col-span-2">
                Créer une nouvelle Invitation
              </a>
            </div>
          </div>
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Adresse mail</th>
                <th class="px-4 py-2">Société</th>
                <th class="px-4 py-2">status</th>
                <th class="px-4 py-2">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="invitations.length" v-for="invitation in invitations" :key="invitation.id">
                <td class="border px-4 py-2">{{ invitation }}</td>
                <td class="border px-4 py-2">{{ invitation }}</td>
                <td class="border px-4 py-2">{{ invitation }}</td>
                <td class="border px-4 py-2">{{ invitation.email }}</td>
                <td class="border px-4 py-2">
                  <a href="#"
                     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Modifier
                  </a>
                  <form @submit.prevent="deleteInvitation(invitation.id)" class="inline">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                      Supprimer
                    </button>
                  </form>
                </td>
              </tr>
              <tr v-else>
                <td class="border px-4 py-2 text-center" colspan="5">Aucune invitation trouvée.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </AuthenticatedLayout>
</template>