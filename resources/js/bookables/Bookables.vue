<template>
    <div>
        <div v-if="loading">Data is loading...</div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <bookable-list-item
                        :title="bookable.title"
                        :content="bookable.content"
                        :price="bookable.price"
                    ></bookable-list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
            </div>

        </div>
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
            bookables: null,
            loading: false,
            columns: 3
        }
    },
    computed: {
        rows(){
            return !this.bookables ? 0 : Math.ceil(this.bookables.length / this.columns);
        }
    },
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },
        placeholdersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    created(){
        this.loading = true;
        setTimeout(() => {
            this.bookables = [{
                title: "Very Cheap Villa",
                content: "A very cheap villa.",
                price: 1000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            },
            {
                title: "Cheap Villa",
                content: "A cheap villa.",
                price: 2000
            }];
            this.loading = false;
        }, 1000);
    }
}
</script>
