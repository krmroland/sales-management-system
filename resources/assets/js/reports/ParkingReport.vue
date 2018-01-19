<template>
	<card>
		<h4 class="text-center text-info ">Parking Collections Summary ({{date|capitalize}})</h4>
		<div class="d-flex justify-content-between align-items-center text-center box-1">
			<i class="fa fa-motorcycle fa-3x text-primary"></i>
			<div>
			<h6 class="text-muted">Total Cash Expected</h6>
				<h5 class="text-primary">{{data.cashExpected|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Cash Collected</h6>
				<h5 class="text-primary">{{data.cashCollected|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Profit Earned</h6>
				<h5 class="text-primary">{{data.cashExpected|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Debts on Parking</h6>
				<h5 class="text-primary">{{data.debt|currency}}/=</h5>
			</div>
			<i class="fa fa-bus fa-3x text-primary"></i>
			
		</div>
		<div v-for="(items,date) in data.items" class="box-1">
			<u class=" text-primary"><h5 class="text-center"><i class="fa fa-calendar"></i> {{date}} </h5></u>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Category</th>
						<th>Vehicles Parked</th>
						<th>Cash Expected</th>
						<th>Cash Collected</th>
						<th>Profit</th>
						<th>Debt</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in items">
						<th><i class="fa" :class="'fa-'+item.icon"></i></th>
						<td>{{item.category|title}}</td>
						<td>{{item.vehicle_count|title}}</td>
						<td>{{item.cashExpected|currency}}</td>
						<td>{{item.cashCollected|currency}}</td>
						<td>{{item.cashCollected|currency}}</td>
						<td>{{item.debt|currency}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</card>
</template>

<script>
	export default
	{
		props:["data","date"],

		data(){
			return {

			}
		}
	}
</script>
