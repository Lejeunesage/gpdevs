

<template>
    <AuthenticatedLayout>

        <Head :title="props.projet.name" />
        <nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-lg py-2 mb-2 rounded-full">
            <div class=" flex flex-wrap items-center justify-between  gap-8">
                <div class="font-bold cursor-pointer text-lg px-5 text-[#0c7187]">Projet :
                    {{ props.projet.name }}
                </div>

                <div class="flex ">
                    <ul class="flex items-center  gap-5 font-medium px-5 ">
                        <li>
                            <a @click="showModalMembres" class="cursor-pointer flex">Membres
                                <Icons name="dropdown" />
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex bg-teal-600 rounded-full px-3 items-center gap-2">
                                <Icons name="videocall" /><span class="text-white">Lancer l'appel</span>
                            </a>
                        </li>
                        <!-- 
                        <li>
                            <a href="#" class="">Services</a>
                        </li> -->
                    </ul>
                </div>

            </div>
        </nav>

        <!-- Modal qui permet de montrer les membres du projet et d'en ajouter d'autres -->
        <div v-if="showMembres" class="fixed inset-0 bg-gray-800 opacity-50 z-50"></div>
        <div v-if="showMembres == true" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-5 shadow rounded w-96">
                <h2 class="text-xl font-bold mb-4">Membres</h2>

                <div class="relative">
                    <Icons @click="removeModalMembres" name="close" class="absolute right-0 -top-12 cursor-pointer" />
                    <div class="flex gap-5">
                        <input class=" px-4 py-2 mb-2 border w-full border-gray-300 rounded" v-model="searchTerm"
                            type="search" placeholder="Rechercher un membre">
                        <button class="px-2 h-10 bg-blue-500 text-white rounded" @click="addMember()">Ajouter</button>
                    </div>
                    <ul class="absolute bg-white shadow-xl w-full">
                        <li class="cursor-pointer p-2 " v-if="filteredMembers.length > 0"
                            @click="selectMember(filteredMembers[0].id)">
                            {{ filteredMembers[0].name }}
                        </li>
                    </ul>
                    <ul>
                        <li class="cursor-pointer flex justify-between hover:bg-slate-300 p-2 rounded group"
                            v-for="membre, indexMember in membres" :key="indexMember">
                            {{ membre.name }}
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-red-800"
                                v-if="membre.role !== 'Chef de projet'" @click="deleteMember(membre.id)">Supprimer
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Modal qui permet de faire la creation de nouvelle colonne -->
        <div class="flex justify-center rounded-lg ">
            <button @click="showCreateInput"
                class="bg-gradient-to-r from-blue-500 to-blue-700 mb-4 text-white py-1 px-2 rounded flex items-center space-x-2 hover:bg-blue-600">
                <Icons name="plus" />
                <span>Nouvelle colonne</span>
            </button>
            <div v-if="showCreate" class="fixed inset-0 bg-gray-800 opacity-50 z-50"></div>
            <div v-if="showCreate" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl text-center font-bold mb-4">Ajouter une colonne</h3>
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


        <!-- Tableau Kanban -->
        <div class="flex  items-start space-x-2">

            <div v-for="(colonne, colonneIndex) in colonnes" :key="colonneIndex"
                class="flex-shrink-0 relative w-64 border bg-gray-100 rounded-lg p-4">

                <!-- Nom de la colonne -->

                <div class="flex border-b-2 border-blue-600 items-center mb-4 justify-between">
                    <h2 class="text-xl font-bold ">{{ colonne.titre }}</h2>
                    <Icons name="three" class="cursor-pointer"
                        @click="showDropdown[colonneIndex] = !showDropdown[colonneIndex]" />

                    <div v-if="showDropdown[colonneIndex]" ref="dropdown"
                        class="absolute block right-4 top-12 bg-slate-300 p-1 w-[10rem] rounded z-50">
                        <button @click="renameColonne(colonneIndex)"
                            class="hover:bg-slate-100 text-start w-full px-5 py-2">Renommer</button>
                        <button @click="deleteColonne(colonneIndex)"
                            class="hover:bg-slate-100 text-start w-full px-5 py-2">Supprimer</button>
                    </div>
                </div>

                <!-- Bouton d'ajout de tâches à la colonne -->
                <button @click="showCreateTache(colonneIndex)"
                    class="mb-4 w-full  bg-gradient-to-r from-blue-500 to-blue-700 text-white py-1 px-2 rounded flex items-center justify-center space-x-2 hover:bg-blue-600">
                    <Icons name="plus" />
                    <span>Nouvelle tâche</span>
                </button>

                <!-- Modal qui permet de créer de nouvelle tâches -->
                <div v-if="showTacheCreate[colonneIndex]" class="fixed inset-0 bg-gray-800 opacity-50 z-50"></div>
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
                                <option v-for="membre, index in membres" :key="index" :value="membre.id">{{ membre.name }}
                                </option>
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

                <div v-for="(tache, tacheIndex) in colonne.taches" :key="tache.id"
                    class="bg-white flex justify-between relative rounded-lg shadow-md p-4 mb-4">
                    <p class="text-gray-800">{{ tache.name }}</p>
                    <div class="group">
                        <Icons name="three" class="cursor-pointer opacity-0 group-hover:opacity-100"
                            @click="toggleTacheDropdown(colonneIndex, tacheIndex)" />
                        <div v-if="showTacheDropdown[colonneIndex][tacheIndex]" ref="dropdown[colonneIndex][tacheIndex]"
                            class="dropdown absolute block right-4 top-12 bg-slate-300 p-1 w-[10rem] rounded z-50">
                            <button @click="removeTache(tache.id)"
                                class="hover:bg-slate-100 text-start w-full px-5 py-2">Supprimer</button>
                        </div>
                    </div>
                </div>


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



        <div class="fixed right-5 bottom-4 flex flex-col gap-2">
            <div>

                <button @click="openConversationModal"
                    class="bg-gradient-to-r from-blue-500 to-blue-700  text-white px-4 py-2 rounded-md flex items-center gap-2">
                    <Icons name="conversation" />
                    <span>Conversation</span>
                </button>

                <div v-if="isConversationModalOpen"
                    class="fixed inset-0  bg-gray-900 bg-opacity-50 flex items-center justify-center ">
                    <div
                        class="bg-white rounded-lg p-4 mx-auto w-full  md:max-w-sm lg:max-w-5xl xl:max-w-6xl h-96">
                        <h2 class="text-xl font-bold mb-4">Boîte de messagerie</h2>
                        <div class="h-full bg-gray-100 rounded-lg overflow-y-auto">
                            <!-- Contenu de la boîte de messagerie -->
                            
                        </div>
                    </div>
                </div>


            </div>

            <button class="bg-teal-600 text-white px-4 py-2 rounded-md flex items-center gap-2">
                <Icons name="commentaire" />
                <span>Commentaire</span>
            </button>
        </div>

    </AuthenticatedLayout>
