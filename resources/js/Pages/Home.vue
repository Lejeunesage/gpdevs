<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Icons from '@/Components/Icons/Icons.vue'
import Hero from '@/Components/Home/Hero.vue'
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});


const menuVisible = ref(false);
const showClosebtn = ref(false);
const showMenubtn = ref(true);

const showMenu = () => {
    menuVisible.value = !menuVisible.value
    showClosebtn.value = true;
    showMenubtn.value = false;
}

const closeMenu = () => {
    menuVisible.value = !menuVisible.value
    showClosebtn.value = false;
    showMenubtn.value = true;
}
</script>

<template>
    <Head title="Home" />


    <nav class="relative shadow-lg flex justify-between items-center px-10 h-20">
        <div>
            <Link href="/">
            <ApplicationLogo class="" />
            </Link>
        </div>


        <div class="hidden lg:flex">
            <ul class="flex justify-center  gap-5">
                <li><a href="#">Acceuil</a></li>
                <li><a href="#">Documentation</a></li>
                <li><a href="#">Teams</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Tarifs</a></li>
            </ul>
        </div>

        <div v-if="canLogin" class="hidden lg:flex">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="">Commencer</Link>

            <template v-else>
                <Link :href="route('login')" class="">Connexion</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 ">Inscription</Link>
            </template>
        </div>


        <!-- Ceci est le code qui gère l'affichache de la nav en responsive -->

        <div v-if="menuVisible"
            class="absolute lg:hidden border shadow-md rounded-lg left-10 top-[5.2rem] right-10 bg-white  flex flex-col  items-center gap-5 py-5">
            <div>
                <ul class="flex flex-col justify-center items-center gap-5">
                    <li><a href="#">Acceuil</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Teams</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Tarifs</a></li>
                </ul>
            </div>

            <div v-if="canLogin" class="">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="">Commencer</Link>

                <template v-else>
                    <Link :href="route('login')" class="">Connexion</Link>

                    <Link v-if="canRegister" :href="route('register')" class="ml-4 ">Inscription</Link>
                </template>
            </div>
        </div>
        <div class="lg:hidden">
            <Icons name="menubtn" @click="showMenu" v-if="showClosebtn == false" />
            <Icons name="closebtn" @click="closeMenu" v-if="showMenubtn == false" />
        </div>
    </nav>

    <Hero/>
</template>

<style></style>
