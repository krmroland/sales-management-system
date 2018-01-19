<template>
	<div>
		<p class="font-italic text-info h5">
			Please try matching a  vehicle plate number before creatin a new one
		</p>
		<VueForm :fields="fields" action="/vehicles" @submitted="vehicleCreated">
			
		</VueForm>
	</div>
</template>

<script>
	import VueForm from "../forms/VueForm";

	import structure from "./structure";

	export default
	{
		
		components:{VueForm},

		data(){
			return {
				showModal:true,
				fields: (new structure()).plain()
			}
		},
		methods:{
			vehicleCreated(vehicle)
			{
				events.$emit("vehicle:created",vehicle);
				this.$emit("submitted",vehicle);

				flash("Vehicle registration was succesfull");
			}
		}

	}
</script>
