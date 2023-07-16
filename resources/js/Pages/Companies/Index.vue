<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Flash from '@/Components/Flash.vue';
import { defineProps, ref, watch } from 'vue';



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

// Search company
const search = ref('');

// Filter companies on keyup
const companies = ref(usePage().props.companies);
watch(search, (value) => {
    companies.value = usePage().props.companies.filter((company) => {
        return company.name.toLowerCase().includes(value.toLowerCase());
    });
});

// Sort companies
const sort = ref('');

// Sort companies on change
watch(sort, (value) => {
    if (value === '') {
        companies.value = usePage().props.companies;
    } else {
        companies.value = usePage().props.companies.sort((a, b) => {
            return a[value].localeCompare(b[value]);
        });
    }
});
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
                        <input type="text" placeholder="Rechercher une société"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               v-model="search" />
                        <div class="flex justify-end col-span-2">
                            <a :href="route('companies.create')"
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded col-span-2">
                                Créer une nouvelle société
                            </a>
                        </div>
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