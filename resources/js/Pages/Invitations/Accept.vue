<script setup>
// Accpet invitation form
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { defineProps, ref, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    invitation: Object,
});
</script>

<template>
    <Head title="Accepter une invitation" />
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Accepter une invitation</h2>
    </template>
    <div class="py-12">
        <!-- Accept Invitation Form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form>
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <!-- use the v-model directive to bind the name property to the input -->
                        <!-- Use vue Components -->
                        <InputLabel for="name" class="mb-0">Nom de l'employé:</InputLabel>
                        <TextInput id="name" v-model="form.name" required autofocus />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <InputLabel for="email" class="mb-0">Email:</InputLabel>
                        <TextInput id="email" v-model="form.invitee_email" autofocus readonly />
                    </div>
                    <!-- Password and Password confirmation -->
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <InputLabel for="password" class="mb-0">Mot de passe:</InputLabel>
                        <TextInput id="password" v-model="form.password" type="password" autofocus />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <InputLabel for="password_confirmation" class="mb-0">Confirmer le mot de passe:</InputLabel>
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                                   autofocus />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                    <div class="flex justify-end">
                        <SecondaryButton class="mr-4" :href="route('invitations.index')">Annuler</SecondaryButton>
                        <PrimaryButton @click="acceptInvitation">Accepter</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>