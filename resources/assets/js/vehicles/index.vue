<template>
	<div>
		<card>
			<h4 slot="title" class="text-info">The Registered Vehicles</h4>
			<search-selector label="Find A vehicle" :hasDropDown="false" end-point="/vehicles" 
			@results="searched=$event" @unSelected="searched=[]"
			>

		</search-selector>	
	</card>	

	<animation-list>
		<div v-for="vehicle in vehicles" :key="vehicle.vehicle_id">
			<vehicle :vehicle="vehicle" :readonly="false"></vehicle>
		</div>
	</animation-list>
</div>
</template>

<script>
	import vehicle from "./vehicle";

	export default
	{
		components:{vehicle},

		created()
		{
			this.fetchInitial();
			events.$on("vehicle:deleted",removed=>this.fetchInitial());

			events.$on("vehicle:created",vehicle=>this.initial.push(vehicle));
		},

		data(){
			return {

				initial:[],
				searched:[],
			}
		},
		methods:{
			fetchInitial()
			{
				axios.get("/vehicles").then(({data})=>this.initial=data);
			}
			
		},
		computed:{

			vehicles()
			{
				return this.searched.length>0?this.searched: this.initial;
			}
		}

	}
</script>
