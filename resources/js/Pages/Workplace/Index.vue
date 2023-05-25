<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3'


let props = defineProps({
    equipes: {
        type: Array,
        default: () => ({}),
    },
});

</script>
<template>
    <AuthenticatedLayout>

        <Head title="Espace de travail" />
        <!-- Votre template HTML -->
        <div>
            <div v-if="successMessage" class="alert alert-success">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage" class="alert alert-danger">
                {{ errorMessage }}
            </div>
        </div>

        <div class="container mx-auto px-4">
            <h1 class="text-xl font-bold mb-6">Liste des équipes dont <br/>vous êtes membre</h1>

            <!-- Boucle pour afficher chaque équipe -->
            <div v-for="equipe, index in props.equipes" :key="index" class="mb-2 cursor-pointer">
                <h1 class="text-xl font-semibold text-[#0c7187]">{{ equipe.nom }}</h1>
                <p>Rôle : {{ equipe.role }}</p>
                <p>Créer le : {{ equipe.created_at }}</p>
            </div>
            <!-- Fin de la boucle -->


        </div>


    </AuthenticatedLayout>
</template>


<style></style>
