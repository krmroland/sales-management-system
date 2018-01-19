<template>
	<div>
		<div class="table-responsive" v-if="room.rates && notEmpty">
			<div class="bg-primary text-white text-center p-1 mt-1 h4"> Room Rates</div>
			<table class="table-bordered table table-striped table-sm">
				<thead>
					<tr>
						<th>Type</th>
						<th class="p-0 text-center" 
						v-for="(ammount,name) in room.rates">
						{{name|title}}
						<div class="btn-group p-0" v-if="!readonly">
							<button class="btn btn-sm btn-outline-info" title="Edit this rate"
							@click="rateToEdit={name,ammount}">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-sm btn-outline-danger" title="Delete this rate"
						@click="destroy(name)">
						<i class="fa fa-trash"></i>
						</button>
					</div>
			</th>
			
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Ammount</th>
			<td class="text-center" v-for="ammount in room.rates">{{ammount|currency}}</td>
		</tr>
	</tbody>
</table>
</div>
<div v-else>
	<div class="bg-warning text-white text-center p-1 mt-1 h4">
		No rates set yet.. Please do!
	</div>
</div>
<modal :show="rateToEdit" @closed="rateToEdit=false">
	<h4 slot="header">Edit {{room.name}}( {{rateToEdit|title}}) charges</h4>
	<edit-rate :room="room" :rate="rateToEdit" @rate:updated="room.rates=$event.rates; rateToEdit=false">
		
	</edit-rate>
</modal>	
</div>
</template>

<script>
	import Confirmation from "../../Confirmation";
	import EditRate from "./edit";
	export default
	{
		props:["room","readonly"],
		components:{EditRate},

		data(){
			return {
				rateToEdit:false,
			}
		},
		methods:{
			destroy(rate)
			{
				Confirmation.confirm("Be Informed","We will Remove The Rate completely").then(()=>{
					axios.delete("/rooms/"+this.room.id+"/rates/"+rate).then(({data})=>{
						this.room.rates=data.rates;
					})
				});
			},
			makeEditDate()
			{

			}
		},
		computed:{
			/**
			 * determine if the rates of the room are empty
			 *
			 * @return     {boolean}  
			 */
			 notEmpty()
			 {
			 	return _.size(this.room.rates);
			 }
			}
		}
	</script>
