<script setup>
// Edit campany
import { defineProps } from 'vue';
import AdminsLayout from '@/Layouts/AdminsLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
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

defineProps({
  company: Object,
});

const updateCompany = () => {
  form.put(route('companies.update', usePage().props.company.id), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
};



// form model binding from the company prop
form.name = usePage().props.company.name;
form.address = usePage().props.company.address;
form.phone = usePage().props.company.phone;
form.email = usePage().props.company.email;
form.website = usePage().props.company.website;

</script>

<template>
  <Head title="Modifier une Société" />
  <AdminsLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier une Société</h2>
    </template>
    <div class="py-12">
      <!-- Create Comapny Form -->
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <form @submit.prevent="updateCompany">
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
              <InputLabel for="website" class="mb-0">Site web:</InputLabel>
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
  </AdminsLayout>
</template>