</template>
  
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Icons from '@/Components/Icons/Icons.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive, watch, computed, onBeforeUnmount } from 'vue';
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

const membres = ref(props.membres);

const colonnes = ref(props.colonnes);

const selectedCard = ref(null);
const newColumnTitle = ref('');

// Permet d'afficher le modale pour la conversation entre les membres du projet
const isConversationModalOpen = ref(false);

const openConversationModal = () => {
    isConversationModalOpen.value = true;
};

// Permet d'afficher les dropdown au niveau des colonne pour le renommage et la suppression 

const showDropdown = ref([]);

const closeDropdown = (event, colonneIndex) => {
    if (!event.target.closest('.dropdown') && showDropdown.value[colonneIndex]) {
        showDropdown.value[colonneIndex] = false;
    }
};

const dropdownRef = ref([]);

onMounted(() => {
    document.addEventListener('click', closeDropdown);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', closeDropdown);
});

const deleteColonne = (colonneIndex) => {
    const colonne_id = colonneIds.value[colonneIndex];
    axios.post(route('column.destroy', {
        colonne_id : colonne_id,
        projet_id : props.projet.id
    })).then(response => {
        colonnes.value = response.data;
    })

};

const renameColonne = (colonneIndex) => {
    // Logique de renommage de la colonne avec l'index donné
    const newTitre = prompt("Nouveau titre de la colonne");
    colonnes.value[colonneIndex].titre = newTitre;
};


