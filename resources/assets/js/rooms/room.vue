<template>
	<card>
		<div class="box">
			<div class="d-flex align-items-center justify-content-between text-center mx-1">
				<div>
					<i class="fa fa-university fa-5x"></i>
				</div>
				<div>
					<p class="h4 text-info">Room Number</p>
					<p class="h5">{{room.number}}</p>
				</div>
				<div>
					<p class="h4 text-info">Name</p>
					<p class="h5">{{room.name|title}}</p>
				</div>
				<div>
					<p class="h4 text-info">Type</p>
					<p class="h5">{{room.size|title}}</p>
				</div>
				<div v-if="!readonly">
					<div class="btn-group">
						<a class="btn btn-outline-info" href=""  role="button" @click.prevent="addingRate=true">
							<i class="fa fa-plus"></i>
							Add a Rate
						</a>
						<!-- <a class="btn btn-outline-success" href="#" role="button">
							<i class="fa fa-edit"></i>
							Edit
						</a> -->
						<a class="btn btn-outline-danger" href="#" role="button" @click="destroy">
							<i class="fa fa-trash"></i>
							Delete
						</a>
					</div>
				</div>

			</div>
			<rates :room="room" :readonly="readonly"></rates>	
			<modal :show="addingRate" @closed="addingRate=false">
				<h4 slot="header">Add A new Rate to {{room.name|title}} ({{room.number}})</h4>
				<AddRate :room="room" @rate:added="rateAdded">

				</AddRate>
			</modal>
		</div>
	</card>
</template>

<script>
	import AddRate from "./rates/create";
	import Rates from "./rates/index";
	import Confirmation from "../Confirmation";
	export default
	{
		components:{AddRate,Rates},

		props:{
			room:{},
			readonly:{
				default:true,
			}
		},


		data(){
			return {
				addingRate:false,
			}
		},
		methods:
		{
			rateAdded(room)
			{
				this.addingRate=false;
				this.$set(this.room,"rates",room.rates);
			},
			destroy()
			{
				Confirmation.confirm("Be Informed","The room and its all related data will be deleted")
				.then(confirmed=>{
					axios.delete("/rooms/"+this.room.id).then(deleted=>location.reload());
				});
			}
		}
	}
</script>
