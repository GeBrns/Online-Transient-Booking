<template>
    <div class="container-content">
       
            <h1>About Laverdeh</h1>

        <div class="center-text">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Magni suscipit dicta soluta maiores provident aperiam fuga
             quaerat expedita, esse minima accusamus, ullam blanditiis quis 
             voluptate molestias repellat eveniet et voluptatum. Non dolore cumque
             fugiat accusamus fugit aliquam blanditiis harum explicabo eum, eos dolorum 
             facere corporis illo repellat ducimus consectetur mollitia.</p>
            </div>
    </div>
</template>

<script>

export default{
    name: 'About',
}

</script>

<style scoped>

*{
    padding: 0;
    margin: 0;
    color: beige;
    font-family: Arial, Helvetica, sans-serif;
   
}

.container-content{
    min-height: 100vh;
    background-color: rgba(0, 0, 0, 0.621);
    width: 100%;
}

h1{
    text-align: center;
    font-weight: 600;
    padding-top: 10vh;
}

.center-text{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 15vh;
}

p{
    width: 60%;
    font-size: 20px;
    text-align: center;
}

</style>