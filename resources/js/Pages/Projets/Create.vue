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



</script>
<template>
    <AuthenticatedLayout>

        <Head title="Creation de projet" />
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

    

    </AuthenticatedLayout>
</template>


<style></style>
