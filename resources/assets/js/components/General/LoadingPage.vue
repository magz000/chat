<template>
    <div class="__loading-cont">

        <div class="">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <br>
            Loading ...
        </div>

    </div>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>
.__loading-cont {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #3490dc;
}
//
// span {
//     display: block;
// }

.lds-ring {
    display: block;
    position: relative;
    width: 50px;
    height: 50px;
    padding: 5px;
}
.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 50px;
    height: 50px;
    margin: 0px;
    border: 3px solid #3490dc;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #3490dc transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}
@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}


</style>
