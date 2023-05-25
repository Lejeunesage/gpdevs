<template>
    <svg v-if="name === 'menubtn'" xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 92 92" id="menu">
        <path
            d="M78 23.5H14c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5h64c3.6 0 6.5 2.9 6.5 6.5s-2.9 6.5-6.5 6.5zM84.5 46c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5zm0 29c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5z">
        </path>
    </svg>


    <svg v-else-if="name === 'closebtn'" xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 512 512"
        id="close">
        <path
            d="M437.5 386.6L306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z">
        </path>
    </svg>

    <svg v-else-if="name === 'userIcon'" width="40" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 32 32"
        viewBox="0 0 32 32" id="user">
        <path
            d="M16,0.5C7.45001,0.5,0.5,7.45001,0.5,16S7.45001,31.5,16,31.5S31.5,24.54999,31.5,16S24.54999,0.5,16,0.5z M26.54999,22.67999C24.39001,19.59998,20.44,17.64001,16,17.64001s-8.40002,1.95996-10.53998,5.06C4.22998,20.76001,3.5,18.45996,3.5,16C3.5,9.10999,9.10999,3.5,16,3.5S28.5,9.10999,28.5,16C28.5,18.45996,27.78003,20.75,26.54999,22.67999z">
        </path>
        <circle cx="16" cy="11" r="4.97"></circle>
    </svg>

    <svg v-else-if="name === 'sideMenu'" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>

    <svg v-else-if="name === 'kamban'" aria-hidden="true"
        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
        </path>
    </svg>


    <svg v-else-if="name === 'add'" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 32 32" viewBox="0 0 32 32"
        id="add" fill="currentColor"
        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
        <path
            d="M2.4375,17.9375h11.625v11.625c0,1.06854,0.86896,1.9375,1.9375,1.9375s1.9375-0.86896,1.9375-1.9375v-11.625h11.625c1.06854,0,1.9375-0.86896,1.9375-1.9375s-0.86896-1.9375-1.9375-1.9375h-11.625V2.4375C17.9375,1.36896,17.06854,0.5,16,0.5s-1.9375,0.86896-1.9375,1.9375v11.625H2.4375C1.36896,14.0625,0.5,14.93146,0.5,16S1.36896,17.9375,2.4375,17.9375z">
        </path>
    </svg>
    <svg v-else-if="name === 'diagramm'" aria-hidden="true"
        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
    </svg>

    <svg v-else-if="name === 'info'" aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
            clip-rule="evenodd"></path>
    </svg>
</template>

<script setup>
const props = defineProps({
    name: String,
})


function closeWindows() {
    const getBtnClose = document.getElementById('btn_close');
    console.log(getBtnClose);
    getBtnClose.addEventListener('click', function (event) {
        window.open('', '_self').close();
        console.log('fenêtre fermée');
    })

}

function endCall() {

}
</script>

<style></style>