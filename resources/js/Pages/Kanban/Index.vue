

<template>
    <AuthenticatedLayout>

        <Head title="Créer Kanban" />
        <div class="kanban-container flex space-x-4">

            <div v-for="(column, columnIndex) in columns" :key="columnIndex" class="kanban-column p-4">
                <h2 class="text-xl font-bold mb-4">{{ column.title }}</h2>
                <div class="kanban-card mb-2" v-for="(card, cardIndex) in column.cards" :key="cardIndex" draggable="true"
                    @dragstart="handleDragStart(columnIndex, cardIndex)" @dragover.prevent
                    @drop="handleDrop(columnIndex, cardIndex)">
                    <p>{{ card.title }}</p>
                </div>
                <div class="kanban-add-card">
                    <input v-model="newCardTitle" type="text" placeholder="Ajouter une tâche" class="border p-2 w-full"
                        @keydown.enter="addCard(columnIndex)" />
                </div>
            </div>
            <span class="cursor-pointer" @click="showCreateInput">
                Nouveau
            </span>
            <div v-if="showCreate == true" class="kanban-add-column p-4">
                <input v-model="newColumnTitle" type="text" placeholder="Ajouter une colonne" class="border p-2 w-full" />
                <button  @click="addColumn">Créer</button>
                <button  @click="removeCreate">Fermer</button>
            </div>

            <!-- Modal -->
            <div v-if="selectedCard" class="modal flex items-center justify-center">
                <div class="modal-content bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Modifier la tâche</h3>
                    <form @submit.prevent="updateTask">
                        <label for="title" class="mb-2">Titre</label>
                        <input type="text" v-model="selectedCard.title" required class="border p-2 w-full mb-4">

                        <label for="description" class="mb-2">Description</label>
                        <textarea v-model="selectedCard.description" class="border p-2 w-full mb-4"></textarea>

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

const columns = reactive([
    {
        title: 'À faire',
        cards: [
            { title: 'Tâche 1', description: 'Description de la tâche 1' },
            { title: 'Tâche 2', description: 'Description de la tâche 2' },
        ],
    },
    {
        title: 'En cours',
        cards: [
            { title: 'Tâche 3', description: 'Description de la tâche 3' },
            { title: 'Tâche 4', description: 'Description de la tâche 4' },
        ],
    },
    {
        title: 'Terminé',
        cards: [
            { title: 'Tâche 5', description: 'Description de la tâche 5' },
            { title: 'Tâche 6', description: 'Description de la tâche 6' },
        ],
    },
]);

const container = ref(null);
const selectedCard = ref(null);
const newCardTitle = ref('');
const newColumnTitle = ref('');

let showCreate = ref(false);


const showCreateInput = () => {
    showCreate.value = true;
    
};
const removeCreate = () => {
    showCreate.value = false;
    
};





const handleDragStart = (columnIndex, cardIndex) => {
    selectedCard.value = { ...columns[columnIndex].cards[cardIndex] };
};

const handleDrop = (columnIndex, cardIndex) => {
    const draggedCard = selectedCard.value;
    if (draggedCard) {
        columns[columnIndex].cards.splice(cardIndex, 0, draggedCard);
        if (selectedCard.columnIndex > columnIndex || (selectedCard.columnIndex === columnIndex && selectedCard.cardIndex > cardIndex)) {
            selectedCard.columnIndex += 1;
        }
        columns[selectedCard.columnIndex].cards.splice(selectedCard.cardIndex, 1);
        selectedCard.value = null;
    }
};

const addCard = (columnIndex) => {
    const newCard = { title: newCardTitle.value, description: '' };
    columns[columnIndex].cards.push(newCard);
    newCardTitle.value = '';
};

const addColumn = () => {
    console.log(newColumnTitle.value);
    axios.post(route('column.store', {
        column_name: newColumnTitle.value

    }))
    newColumnTitle.value = '';
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

</script>
  
<style scoped>
.kanban-container {
    width: 100%;
    overflow-x: auto;
}

.kanban-column {
    min-width: 300px;
}

.kanban-card {
    background-color: white;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 8px;
    cursor: grab;
}

.kanban-add-card,
.kanban-add-column {
    background-color: white;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 8px;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    border-radius: 4px;
    padding: 16px;
}
</style>
  