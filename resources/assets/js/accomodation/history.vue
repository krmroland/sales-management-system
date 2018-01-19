<template>
	<card>
		<h4 class="text-center tetx-primary">
			<i class="fa fa-history"></i>
			Room Payment History
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th>Date</th>
						<th>Room Name</th>
						<th>Room Number</th>
						<th>Room Size</th>
						
						<th>Duration (Interval)</th>
						<th>Ammount</th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
					<tr v-for="record in entries">
						<td>{{record.date}}</td>
						<td> <i class="fa fa-university" ></i>{{record.name|title}}</td>
						<td>{{record.number}}</td>
						<td>{{record.size|title}}</td>
						<td>{{record.rate}}</td>
						<td>{{record.ammount|currency}}</td>
						<td class="m-0 p-0 text-center">
							<button class="btn btn-outline-danger btn-sm btn-block" @click="destroy(record)">
								<i class="fa fa-trash-o"></i>	
							</button>
						</td>
					
			
			
					</tr>
				</tbody>
			</table>
		</div>
	</card>	
</template>

<script>
import Confirmation from "../Confirmation";

	export default
	{
		created()
		{
			this.fetchHistory();
		},

		data(){
			return {
				entries:[],
			}
		},
		methods:{
			fetchHistory()
			{
				axios.get("/accomodation?fullHistory=true").then(({data})=>this.entries=data);
			},
			destroy(record)
			{
				Confirmation.confirm("Stop!","The record will be deleted permanetly").then(confirmed=>{
					axios.delete(this.getUrl(record)).then(response=>{
						this.fetchHistory();
						flash("Record was removed successfully");
					})
				});

			
			},
			getUrl(record)
			{
				return "rooms/"+record.room_id+"/payments/"+record.payment_id;
			}
		}
	}
</script>
