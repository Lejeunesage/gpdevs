<script setup>
import { ref, computed, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Icons from '@/Components/Icons/Icons.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';


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
        'top-0': !isSidebarOpen.value,
        'left-0': false,
        'z-40': true,
        'sm:w-64': true,
        'h-screen': true,
        'pt-20': true,
        'transition-transform': true,
        '-translate-x-full': !isSidebarOpen.value,
        'bg-white': true,
        'border-r': true,
        'border-gray-200': true,
        'sm:translate-x-0': isSidebarOpen.value,
        'dark:bg-gray-800': true,
        'dark:border-gray-700': true
    };
});



</script>


<template>
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

        <div>
            <button type="button" @click="toggleUserDropdown"
                class="bg-blue-200 flex items-center justify-center border w-[2.5rem]  h-[2.5rem] mr-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                <span class="font-bold text-xl" >{{ $page.props.auth.user.name[0] }}</span>
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
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Tableau
                        de bord</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Paramètres</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mode
                        sombre</a>
                </li>

                <li>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Déconnexion</a>
                </li>
            </ul>
        </div>


    </nav>

    <aside id="logo-sidebar" :class="sidebarClasses" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg aria-hidden="true"
                            class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3 hidden sm:flex">Espace de travail</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap hidden sm:flex">Kanban</span>
                        <span
                            class="inline-flex hidden sm:flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>


    <!-- Page Content -->
    <main>
        <slot />
    </main>
</template>