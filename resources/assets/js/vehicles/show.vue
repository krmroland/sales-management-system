<template>
	<div>
		<vehicle :vehicle="vehicle"></vehicle>	
		<card>
			<div class="text-center text-primary d-flex justify-content-around align-items-center px-4">
				
				<h4><i class="fa fa-handshake-o"></i> Recent Payments</h4>
				<h5><span class="small">Total Ammount Paid</span> {{totalPayments|currency}}</h5>
			</div>
			<table class="table table-bordered table-hover table-striped table-sm">
				<thead>
					<tr>
						<th>Date</th>
						<th>Previous Balance</th>
						<th>Parking Fees</th>
						<th>Paid</th>
						<th>Closing Balance</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="payment in vehicle.payments">
						<td>{{payment.date}}</td>
						<td>{{payment.balanceBefore|currency}}</td>
						<td>{{payment.fee|currency}}</td>
						<td>{{payment.paid|currency}}</td>
						<td>{{payment.balanceAfter|currency}}</td>
					</tr>
				</tbody>
			</table>
		</card>
	</div>
</template>

<script>
import Vehicle from "./vehicle";

	export default
	{
		props:["vehicle","totalPayments"],
		components:{Vehicle},

		data(){
			return {
			
			}
		}
	}
</script>
