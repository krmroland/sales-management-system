
<template>
	<card>
		<h4 class="text-center text-info">One Time Collected Incomes ({{date|capitalize}}) </h4>
		<div class="d-flex justify-content-between align-items-center text-center box-1">

		    <i class="fa fa-money fa-3x text-primary"></i>
			<div>
				<h6 class="text-muted">Total Cash Collected</h6>
				<h5 class="text-primary">{{data.cashCollected|currency}}/=</h5>
			</div>
			<i class="fa fa-credit-card-alt fa-3x text-primary"></i>
			
		</div>

		<div class="box-1" v-for="(items,date) in data.items">
			<u class=" text-primary"><h5 class="text-center"><i class="fa fa-calendar"></i> {{date}} </h5></u>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th>Category</th>
						<th>Cash Collected</th>
						<th>Profit Earned</th>
					
					
					</tr>
				</thead>
				<tbody>
				<tr v-for="item in items">
					<td>{{item.category|capitalize}}</td>
					<td>{{item.cashCollected|currency}}</td>
					<td>{{item.profit|currency}}</td>

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

