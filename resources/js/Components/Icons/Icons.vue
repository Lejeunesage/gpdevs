<template>
    <svg v-if="name === 'menubtn'"  xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 92 92" id="menu">
        <path
            d="M78 23.5H14c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5h64c3.6 0 6.5 2.9 6.5 6.5s-2.9 6.5-6.5 6.5zM84.5 46c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5zm0 29c0-3.6-2.9-6.5-6.5-6.5H14c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5h64c3.6 0 6.5-2.9 6.5-6.5z">
        </path>
    </svg>


    <svg v-else-if="name === 'closebtn'" xmlns="http://www.w3.org/2000/svg" width="50" height="30"
        viewBox="0 0 512 512" id="close">
        <path
            d="M437.5 386.6L306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z">
        </path>
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