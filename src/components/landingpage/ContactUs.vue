<template>
<div class="container-content">
        <h1>Our Contact Details</h1>
    <div class="content-text">
        <p>
            We love to hear from our customers! If you have any questions, concerns, or feedback, 
            please don’t hesitate to contact us. You can reach us through any of the following methods:
        </p>
    </div>

    <div class="contact-details">
        <h2 class="contact-number">Contact Number: <span>09XXXXXXXXX</span></h2>
        <h2 class="email">Email:<span> lorem@gmail.com</span></h2>   
    </div>

    <div class="center-form">
        <h1 class="text">STAY IN TOUCH</h1>
        <form class="contact-form">

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg></span>
                <input type="text" class="form-control" id="userName" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg></span>
                <input type="text" class="form-control" id="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg></span>
                <input type="text" class="form-control" id="subject" placeholder="Contact Number" aria-label="Contact" aria-describedby="basic-addon1">
            </div>

            <div class="input-group">
                <span class="input-group-text">Message</span>
                <textarea class="form-control" id="message" aria-label="With textarea"></textarea>
            </div>

            <div class="buttonSubmit"><button type="submit" placeholder="Send Message" @click="preventDefault">Send Message</button></div>
        </form> 
    </div>
</div>

    
</template>

<script>
import { preventDefault } from '@fullcalendar/core/internal';


export default{
    name: 'ContactUs',
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
    background-color:rgba(245, 245, 220, 0.92);
    width: 100%;
}

h1{
    text-align: center;
    font-weight: 600;
    padding-top: 11vh;
}

.content-text{
display: flex;
justify-content: center;
margin-top: 20px;
}

p{
    font-size: 16px;
    text-align: center;
    max-width: 50%;
}

.contact-details{
display: flex;
flex-direction: column;
align-items: center;
margin-top: 10vh;
}

h2{
    font-weight: 600;
    color: rgb(0, 66, 84);  
}

.contact-number{
    display: flex;
    align-items: end;
    
}

.email{
    display: flex;
    align-items: end;
    margin-left: 12.4%;
}
span{
    font-size: 22px;
    font-weight: 500;
    color: black;
    margin-left: 15px;
}

.center-form{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
   
}

.text{
    margin-top: -4vh;
}


.contact-form{
    display: flex;
    flex-direction: column;
    align-items: center;
}

form{
    width: 40%;
}

button{
    margin-top: 3vh;
    border: none;
    border-radius: 30px;
    height: 60px;
    width: 200px;
    background-color: aquamarine;
}

button:hover{
    background-color: rgb(62, 208, 159);
    transform: scale(1.1);
}
</style>