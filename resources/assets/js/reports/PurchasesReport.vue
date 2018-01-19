<template>
	<card>
		<h4 class="text-center text-info ">Purchases Summary ({{date|capitalize}})</h4>
		<div class="d-flex justify-content-between align-items-center text-center box-1">
			<i class="fa fa-money fa-3x text-primary"></i>
			<div>
				<h6 class="text-muted">Total Cash Purchased</h6>
				<h5 class="text-primary">{{data.cashPurchased|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Cash Spent</h6>
				<h5 class="text-primary">{{data.expenditure|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Debt On Purchase</h6>
				<h5 class="text-primary">{{data.debt|currency}}/=</h5>
			</div>
			<div>
				<h6 class="text-muted">Total Profit Expected</h6>
				<h5 class="text-primary">{{data.profitExpected|currency}}/=</h5>
			</div>
			<i class="fa fa-shopping-basket fa-3x text-primary"></i>
		</div>

		<div class="box-1" v-for="(items,date) in data.items">
			<u class=" text-primary"><h5 class="text-center"><i class="fa fa-calendar"></i> {{date}} </h5></u>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Items Purchased</th>
						<th>Cash Purchased</th>
						<th>Cash Expected</th>
						<th>Profit Expected </th>
						<th>Debt(s)</th>
					</tr>
				</thead>
				<tbody>
				<tr v-for="item in items">
						<td>{{item.name|title}}</td>
						<td>{{item.bundle.name|title}}</td>
						<td>{{item.cashPurchased|currency}} /=</td>
						<td>{{item.cashExpected|currency}} /=</td>
						<td>{{item.profitExpected|currency}} /=</td>
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

