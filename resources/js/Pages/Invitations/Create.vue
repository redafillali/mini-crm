<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { defineProps, ref, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
  companies: Object,
});

// Create invitation form
const form = useForm({
  name: '',
  invitee_email: '',
  company: '',
});

const createInvitation = () => {
  form.post(route('invitations.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};
</script>

<template>
  <Head title="Créer une invitation" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une invitation</h2>
    </template>
    <div class="py-12">
      <!-- Create Invitation Form -->
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <form @submit.prevent="createInvitation">
            <div class="grid grid-cols-1 gap-6 mb-4">
              <!-- use the v-model directive to bind the name property to the input -->
              <!-- Use vue Components -->
              <InputLabel for="name" class="mb-0">Nom de l'employé:</InputLabel>
              <TextInput id="name" v-model="form.name" required autofocus />
              <InputError :message="form.errors.name" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="email" class="mb-0">Email:</InputLabel>
              <TextInput id="email" v-model="form.invitee_email" autofocus />
              <InputError :message="form.errors.email" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="company" class="mb-0">Société:</InputLabel>
              <select id="company" v-model="form.company" autofocus>
                <option value="">Sélectionner une société</option>
                <option v-for="company in companies" :key="company.id" :value="company.id">
                  {{ company.name }}
                </option>
              </select>
              <InputError :message="form.errors.societe_id" />
            </div>
            <div class="flex justify-end">
              <SecondaryButton :href="route('invitations.index')" class="mr-4">
                Annuler
              </SecondaryButton>
              <PrimaryButton type="submit">
                Créer une invitation
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>