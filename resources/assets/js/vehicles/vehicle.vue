<template>
	<card>
	<div class="btn-group d-flex justify-content-end mb-2" v-if="!readonly">
		<a class="btn btn-outline-primary" :href="url">
			<i class="fa fa-external-link-square"></i>
			Details
		</a>
		<button class="btn btn-outline-primary" @click="isEditing=true">
			<i class="fa fa-external-link-square"></i>
			Edit
		</button>
		<button type="button" class="btn btn-outline-danger" @click="destroy">
			<i class="fa fa-trash-o"></i>
			Delete
		</button>
	</div>
	<div class="d-flex justify-content-between align-items-center text-center box">
		<div>
			<i class="fa fa-3x":class="'fa-'+vehicleCopy.icon"></i>
		</div>
		<div>
			<p class="h6 text-info">Owner</p>
			<p class="h5">{{vehicleCopy.owner}}</p>
		</div>
		<div>
			<p class="h6 text-info">National Id (NIN)</p>
			<p class="h5">{{vehicleCopy.national_id}}</p>
		</div>
		<div>
			<p class="h6 text-info">Number Plate</p>
			<p class="h5">{{vehicleCopy.numberPlate}}</p>
		</div>

		<div>
			<p class="h6 text-info">Contanct</p>
			<p class="h5">{{vehicleCopy.phoneNumber}}</p>
		</div>
		<div>
			<p class="h6 text-info">Parking Fee</p>
			<p class="h5">{{vehicleCopy.fee|currency}}</p>
		</div>
		<div>
			<p class="h6 text-info">Account Balance</p>
			<p class="h5">{{vehicleCopy.accountBalance|currency}}</p>
		</div>
		
	</div>
	<modal :show="isEditing" @closed="isEditing=false">
		<VueForm :fields="fields" :action="url" method="put" 
			@submitted="updatedVehicle">
			
		</VueForm>
	</modal>
	</card>
</template>

<script>
import Confirmation from "../Confirmation";

import VueForm from "../forms/VueForm";

import structure from "./structure";


	export default
	{
		components:{VueForm},

		props:{
			vehicle:{},readonly:{default:true}
		},
		data()
		{
			return {
				vehicleCopy:this.vehicle,
				isEditing:false,
				fields: (new structure()).binded(this.vehicle)
			}
		},
		

		methods:{
			destroy(){
				Confirmation.confirm("Stop!","The vehicle and its related data will be deleted permanently!")
				.then(confirmed=>axios.delete(this.url).then(removed=>{
					flash("Vehcile was removed successfully");
					events.$emit("vehicle:deleted");
				}));
			},
			updatedVehicle(vehicle){
				this.vehicleCopy=vehicle;
				this.isEditing=false;
				flash("Vehicle was updated successfully");
			}
		},
		computed:{
			url()
			{
				return "/vehicles/"+this.vehicleCopy.vehicle_id;
			}
		}
	}
</script>
