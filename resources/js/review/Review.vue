<template>

    <div>
        <!-- <div class="row" v-if="error">An unknown error has occured, please try again later.</div> -->
        <success v-if="success">Your review has been saved.</success>
        <fatal-error v-else-if="error"></fatal-error>
        <div  class="row" v-else>
            <div :class="[{'col-md-4': twoColumns}, {'d-none': oneColumn}]">
                <div class="card">
                    <div class="card-body">
                        <div v-if="loading">Loading...</div>
                        <div v-if="hasBooking">
                            <p>Stayed at <router-link :to="{name: 'bookable', params: { id: booking.bookable.bookable_id }}">{{booking.bookable.title}}</router-link></p>
                            <p>From {{ booking.from }} to {{booking.to}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="[{'col-md-8': twoColumns}, {'col-md-12': oneColumn}]">
                <div v-if="loading">Loading...</div>
                <div v-else>
                    <div v-if="alreadyReviewed">
                        <h3>You've already reviewed this booking.</h3>
                    </div>
                    <div v-else>
                        <div class="form-group">
                            <label for="" class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                            <star-rating class="fa-2x" v-model="review.rating"></star-rating>
                        </div>
                        <div class="form-group">
                            <label for="content" class="text-muted">Describe your experience</label>
                            <textarea
                                name="content"
                                class="form-control"
                                cols="30"
                                rows="10"
                                v-model="review.content"
                                :class="[{'is-invalid': errorFor('content')}]">
                            </textarea>
                            <validation-errors :errors="errorFor('content')"></validation-errors>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" @click.prevent="submit" :disabled="submitting">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { is404, is422 } from './../shared/utils/response';
import validationErrors from './../shared/mixins/validationErrors'

export default {
    mixins: [validationErrors],
    data(){
        return{
            review:{
                id: null,
                rating: 5,
                content: null,
            },
            existingReview: null,
            loading: false,
            booking: null,
            error: false,
            submitting: false,
            success: false
        };
    },
    async created(){
        this.review.id = this.$route.params.id;
        this.loading = true;

        try{
            this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
        } catch(err){
            if(is404(err)){
                try{
                    this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                } catch(err){
                    this.error = !is404(err);
                }
            } else {
                this.error = true;
            }
        }

        this.loading = false;
    },
    computed: {
        alreadyReviewed(){
            return this.hadReview || !this.booking;
        },
        hasReview(){
            return this.existingReview != null;
        },
        hasBooking(){
            return this.booking != null;
        },
        oneColumn(){
            return !this.loading && this.alreadyReviewed;
        },
        twoColumns(){
            return this.loading || !this.alreadyReviewed
        }
    },
    methods: {
        submit(){
            this.errors = null;
            this.submitting = true;
            this.success = false;
            axios
                .post(`/api/reviews`, this.review)
                .then(response => this.success = 201 === response.status)
                .catch((err) => {
                    if(is422(err)){
                        const errors = err.response.data.errors;
                        if(errors["content"] && _.size(errors) === 1){
                            this.errors = errors;
                            return;
                        }
                    }
                    this.errors = true;
                })
                .then(() => this.submitting = false);
        }
    }
}
</script>

