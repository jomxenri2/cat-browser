<template>
    <div class="Cat">
    	<div class="container">
            <h5 v-if="!catData.url">Loading...</h5>
    		<div class="card" v-else>
    			<div class="card-header">
    				<router-link class="btn btn-primary" :to="'/?breed=' + catData.breeds[0].id">Back</router-link>
    			</div>
    			<img class="card-img" :src="catData.url">
    			<div class="card-body">
    				<h4>{{ catData.breeds[0].name }}</h4>
    				<h5>Origin: {{ catData.breeds[0].origin }}</h5>
    				<h6>{{ catData.breeds[0].temperament }}</h6>
    				<p>{{ catData.breeds[0].description }}</p>
    			</div>
    		</div>
    	</div>
    </div>
</template>
<script>
    export default {
        props: ['id'],
        data() {
            return {
            	catData: {},
            }
        },
        created() {
            this.getDetails();
        },
        methods: {
            // Gets the cat details
            getDetails() {
                axios.get('https://api.thecatapi.com/v1/images/' + this.id)
                .then(response => {
                    this.catData = response.data;
                })
                .catch(err=>{
                    console.log("error", err);
                });
            },
        }
    }
</script>