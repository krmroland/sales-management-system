<template>
	<card>
		<h4 class="text-center tetx-primary">
			<i class="fa fa-history"></i>
			Recently Captured History
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th>Date</th>
						<th>Vehicle Type</th>
						<th>Number Plate</th>
						<th>Owner</th>
						<th>Parking Fee</th>
						<th>Opening Bal</th>
						<th>Paid</th>
						<th>Closing Bal</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="record in entries">
						<td>{{record.date}}</td>
						<td>
							<i class="fa" :class="'fa-'+record.icon"></i>
							{{record.category|title}}
						</td>
						<td>{{record.numberPlate}}</td>
						<td>{{record.owner}}</td>
			
						<td>{{record.fee|currency}}</td>
						<td>{{record.balanceBefore|currency}}</td>
			
						<td>{{record.paid|currency}}</td>
						<td>{{record.balanceAfter|currency}}</td>
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
				axios.get("/parking?fullHistory=true").then(({data})=>this.entries=data);
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
				return "vehicle/"+record.vehicle_id+"/payments/"+record.id;
			}
		}
	}
</script>
