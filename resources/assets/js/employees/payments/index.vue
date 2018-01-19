<template>
	<card>
		<div v-if="!hasPayments" class="alert alert-info text-center h5">
			No Payment Transactions are recorded for {{employee.name|title}}
		</div>
		<card v-else>
			<h4 slot="title" class="text-info">The Recent Payment Transactions</h4>
			<table class="table table-bordered table-striped table-hover" >
				<thead>
					<tr class="bg-primary text-white">
						<th class="text-center">Date</th>
						<th class="text-center">Payment Type</th>
						<th class="text-center">Paid Ammount</th>
						<th class="text-center">Payment Interval</th>
						<th class="text-center">Description</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="payment in employee.payments">
						<td>{{payment.date}}</td>
						<td>({{payment.type}})</td>
						<td>{{payment.ammount|currency}}</td>
						<td>{{payment.interval}}</td>
						<td>{{payment.description}}</td>


					</tr>
				</tbody>
			</table>
		</card>	
	</card>	
</template>

<script>
	export default
	{
		props:["employee"],

		data(){
			return {

			}
		},
		methods:{

		},
		computed:{
			hasPayments()
			{
				return  !_.isEmpty(this.employee.payments);
			}
		}
	}
</script>
