<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Icons from '@/Components/Icons/Icons.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';


const teamName = ref(null);
const users = ref([]);
const show = ref('');
const success = ref('');
const error = ref('');
const equipe_id = ref('');

const createTeam = () => {
    axios.post(route('equipe.store', { teamName: teamName.value }))
        .then(response => {

            users.value = response.data.users;
            show.value = response.data.show;
            success.value = response.data.success;
            error.value = response.data.error;
            equipe_id.value = response.data.equipe_id;
            console.log(response.data.users);


        })
}

const lignesSelectionnees = ref([]);

function recupererLignesSelectionnees() {
    const lignes = [];
    lignesSelectionnees.value.forEach((index) => {
        lignes.push(users.value[index].id);
      
    });

    axios.post('/equipe/ajoutMembre', {
        idMembres: lignes,
        equipe_id:  equipe_id.value

    })
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.error(error);
        });
}

onMounted(() => {
    // Effacement du message de notification après quelques secondes
    if (success.value) {
        setTimeout(() => {
            success.value = '';
        }, 3000);
    }
    // Effacement du message de notification après quelques secondes
    if (error.value) {
        setTimeout(() => {
            error.value = '';
        }, 3000);
    }
})



</script>
<template>
    <AuthenticatedLayout>

        <Head title="Creation d'équipe" />
        <!-- Votre template HTML -->
        <div>
            <div v-if="error"
                class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                role="alert">
                <Icons name="info" />
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Alerte!</span>
                    {{ error }}
                </div>
            </div>

            <div v-if="success"
                class="flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <Icons name="info" />
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Super! </span>
                    {{ success }}
                </div>
            </div>


        </div>

        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-6">Créer une équipe</h1>
            <div class="max-w-lg ">
                <label for="teamName" class="block text-gray-700">Nom de l'équipe:</label>
                <div class="flex items-center gap-5">
                    <input type="text" id="teamName" v-model="teamName" required
                        class="w-full px-4 py-2 border border-gray-300 rounded">

                    <button @click="createTeam" class="px-4 py-2  bg-green-500 text-white rounded">Créer</button>
                </div>
            </div>
        </div>

        <div v-if="show" class="container mx-auto px-4 mt-5">
            <h2 class="text-xl font-bold mb-4">Ajouter des membres</h2>
            <input placeholder="Rechercher par email" class=" px-4 h-8 shadow border-gray-300 rounded" type="search" name=""
                id="">
            <div class="mb-4 flex flex-col h-20 w-96">
                <div class="bg-white rounded-md shadow overflow-x-auto h-96 overflow-y-scroll">
                    <table class="w-full whitespace-nowrap text-sm text-left text-gray-500">
                        <thead class=" rounded-md shadow h-10 text-left sticky top-0 z-10 bg-white">
                            <tr class="text-center">
                                <th></th>
                                <th class="pr-40">Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="index"
                                class="border-b hover:bg-[#dfe3ff96] cursor-pointer">
                                <td class="font-bold px-6 py-1">
                                    <input type="checkbox" :value="index" v-model="lignesSelectionnees">
                                </td>
                                <td class="font-bold px-6 py-2">
                                    {{ user.name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="button" @click="recupererLignesSelectionnees"
                class="px-4 py-2 bg-green-500 text-white rounded">Ajouter</button>
        </div>

    </AuthenticatedLayout>
</template>


<style></style>
