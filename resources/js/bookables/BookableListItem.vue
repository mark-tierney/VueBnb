<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">{{ content }}</p>
            <p>${{ price }}</p>
        </div>

    </div>
</template>

<script>
export default {
    // props: ['title', 'content', 'price']
    props: { //use prop object to obtain correct data type
        title: String,
        content: String,
        price: Number
    },
    created(){ //use created lifecycle hook to ensure data from server is available asap
        //console.log('list item created');
    },
}
</script>
