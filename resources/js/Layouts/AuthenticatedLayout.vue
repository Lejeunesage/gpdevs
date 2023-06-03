<script setup>
import { ref, computed, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Icons from '@/Components/Icons/Icons.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';


const showUserDropdown = ref(false);

function toggleUserDropdown() {
    showUserDropdown.value = !showUserDropdown.value;
}

const isSidebarOpen = ref(true);

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const sidebarClasses = computed(() => {
    return {
        'fixed': true,
        'top-0': true,
        'left-0': false,
        'z-40': true,
        'sm:w-25': !isSidebarOpen.value ,
        'h-screen': true,
        'pt-20': true,
        'transition-transform': true,
        '-translate-x-full': false,
        'bg-white': true,
        'border-r': true,
        'border-gray-200': true,
        'sm:translate-x-0': true,
        'dark:bg-gray-800': true,
        'dark:border-gray-700': true
    };
});

const move = computed(() => {
    return {
        'p-4': true,
        'ml-[15rem]': true,
        'sm:ml-[5rem]': !isSidebarOpen.value ,
    };
});



const isClicked = ref(false);

const toggleClicked = () => {
    isClicked.value = !isClicked.value;
};

const projets = ref([]);
const showProjects = () => {
    axios.get(route('layout.index')).then(response => {
        projets.value = response.data;
    });
}


showProjects()
</script>


<template>
    <body>

        <nav
            class="fixed top-0 z-50 w-full flex justify-between p-4 bg-white border-b shadow-md border-gray-200 dark:bg-gray-800 dark:border-gray-700 ">
            <div class="flex gap-1">
                <button @click="toggleSidebar"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 avatar">
                    <span class="sr-only">Open sidebar</span>
                    <Icons name="sideMenu" />
                    {{ initials }}
                </button>

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                    <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                    </Link>
                </div>
            </div>

            <div class="flex justify-center items-center gap-5">
                <Icons name="notification" />
                <button type="button" @click="toggleUserDropdown"
                    class="bg-blue-200 flex items-center justify-center border w-[2.5rem]  h-[2.5rem] mr-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                    <span class="font-bold text-xl text-[#0c7187]">{{ $page.props.auth.user.name[0] }}</span>
                    <!-- <Icons name="userIcon" /> -->

                </button>
            </div>


            <!-- Dropdown menu -->
            <div v-if="showUserDropdown"
                class="z-50 absolute top-[4rem] right-2 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                id="user-dropdown">
                <div class="px-4 py-3">
                    <span ref="nameSpan" class="block text-sm text-gray-900  dark:text-white">{{ $page.props.auth.user.name
                    }}</span>
                    <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ $page.props.auth.user.email
                    }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">


                    <li>
                        <NavLink :href="route('dashboard')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Tableau
                            de bord</NavLink>
                    </li>
                    <li>
                        <NavLink href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Paramètres</NavLink>
                    </li>
                    <li>
                        <NavLink href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Mode
                            sombre</NavLink>
                    </li>

                    <li>
                        <NavLink :href="route('logout')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Déconnexion</NavLink>
                    </li>
                </ul>
            </div>


        </nav>

        <aside id="logo-sidebar" :class="sidebarClasses" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 ">
                <ul class="space-y-2 font-medium mb-4">

                    <li>
                        <NavLink :href="route('projet.create')" :active="route().current('projet.create')"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white"
                            :class="{ 'bg-gray-200': isClicked }" @click="isClicked = !isClicked">
                            <Icons name="add" />
                            <span v-if="isSidebarOpen" class="ml-3 hidden sm:flex">Créer nouveau projet</span>
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white"
                            :class="{ 'bg-gray-200': isClicked }" @click="isClicked = !isClicked">
                            <Icons name="diagramm" />
                            <span v-if="isSidebarOpen" class="ml-3 hidden sm:flex">Tableau de bord</span>
                        </NavLink>
                    </li>
                </ul>


                <ul class="border-t-2 mt-4 ">
                    <li v-for="projet, index in projets" :key="index">
                        <NavLink :href="route('projet.show', projet.id)" :active="route().current('projet.show',projet.id)"
                            class="flex items-center p-2 my-2 truncate text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="border w-8 h-8 bg-teal-600 text-white flex justify-center items-center">{{ projet.name[0] }}</span>


                            <span v-if="isSidebarOpen" class="flex-1 ml-3 whitespace-nowrap hidden sm:flex">{{ projet.name }}</span>
                           
                        </NavLink>
                    </li>
                </ul>
            </div>

        </aside>


        <!-- Page Content -->
        <div  :class="move">
            <div class="p-4 border-gray-200 rounded-lg mt-14 ">
                <slot />
            </div>
        </div>
    </body>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Roboto:wght@300;400;700&display=swap');

body {

    font-family: 'Nunito', sans-serif;
}
</style>
