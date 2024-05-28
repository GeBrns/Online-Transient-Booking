<template>
    <div class="container-content">
        <h1>Check out Laverdeh's Rooms</h1>

    <div class="cards">
        <router-link class="routerLink" to="/room1">
            <div class="room">
                <div class="room-photo">
                    <img src="/src/assets/img/laverdeh_room1.png" alt="Room 1">
                </div>
                <div class="room-text">
                    <span>Room 1</span>
                    <button>Book Now</button>
                </div>
            </div>
        </router-link>

            <div class="room">
                <div class="room-photo">
                    <img src="/src/assets/img/laverdeh_room2.png" alt="Room 2">
                </div>
                <div class="room-text">
                    <span>Room 2</span>
                    <button>Book Now</button>
                </div>
            </div>

            <div class="room">
                <div class="room-photo">
                    <img src="/src/assets/img/laverdeh_room3.png" alt="Room 3">
                </div>
            <div class="room-text">
                <span>Room 3</span>
                <button>Book Now</button>
            </div>
            </div>

            <div class="room">
                <div class="room-photo">
                    <img src="/src/assets/img/laverdeh_room4.png" alt="Room 4">
                </div>
            <div class="room-text">
                <span>Room 4</span>
                <button>Book Now</button>
            </div>
            </div>
    </div>
    </div>
    <router-view></router-view>
</template>

<script>

export default{
    name:'Room',
}

</script>

<style scoped>
*{
    padding: 0;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

.container-content{
    min-height: 100vh;
    background-color: black;
    width: 100%;
}

h1{
    text-align: center;
    font-weight: 600;
    padding-top: 10vh;
    color: beige;
}

.cards{
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center
}

.room{
    display: flex;
    flex-direction: column;
    margin-top: 10vh;
    margin-left: 2vw;
    background: white;
    height: 400px;
    width: 300px;
    border-radius: 20px;
    align-items: start;
    justify-content: center;
}

.room img{
    max-height: 300px;
    border-radius: 5px;
    width: 300px;
}

.room:hover{
    transform: scale(1.01);
    cursor: pointer;
}
.room-text{
    margin-top: 10px;
    margin-left: 5px;
    
}
span{
    font-weight: 600;
    font-size: 20px;
}

button{
    background-color: aquamarine;
    border-radius: 20px;
    height: 40px;
    width: 100px;
    border: none;
    margin-left: 100px;
    font-weight: 600;
}

button:hover{
    transform: scale(1.1);
    cursor: pointer;
}

.routerLink{
    text-decoration: none;
    color: black;
}


</style>