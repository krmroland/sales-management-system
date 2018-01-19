
<template>
	<card>
		<h4 class="text-center text-info ">Expenditure Summary({{date|capitalize}}) </h4>
		<div class="d-flex justify-content-between align-items-center text-center box-1">

		    <i class="fa fa-money fa-3x text-primary"></i>
			<div>
				<h6 class="text-muted">Total Expenditure</h6>
				<h5 class="text-primary">{{data.expenditure|currency}}/=</h5>
			</div>
			<i class="fa fa-credit-card-alt fa-3x text-primary"></i>
			
		</div>

		<div class="box-1" v-for="(items,date) in data.items">
			<u class=" text-primary"><h5 class="text-center"><i class="fa fa-calendar"></i> {{date}} </h5></u>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th>Expenditure Type</th>
						<th>Expenditure Category</th>
						<th>Total Ammount</th>
					</tr>
				</thead>
				<tbody>
				<tr v-for="item in items">
					<td>{{item.type|capitalize}}</td>
					<td>{{item.category|capitalize}}</td>
					<td>{{item.expenditure|currency}} /=</td>

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

