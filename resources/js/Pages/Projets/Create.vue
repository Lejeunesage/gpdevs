<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Icons from '@/Components/Icons/Icons.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive, watch, computed } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';


const form = ref({
    name: '',
    description: ''
})



const createProjet = () => {
  router.post(route('projet.store'), form.value, {
    onSuccess: () => {
      // Réinitialise le formulaire après la soumission réussie
      form.value.name = '';
      form.value.description = '';
    }
  });
};


const teamName = ref(null);
const users = ref([]);
const show = ref('');
const success = ref('');
const error = ref('');
const projet_id = ref('');

const k = () => {
    axios.post(route('projet.store', { teamName: teamName.value }))
        .then(response => {

            users.value = response.data.users;
            show.value = response.data.show;
            success.value = response.data.success;
            error.value = response.data.error;
            projet_id.value = response.data.projet_id;
            console.log(response.data.users);


        })
}

const lignesSelectionnees = ref([]);

function recupererLignesSelectionnees() {
    const lignes = [];
    lignesSelectionnees.value.forEach((index) => {
        lignes.push(users.value[index].id);

    });

    axios.post('/projet/ajoutMembre', {
        idMembres: lignes,
        projet_id: projet_id.value

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

const searchTerm = ref('');
const idMembres = ref('');
const members = ref([]);

watch(searchTerm, () => {
    searchMembers();
});

const searchMembers = () => {
    axios.post('/search-members', { searchTerm: searchTerm.value })
        .then(response => {
            members.value = response.data;
            console.log(members.value);
        })
        .catch(error => {
            console.error(error);
        });
};

const filteredMembers = computed(() => {
    if (!searchTerm.value) {
        return [];
    }
    return members.value;
});

const selectMember = (id) => {
    console.log(id);
    axios.post('/select-members', { id: id })
        .then(response => {
            searchTerm.value = response.data[0].name;
            idMembres.value = response.data[0].id;

        })
        .catch(error => {
            console.error(error);
        });

};

const addMember = () => {
    // Récupérer l'id et l'email du membre sélectionné
    axios.post('/projet/ajoutMembre', {
        idMembres: idMembres.value,
        projet_id: projet_id.value

    })
        .then((response) => {
            searchTerm.value = ''
            console.log(response);
            success.value = response.data.success;
        })
        .catch((error) => {
            console.error(error);
        });
};

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



        <div class="max-w-md mx-auto mt-8 p-4 bg-white rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Créer un nouveau projet</h1>
            <form @submit.prevent="createProjet">
                <div class="mb-4">
                    <label for="projectName" class="block text-gray-700 font-bold mb-2">Nom du projet:</label>
                    <input type="text" id="projectName" v-model="form.name" required
                        class="w-full px-4 py-2  rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label for="projectDescription" class="block text-gray-700 font-bold mb-2">Description du
                        projet:</label>
                    <textarea id="projectDescription" v-model="form.description" required
                        class="w-full px-4 py-2  rounded focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                </div>
                <button type="submit"
                    class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-200">Créer
                    le projet</button>
            </form>
        </div>

        <!-- <div v-if="show" class="container mx-auto px-4 mt-5">
            <h2 class="text-xl font-bold mb-4">Ajouter des membres</h2>

            <div>
                <div class="flex gap-5">
                    <input class=" px-4 py-2 border border-gray-300 rounded" v-model="searchTerm" type="search" placeholder="Rechercher un membre">
                    <button class="px-4 py-2  bg-green-500 text-white rounded" @click="addMember()">Ajouter</button>
                </div>
                <ul>
                    <li class="cursor-pointer" v-if="filteredMembers.length > 0" @click="selectMember(filteredMembers[0].id)">
                        {{ filteredMembers[0].name }}
                    </li>
                </ul>
            </div>

        </div> -->

    </AuthenticatedLayout>
</template>


<style></style>
