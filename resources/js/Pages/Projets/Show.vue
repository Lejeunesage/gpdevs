

<template>
    <AuthenticatedLayout>

        <Head title="Créer Kanban" />
        <nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-lg py-2 mb-2 rounded-full">
            <div class=" flex flex-wrap items-center justify-between  gap-8">
                <div class="font-bold text-lg px-5 text-[#0c7187]">Projet : 
                    {{ props.projet.name }}
                </div>

                <div class="flex ">
                    <ul class="flex  gap-5 font-medium px-5 ">
                        <li>
                            <a href="#" class="">Membres</a>
                        </li>
                        <!-- <li>
                            <a href="#" class="">About</a>
                        </li>
                        <li>
                            <a href="#" class="">Services</a>
                        </li> -->
                    </ul>
                </div>

            </div>
        </nav>

        <div v-if="show" class="container mx-auto px-4 mt-5">
            <h2 class="text-xl font-bold mb-4">Ajouter des membres</h2>

            <div>
                <div class="flex gap-5">
                    <input class=" px-4 py-2 border border-gray-300 rounded" v-model="searchTerm" type="search"
                        placeholder="Rechercher un membre">
                    <button class="px-4 py-2  bg-green-500 text-white rounded" @click="addMember()">Ajouter</button>
                </div>
                <ul>
                    <li class="cursor-pointer" v-if="filteredMembers.length > 0"
                        @click="selectMember(filteredMembers[0].id)">
                        {{ filteredMembers[0].name }}
                    </li>
                </ul>
            </div>

        </div>
        <div class="flex justify-center rounded-lg ">
            <button @click="showCreateInput"
                class="bg-gradient-to-r from-blue-500 to-blue-700 mb-4 text-white py-1 px-2 rounded flex items-center space-x-2 hover:bg-blue-600">
                <Icons name="plus" />
                <span>Nouvelle colonne</span>
            </button>
            <div v-if="showCreate" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Ajouter une colonne</h3>
                    <input v-model="newColumnTitle" type="text" placeholder="Ajouter une colonne"
                        class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full  mb-4" />
                    <div class="flex justify-between">
                        <button @click="addColumn" class="bg-blue-500 text-white py-2 px-4 rounded">Créer</button>
                        <button @click="removeCreate"
                            class="bg-gray-300 text-gray-700 py-2 px-4 rounded ml-2">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex  items-start space-x-4 ">

            <div v-for="(colonne, colonneIndex) in colonnes" :key="colonneIndex"
                class="flex-shrink-0  border bg-gray-100 rounded-lg p-4">

                <!-- Nom de la colonne -->

                <h2 class="text-xl font-bold mb-4">{{ colonne.titre }}</h2>


                <!-- Bouton d'ajout de tâches à la colonne -->
                <button @click="showCreateTache(colonneIndex)"
                    class="mb-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white py-1 px-2 rounded flex items-center space-x-2 hover:bg-blue-600">
                    <Icons name="plus" />
                    <span>Nouvelle tâche</span>
                </button>

                <div v-if="showTacheCreate[colonneIndex]" class="fixed inset-0 flex  items-center justify-center z-50">
                    <div class="bg-white border w-96 rounded-lg shadow-lg p-5">
                        <h3 class="text-xl font-bold mb-4">Ajouter une tâche</h3>



                        <div class="mb-4">
                            <label for="name" class="block">Nom de la tâche</label>
                            <input id="name" v-model="newTaskNames[colonneIndex]" type="text"
                                placeholder="Ajouter une tâche"
                                class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full " />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block">Ajouter une description</label>
                            <textarea id="description" v-model="newTaskDescriptions[colonneIndex]" type="text"
                                placeholder="Ajouter une description"
                                class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full "></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="datetime" class="block">Date et heure de livraison</label>
                            <input id="datetime" v-model="newTaskDeadlines[colonneIndex]" type="datetime-local"
                                placeholder="Ajouter une échéance"
                                class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full " />
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="block">Ajouter une priorité</label>
                            <select id="priority" v-model="newTaskPriorities[colonneIndex]"
                                placeholder="Choisir la priorité"
                                class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full ">
                                <option value="Haute">Haute</option>
                                <option value="Moyenne">Moyenne</option>
                                <option value="Basse">Basse</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="addmember" class="block">Affecter un membre</label>
                            <select v-model="newTaskMembers[colonneIndex]" id="addmember" placeholder="Affecter un membre"
                                class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full ">
                                <option value="Geoffroy OTEGBEYE">Geoffroy OTEGBEYE</option>
                            </select>
                        </div>

                        <div class="flex justify-between">
                            <button @click="addTask(colonneIndex)"
                                class="bg-blue-500 text-white py-2 px-4 rounded">Ajouter</button>
                            <button @click="removeCreateTache(colonneIndex)"
                                class="bg-gray-300 text-gray-700 py-2 px-4 rounded ml-2">Fermer</button>
                        </div>
                    </div>
                </div>

                <!-- Affichage des taches de la colonne -->
                <draggable v-model="colonne.taches" :group="{ name: 'kanban', pull: 'clone', put: false }"
                    :item-key="tache => tache.id" @start="handleDragStart(colonneIndex)" @end="handleDragEnd">
                    <div v-for="(tache, tacheIndex) in colonne.taches" :key="tacheIndex"
                        class="bg-white rounded-lg shadow-md p-4 mb-4">
                        <p class="text-gray-800">{{ tache.name }}</p>
                        <!-- Autres détails de la tâche -->
                    </div>
                </draggable>


            </div>




            <!-- Modal update des taches -->
            <div v-if="selectedCard" class="modal flex items-center justify-center">
                <div class="modal-content bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Modifier la tâche</h3>
                    <form @submit.prevent="updateTask">
                        <label for="title" class="mb-2">Titre</label>
                        <input type="text" v-model="selectedCard.title" required
                            class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full  mb-4">

                        <label for="description" class="mb-2">Description</label>
                        <textarea v-model="selectedCard.description"
                            class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500 w-full  mb-4"></textarea>

                        <!-- Autres champs de mise à jour (projet, statut, priorité, utilisateur, date, etc.) -->

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Enregistrer</button>
                        <button type="button" class="bg-gray-300 text-gray-700 py-2 px-4 rounded ml-2"
                            @click="closeModal">Fermer</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
  
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Icons from '@/Components/Icons/Icons.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive, watch, computed } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';
import { rose } from 'tailwindcss/colors';

