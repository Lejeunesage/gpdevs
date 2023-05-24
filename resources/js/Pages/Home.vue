<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Icons from '@/Components/Icons/Icons.vue'
import Hero from '@/Components/Home/Hero.vue'
import Teams from '@/Components/Home/Teams.vue'
import Pricing from '@/Components/Home/Pricing.vue'
import Temoignage from '@/Components/Home/Temoignage.vue'
import Action from '@/Components/Home/Action.vue';
import Contact from '@/Components/Home/Contact.vue'
import Footer from '@/Components/Home/Footer.vue'


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

    <nav class="shadow-lg z-99 fixed top-0 left-0 right-0 bg-white ">
        <div class="container mx-auto relative flex justify-between items-center px-5 md:px-0 h-20">
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
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="bg-black hover:bg-slate-900 text-white py-2 px-3 rounded-full ">Accéder à vos projets</Link>

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
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="">Accéder à vos projets</Link>

                    <template v-else>
                        <div  class="flex flex-col  gap-5 items-center">

                            <Link :href="route('login')" class="ml-3">Connexion</Link>
                            
                            <Link v-if="canRegister" :href="route('register')" class="ml-4 ">Inscription</Link>
                        </div>
                        </template>
                </div>
            </div>
            <div class="lg:hidden">
                <Icons name="menubtn" @click="showMenu" v-if="showClosebtn == false" />
                <Icons name="closebtn" @click="closeMenu" v-if="showMenubtn == false" />
            </div>

        </div>
    </nav>

    <Hero />
    <Pricing />
    <Temoignage />
    <Teams />
    <Action />
    <Contact />
    <Footer />
</template>

<style></style>
