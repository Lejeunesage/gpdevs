<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3'


let props = defineProps({
    projets: {
        type: Array,
        default: () => ({}),
    },

    taches: {
        type: Array,
        default: () => ({}),
    },
});


const viewProject = (projectId) => {
  console.log(projectId);
  router.get(route('projet.show',projectId))
};

const viewTask = (taskId) => {
  // Code pour naviguer vers la vue détaillée de la tâche avec l'ID taskId
};



</script>
<template>
    <AuthenticatedLayout>

        <Head title="Tableau de bord" />
        <!-- Votre template HTML -->
        <div>
            <div v-if="successMessage" class="alert alert-success">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage" class="alert alert-danger">
                {{ errorMessage }}
            </div>
        </div>



        <h1 class="text-2xl font-bold mb-4">Tableau de bord</h1>
        <div class="flex">
            <div class="w-1/2 p-4 border">

                <section>
                    <h2 class="text-xl font-bold mb-2">Projets en cours</h2>
                    <div v-if="props.projets.length === 0" class="text-gray-500">Aucun projet en cours.</div>
                    <ul v-else>
                        <li v-for="project in props.projets" :key="project.id"
                            class="border border-gray-200 rounded p-2 mb-4 bg-slate-300">
                            <h3 class="text-xl font-semibold  text-[#0c7187]">{{ project.name }}</h3>
                            <div class="text-sm  text-gray-600 pb-1"> {{ project.progress }}
                                <div class="w-full  bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div
                                        class="bg-slate-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: 75%"> 75%</div>
                                </div>
                            </div>


                            <p class="text-sm">Créer le : {{ project.created_at }}</p>
                            <p class="text-sm"> {{ project.role }}</p>

                            <button @click="viewProject(project.id)"
                                class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Voir le projet</button>
                        </li>
                    </ul>
                </section>

            </div>

            <div class="w-1/2 p-4 border">
                <section>
                    <h2 class="text-xl font-bold mb-2">Tâches en cours</h2>
                    <div v-if="props.taches.length === 0" class="text-gray-500">Aucune tâche en cours.</div>
                    <ul v-else>
                        <li v-for="task in props.taches" :key="task.id"
                            class="border border-gray-200  bg-slate-300 rounded p-2 mb-4">
                            <h2 class="text-lg font-semibold  text-[#0c7187]">{{ task.name }}</h2>
                            <h3 class="text-sm font-semibold">Projet: {{ task.nomProjet }}</h3>
                            <p class="text-sm text-gray-600 truncate">{{ task.description }}</p>
                            <p class="text-sm">
                                <span class="text-blue-500">Echéance :</span> {{ task.date_heure_livraison }}
                            </p>
                            <button @click="viewTask(task.id)" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Voir la
                                tâche</button>
                        </li>
                    </ul>
                </section>


            </div>
        </div>


    </AuthenticatedLayout>
</template>


<style></style>