let props = defineProps({
    projet: {
        type: Array,
        default: () => ({}),
    },
    membres: {
        type: Array,
        default: () => ({}),
    },
    colonnes: {
        type: Array,
        default: () => ({}),
    },


});
let colonnes = ref(props.colonnes)

const selectedCard = ref(null);
const newColumnTitle = ref('');



const newTaskNames = ref([]);
const newTaskDescriptions = ref([]);
const newTaskDeadlines = ref([]);
const newTaskPriorities = ref([]);
const newTaskMembers = ref([]);

let showCreate = ref(false);

const showCreateInput = () => {
    showCreate.value = true;

};
const removeCreate = () => {
    showCreate.value = false;

};

const showTacheCreate = ref([]); // Tableau pour gérer l'affichage de l'input de création de tâche par colonne

const showCreateTache = (colonneIndex) => {
    showTacheCreate.value[colonneIndex] = true;
};

const removeCreateTache = (colonneIndex) => {
    showTacheCreate.value[colonneIndex] = false;
    newTasks.value[colonneIndex] = '';
};

const newTasks = ref([]); // Tableau pour stocker les nouvelles tâches à ajouter dans chaque colonne

const colonneIds = computed(() => {
    console.log(colonnes.value.map((colonne) => colonne.id));
    return colonnes.value.map((colonne) => colonne.id);
});

const addTask = (colonneIndex) => {
    const colonneId = colonneIds.value[colonneIndex];
    const newTaskName = newTaskNames.value[colonneIndex].trim();
    const newTaskDescription = newTaskDescriptions.value[colonneIndex].trim();
    const newTaskDeadline = newTaskDeadlines.value[colonneIndex].trim();
    const newTaskPriority = newTaskPriorities.value[colonneIndex].trim();
    const newTaskMember = newTaskMembers.value[colonneIndex].trim();

    // Vérifiez si le nom de la nouvelle tâche n'est pas vide
    if (newTaskName !== '') {
        // Créez un objet représentant la nouvelle tâche avec toutes ses données
        const newTask = {
            name: newTaskName,
            description: newTaskDescription,
            equipe_id: 1,
            member: 2,
            date_heure_livraison: newTaskDeadline,
            colonne_id: colonneId,
            priority: newTaskPriority,
            // Autres détails de la tâche
        };

        console.log(newTask);
        axios.post(route('tache.store', newTask)).then(response => {
            removeCreateTache(colonneIndex)
        })

        // Ajoutez la nouvelle tâche à la colonne correspondante
        colonnes.value[colonneIndex].taches.push(newTask);



        // Réinitialisez les champs d'ajout de tâche pour la colonne correspondante
        newTaskNames.value[colonneIndex] = '';
        newTaskDescriptions.value[colonneIndex] = '';
        newTaskDeadlines.value[colonneIndex] = '';
        newTaskPriorities.value[colonneIndex] = '';
        newTaskMembers.value[colonneIndex] = '';
    }
};


// Ajouter une nouvelle colonne dans la base de donnée.


const addColumn = () => {
    const newColumnName = newColumnTitle.value.trim();

    if (newColumnName !== '') {
        const newColumn = {
            titre: newColumnTitle.value
        };

        console.log(newColumnTitle.value);
        axios.post(route('column.store', {
            column_name: newColumnTitle.value,
        })).then(res => {
            removeCreate()
        })

        colonnes.value.push(newColumn);
        newColumnTitle.value = '';
    }
};

const openModal = (card) => {
    selectedCard.value = card;
};

const closeModal = () => {
    selectedCard.value = null;
};

const updateTask = () => {
    // Appeler l'API pour mettre à jour les informations de la tâche
    closeModal();
};



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
  
<style scoped></style>
  