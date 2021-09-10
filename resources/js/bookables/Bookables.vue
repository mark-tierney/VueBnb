<template>
    <div>
        <bookable-list-item :title="bookable1.title" :content="bookable1.content" :price="1000"></bookable-list-item>
        <bookable-list-item :title="bookable2.title" :content="bookable2.content" :price="2000"></bookable-list-item>
        <bookable-list-item title="Sorta Cheap Villa" content="A sorta cheap villa." :price="3000"></bookable-list-item>
    </div>
</template>

<script>
import BookableListItem from "./BookableListItem"

export default {
    components: {
        BookableListItem
    },
    data(){
        return{
            //REACTIVE: vue will watch for changes to these
            bookable1: {
                title: "Very Cheap Villa",
                content: "A very cheap villa."
            },
            bookable2: {
                title: "Cheap Villa",
                content: "A cheap villa."
            }
        }
    },
    created(){
        console.log('bookables created');

        setTimeout(() => {
            this.bookable1.title = "Changed title";
        }, 5000);
    }
}
</script>