let success = ref('');
let showMembres = ref(false);

const showModalMembres = () => {
    showMembres.value = true
}

const removeModalMembres = () => {
    showMembres.value = false
}

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
// Fonction permettant de d'ajouter une tâche dan sune colonne.
const addTask = (colonneIndex) => {
    const colonneId = colonneIds.value[colonneIndex];
    const newTaskName = newTaskNames.value[colonneIndex].trim();
    const newTaskDescription = newTaskDescriptions.value[colonneIndex].trim();
    const newTaskDeadline = newTaskDeadlines.value[colonneIndex].trim();
    const newTaskPriority = newTaskPriorities.value[colonneIndex].trim();
    const newTaskMember = newTaskMembers.value[colonneIndex];

    // Vérifiez si le nom de la nouvelle tâche n'est pas vide
    if (newTaskName !== '') {
        // Créez un objet représentant la nouvelle tâche avec toutes ses données
        const newTask = {
            name: newTaskName,
            description: newTaskDescription,
            projet_id: props.projet.id,
            member: newTaskMember,
            date_heure_livraison: newTaskDeadline,
            colonne_id: colonneId,
            priority: newTaskPriority,
            // Autres détails de la tâche
        };

        console.log(newTask);
        axios.post(route('tache.store', newTask))
            .then(response => {
                colonnes.value = response.data
                removeCreateTache(colonneIndex)
            })

        // Réinitialisez les champs d'ajout de tâche pour la colonne correspondante
        newTaskNames.value[colonneIndex] = '';
        newTaskDescriptions.value[colonneIndex] = '';
        newTaskDeadlines.value[colonneIndex] = '';
        newTaskPriorities.value[colonneIndex] = '';
        newTaskMembers.value[colonneIndex] = '';
    }
};

// État pour le suivi de l'affichage des menus déroulants des tâches
const showTacheDropdown = ref([]);

// Initialisation de l'état d'affichage des menus déroulants pour chaque tâche
for (const colonne of colonnes.value) {
    showTacheDropdown.value.push(Array(colonne.taches.length).fill(false));
}

// Fonction pour basculer l'affichage du menu déroulant pour une tâche
const toggleTacheDropdown = (colonneIndex, tacheIndex) => {
    showTacheDropdown.value[colonneIndex][tacheIndex] = !showTacheDropdown.value[colonneIndex][tacheIndex];
};

// Fonction pour supprimer une tâche
const removeTache = (id) => {
    console.log(id);;
    axios.post(route('tache.destroy', {
        projet_id: props.projet.id,
        id: id
    })).then(response => {
        colonnes.value = response.data;
    })
};


// Fonction qui permet d'ajouter une nouvelle colonne dans la base de donnée.

const addColumn = () => {
    const newColumnName = newColumnTitle.value.trim();

    if (newColumnName !== '') {

        console.log(newColumnTitle.value);
        axios.post(route('column.store', {
            projet_id: props.projet.id,
            titre: newColumnTitle.value
        })).then(response => {
            removeCreate()
            colonnes.value = response.data
        })

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
    axios.post(route('membre.store'), {
        idMembres: idMembres.value,
        projet_id: props.projet.id

    })
        .then((response) => {
            success.value = response.data.success;
            membres.value = response.data.membres;
            console.log(membres.value);

            searchTerm.value = ''
        })
        .catch((error) => {
            console.error(error);
        });
};


const deleteMember = (id) => {
    // Récupérer l'id et l'email du membre sélectionné
    axios.post(route('membre.delete'), {
        idMembres: id,
        projet_id: props.projet.id

    })
        .then((response) => {
            success.value = response.data.success;
            membres.value = response.data.membres;
            console.log(membres.value);
        })
        .catch((error) => {
            console.error(error);
        });
};



</script>
  
<style scoped></style>
  