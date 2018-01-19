<template>
	<card>
		<h4 class="text-center text-info ">Sales Summary ({{date|capitalize}})</h4>
		<div class="d-flex justify-content-between align-items-center text-center box-1">
			<i class="fa fa-balance-scale fa-3x text-primary"></i>
			<div>
				<h6 class="text-muted">Total Cash Purchased</h6>
				<h5 class="text-primary">{{data.cashPurchased|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Cash Sold</h6>
				<h5 class="text-primary">{{data.cashSold|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Debt On Sales</h6>
				<h5 class="text-primary">{{data.debt|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Profit Earned</h6>
				<h5 class="text-primary">{{data.profit|currency}}/=</h5>
			</div>
			<i class="fa fa-handshake-o fa-3x text-primary"></i>
			
		</div>
		<div v-for="(items,date) in data.items" class="box-1">
			<u class=" text-primary"><h5 class="text-center"><i class="fa fa-calendar"></i> {{date}} </h5></u>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Items Sold</th>
						<th>Cash Purchased</th>
						<th>Cash Sold</th>
						<th>Profit</th>
						<th>Debt(s)</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in items">
						<td>{{item.name|title}}</td>
						<td>{{item.bundle.name|title}}</td>
						<td>{{item.cashPurchased|currency}}</td>
						<td>{{item.cashSold|currency}}</td>
						<td>{{item.profit|currency}}</td>
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
