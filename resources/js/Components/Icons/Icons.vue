<template>
    <svg v-if="name === 'menubtn'" xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 92 92" id="menu">
        <path
            d="M78 23.5H14c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5h64c3.6 0 6.5 2.9 6.5 6.5s-2.9 6.5-6.5 6.5zM84.5 46c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5zm0 29c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5z">
        </path>
    </svg>


    <svg v-else-if="name === 'delete'" width="20" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 64 64"
        viewBox="0 0 64 64" id="delete">
        <g transform="translate(232 228)">
            <path fill="#134563"
                d="M-207.5-205.1h3v24h-3zM-201.5-205.1h3v24h-3zM-195.5-205.1h3v24h-3zM-219.5-214.1h39v3h-39z"></path>
            <path fill="#134563"
                d="M-192.6-212.6h-2.8v-3c0-.9-.7-1.6-1.6-1.6h-6c-.9 0-1.6.7-1.6 1.6v3h-2.8v-3c0-2.4 2-4.4 4.4-4.4h6c2.4 0 4.4 2 4.4 4.4v3">
            </path>
            <path fill="#134563"
                d="M-191-172.1h-18c-2.4 0-4.5-2-4.7-4.4l-2.8-36 3-.2 2.8 36c.1.9.9 1.6 1.7 1.6h18c.9 0 1.7-.8 1.7-1.6l2.8-36 3 .2-2.8 36c-.2 2.5-2.3 4.4-4.7 4.4">
            </path>
        </g>
    </svg>



    <svg v-else-if="name === 'reload'" width="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="reload">
        <path
            d="M12 4a8 8 0 0 1 4.985 1.758H15.242a1 1 0 0 0 0 2h4a1 1 0 0 0 1-1v-4a1 1 0 1 0-2 0V4.206A9.983 9.983 0 0 0 2 12a1 1 0 0 0 2 0A8.009 8.009 0 0 1 12 4zM21 11a1 1 0 0 0-1 1A7.986 7.986 0 0 1 7.015 18.242H8.757a1 1 0 1 0 0-2h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V19.794A9.984 9.984 0 0 0 22 12 1 1 0 0 0 21 11z">
        </path>
    </svg>



    <svg v-else-if="name === 'image'" aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
            clip-rule="evenodd"></path>
    </svg>

    <svg v-else-if="name === 'emojie'" aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
            clip-rule="evenodd"></path>
    </svg>

    <svg v-else-if="name === 'send'" aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
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

    <svg v-else-if="name === 'conversation'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
        <path
            d="M21 23a.5.5 0 01-.34-.14l-3.6-2.6a.5.5 0 00-.65.04l-1.9 1.51A2.15 2.15 0 0113 21H3a2.16 2.16 0 01-2-2V3a2.16 2.16 0 012-2h14a2.16 2.16 0 012 2v16a2.16 2.16 0 01-2 2zM8 11h8m-8 4h6m-6-8h6m-6 12h8" />
    </svg>

    <svg v-else-if="name === 'commentaire'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
        <path
            d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16zm0-6a1 1 0 100-2 1 1 0 000 2zm0-4a1 1 0 100-2 1 1 0 000 2z" />
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
    <svg v-else-if="name === 'notification'" width="30" fill="#0c7187" xmlns="http://www.w3.org/2000/svg"
        data-name="Layer 1" viewBox="0 0 32 32" id="notification">
        <path
            d="M26.59 21.17a2 2 0 0 1-.59-1.41V14a10 10 0 0 0-7.64-9.71 2.47 2.47 0 0 0 .14-.79 2.5 2.5 0 0 0-5 0 2.47 2.47 0 0 0 .14.79A10 10 0 0 0 6 14v5.76a2 2 0 0 1-.59 1.41A4.79 4.79 0 0 0 4 24.59V25a2 2 0 0 0 2 2h7.18a3 3 0 0 0-.18 1 3 3 0 0 0 6 0 3 3 0 0 0-.18-1H26a2 2 0 0 0 2-2v-.41a4.79 4.79 0 0 0-1.41-3.42ZM15.5 3.5a.5.5 0 1 1 .5.5.5.5 0 0 1-.5-.5Z">
        </path>
    </svg>


    <svg v-else-if="name === 'dropdown'" width="20" xmlns="http://www.w3.org/2000/svg" id="arrow" x="0" y="0" version="1.1"
        viewBox="0 0 29 29" xml:space="preserve">
        <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
            stroke-width="2" d="m20.5 11.5-6 6-6-6"></path>
    </svg>


    <svg v-else-if="name === 'videocall'" width="30" fill="white" xmlns="http://www.w3.org/2000/svg"
        enable-background="new 0 0 64 64" viewBox="0 0 64 64" id="video-call">
        <path
            d="M42 19H30c0 9.37-7.63 17-17 17-2.11 0-4.13-.39-6-1.09V52c0 2.76 2.24 5 5 5h30c2.76 0 5-2.24 5-5V24C47 21.24 44.76 19 42 19zM31 53h-8c-1.1 0-2-.9-2-2s.9-2 2-2h8c1.1 0 2 .9 2 2S32.1 53 31 53zM62.96 20.24c-.65-.35-1.43-.32-2.05.08L51 26.73v22.54l9.91 6.41C61.24 55.89 61.62 56 62 56c.33 0 .66-.08.96-.24C63.6 55.41 64 54.73 64 54V22C64 21.27 63.6 20.59 62.96 20.24z">
        </path>
        <path
            d="M4 19c0-4.96 4.04-9 9-9s9 4.04 9 9c0 .41-.04.81-.09 1.2 1.24 1.02 2.31 2.26 3.14 3.67C25.67 22.36 26 20.72 26 19c0-7.18-5.82-13-13-13S0 11.82 0 19c0 1.72.33 3.36.95 4.87.83-1.41 1.9-2.65 3.14-3.67C4.04 19.81 4 19.41 4 19zM37.02 15c1.105 0 2-.896 2-2s-.895-2-2-2h-.01c-1.104 0-1.995.896-1.995 2S35.915 15 37.02 15zM45.02 11h-.01c-1.104 0-1.995.896-1.995 2s.9 2 2.005 2c1.105 0 2-.896 2-2S46.125 11 45.02 11z">
        </path>
        <path
            d="M22.49,27.86c-0.879-2.671-2.865-4.842-5.41-5.984C17.655,21.062,18,20.073,18,19c0-2.761-2.239-5-5-5s-5,2.239-5,5
			c0,1.073,0.345,2.062,0.92,2.876c-2.545,1.142-4.531,3.313-5.41,5.984C5.86,30.41,9.24,32,13,32S20.14,30.41,22.49,27.86z">
        </path>
    </svg>

    <svg v-else-if="name === 'three'" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="menu">
        <circle cx="12" cy="12" r="2" fill="#6563ff"></circle>
        <circle cx="5" cy="12" r="2" fill="#6563ff"></circle>
        <circle cx="19" cy="12" r="2" fill="#6563ff"></circle>
    </svg>


    <svg v-else-if="name === 'close'" width="25" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
        viewBox="0 0 24 24" id="close">
        <path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M15.7,14.3c0.4,0.4,0.4,1,0,1.4c-0.4,0.4-1,0.4-1.4,0
	L12,13.4l-2.3,2.3c-0.4,0.4-1,0.4-1.4,0c-0.4-0.4-0.4-1,0-1.4l2.3-2.3L8.3,9.7c-0.4-0.4-0.4-1,0-1.4c0.4-0.4,1-0.4,1.4,0l2.3,2.3
	l2.3-2.3c0.4-0.4,1-0.4,1.4,0c0.4,0.4,0.4,1,0,1.4L13.4,12L15.7,14.3z"></path>
    </svg>

    <svg v-else-if="name === 'plus'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
        </path>
    </svg>

    <svg v-else-if="name === 'diagramm'" aria-hidden="true"
        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
    </svg>

    <svg v-else-if="name === 'info'" aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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