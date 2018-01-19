<template>
	<card>
		<h4 class="text-center text-info">Generalized Summary ({{date|capitalize}}) </h4>
		<table class="table table-bordered table-striped table-sm">
			<tbody>
				<tr v-for="(property,name) in properties">
					<th>{{property}}</th>
						<template v-for="(data,report) in reports">
							<th v-if="property=='Item'">{{report|title}}</th>
							<td v-else> {{getValue(data,name)}}</td>
						</template>
						<th>{{getTotal(name)}}</th>
				</tr>
			</tbody>
		</table>
	</card>
</template>

<script>
	export default
	{
		props:["reports","date"],

		data(){
			return {

				properties:{
					label:"Item",
					cashCollected:"Cash Collected",
					expenditure:"Cash Spent",
					profit:"Profit Earned",

				}
				
			}
		},
		methods:{
			getValue(data,name)
			{
				let value=data[name];
				return value?this.numberFormat(value):"--";
			},
			getTotal(name)
			{

				if (name=="label") {
					return "Totals";
				}

				let total= _.values(this.reports).reduce((prev,report)=>{
						
						if (report.hasOwnProperty(name)) {
							return prev+Number(report[name]);
						}
						return prev;
						
				},0);

				return this.numberFormat(total);
			}
		}

	}
</script>
