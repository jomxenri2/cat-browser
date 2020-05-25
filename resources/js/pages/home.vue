<template>
	<div class="Home">
		<div class="container">
		    <h1>Cat Browser</h1>
		    <!-- Start Cat Breed Dropdown Section -->
		    <div class="row" style="padding: 10px 0px;">
		    	<div class="col-md-3 col-sm-6 col-12">
		    		<div class="form-group">
		    			<label class="form-label" for="breed">Breed</label>
		    			<select id="breed" class="form-control" v-model="id_breed">
		    				<option value="">Select breed</option>
	                        <option 
	                        	v-for="data in breeds" 
	                        	:value="data.id">
	                        	{{ data.name }}
	                        </option>
	                    </select>
		    		</div>
		    	</div>
		    </div>
		    <!-- End Cat Breed Dropdown Section -->
		    <!-- Start Cat Image List Section -->
		    <div class="row">
		    	<div class="col-md-3 col-sm-6 col-12" v-for="data in cats">
		    		<div class="card">
		    			<img class="card-img-top" :src="data.url">
		    			<div class="card-body">
		    				<router-link class="btn btn-primary btn-block" :to="'/'+data.id">View details</router-link>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    <!-- End Cat Image List Section -->
		    <div class="row" v-if="id_breed == ''">
		    	<div class="col-12" style="margin-bottom: 20px;">No cats available</div>
		    </div>
		    <!-- Start Load More Button Section -->
		    <div class="row">
		    	<div class="col-md-3 col-sm-6 col-12">
		    		<button 
		    			v-if="!is_hidden" 
		    			:disabled='cats.length == 0' 
		    			@click="page++" 
		    			type="button" 
		    			class="btn btn-success">
		    			Load more
		    		</button>
		    	</div>
		    </div>
		    <!-- End Load More Button Section -->
		</div>
	</div>
</template>

<script>
    export default {
    	data() {
            return {
            	breeds: {},
            	id_breed: "",
            	cats: [],
            	page: 1,
            	is_hidden: false,
            }
        },
        created() {
            this.getBreeds();
        },
        methods: {
        	// Gets the breeds list for the dropdown selection
            getBreeds(){
                axios.get('https://api.thecatapi.com/v1/breeds')
                .then(response => {
                    this.breeds = response.data;

                    // checks if there is breed query in url
                	if(this.$route.query.breed != undefined)
                		this.id_breed = this.$route.query.breed;
                })
                .catch(err=>{
                    console.log("error", err);
                });	
            },
            // Gets the cat image list
            getCat(cat) {
				axios.get('https://api.thecatapi.com/v1/images/search?page='+ this.page +'&limit=10&breed_id='+cat)
                .then(response => {

                	let lengthCount = this.cats.length;

                	// Iterate each response data
                    for(let x = 0; x < response.data.length; x++)
                    	// If cat ID already exist, don't push to cats array
                    	if(this.cats.filter(c => { return c.id == response.data[x].id }).length == 0)
	                    	this.cats.push(response.data[x]);

	                // If previous count of cats list is the same as now, then hide Load more button
	                if(lengthCount == this.cats.length)
	                	this.is_hidden = true;

                })
                .catch(err=>{
                    console.log("error", err);
                });
	        }
        },
        watch: {
			id_breed: function(data) {
				// If dropdown is set to 'Select Breed' then clear cat list, else run getCat
				if(data == "") {
					this.cats = [];
					this.is_hidden = false;
				}
				else
					this.getCat(data);
			},
			page: function(data) {
				this.getCat(this.id_breed);
			}
		},
    }
</script>