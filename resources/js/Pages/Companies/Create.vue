<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const form = useForm({
  name: '',
  address: '',
  phone: '',
  email: '',
  website: '',
});

const createCompany = () => {
  form.post(route('companies.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};

defineProps({
  companies: Object
});
</script>
<template>
  <Head title="Créer une nouvelle Société" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une nouvelle Société</h2>
    </template>
    <div class="py-12">
      <!-- Create Comapny Form -->
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <form @submit.prevent="createCompany">
            <div class="grid grid-cols-1 gap-6 mb-4">
              <!-- use the v-model directive to bind the name property to the input -->
              <!-- Use vue Components -->
              <InputLabel for="name" class="mb-0">Nom de la société:</InputLabel>
              <TextInput id="name" v-model="form.name" required autofocus />
              <InputError :message="form.errors.name" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="address" class="mb-0">Adresse:</InputLabel>
              <TextInput id="address" v-model="form.address" autofocus />
              <InputError :message="form.errors.address" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="phone" class="mb-0">Téléphone:</InputLabel>
              <TextInput id="phone" v-model="form.phone" autofocus />
              <InputError :message="form.errors.phone" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="email" class="mb-0">Email:</InputLabel>
              <TextInput id="email" v-model="form.email" autofocus />
              <InputError :message="form.errors.email" />
            </div>
            <div class="grid grid-cols-1 gap-6 mb-4">
              <InputLabel for="website" class="mb-0">Site Web:</InputLabel>
              <TextInput id="website" v-model="form.website" autofocus />
              <InputError :message="form.errors.website" />
            </div>
            <div class="flex justify-end">
              <SecondaryButton :href="route('companies.index')" class="mr-4">
                Annuler
              </SecondaryButton>
              <PrimaryButton type="submit">Mettre à jour</PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>