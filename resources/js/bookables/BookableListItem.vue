<template>
    <div>
        <h1>{{ title }}</h1>
        <p>{{ content }}</p>
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
        console.log('list item created');
    },
}
</script>
