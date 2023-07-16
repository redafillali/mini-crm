<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import Flash from '@/Components/Flash.vue';
import { defineProps, ref } from 'vue';



defineProps({
    companies: Object,
    session: Object,
});

// Delete company using form
const form = useForm({
    _method: 'delete',
});

// delete copany form frensh version
const deleteCompany = (companyId) => {
    if (confirm('Voulez-vous vraiment supprimer cette société?')) {
        form.delete(route('companies.destroy', companyId), {
            preserveScroll: true,
        });
    }
};

</script>

<template>
    <Head title="La liste des sociétés" />
    <Flash v-if="$page.props.flash.message" class="mb-4" :message="$page.props.flash.message"
           :type="$page.props.flash.type" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">La liste des sociétés</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    {{ $page.props.flash.message }}
                    <div class="flex justify-end">
                        <a :href="route('companies.create')"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Créer une nouvelle société
                        </a>
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nom</th>
                                <th class="px-4 py-2">Adresse</th>
                                <th class="px-4 py-2">Téléphone</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="company in companies" :key="company.id">
                                <td class="border px-4 py-2">{{ company.name }}</td>
                                <td class="border px-4 py-2">{{ company.address }}</td>
                                <td class="border px-4 py-2">{{ company.phone }}</td>
                                <td class="border px-4 py-2">{{ company.email }}</td>
                                <td class="border px-4 py-2">
                                    <a :href="route('companies.edit', company.id)"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Modifier
                                    </a>
                                    <form @submit.prevent="deleteCompany(company.id)" class="inline">
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>