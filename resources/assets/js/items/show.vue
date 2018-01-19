<template>
	<div>
		<item :item="item"></item>
		<card>
			<div class="table-responsive">
				<h4 class="text-center text-info">Recent Transactions</h4>
				<table class="table table-bordered table-striped table-sm table-hover">
					<thead>
						<tr>
							<td>Date</td>
							<td>Type</td>
							<th>Opening</th>
							<th>Description</th>
							<th>Closing</th>
							<th colspan="2">Prices</th>
						</tr>
					</thead>
					<tbody >
						<template v-for="detail in item.transaction_details">
							<component :is="detail.transaction.type" :detail="detail" :unitName="unitName">

							</component>
						</template>
					</tbody>

					
				</table>
			</div>

		</card>
	</div>
</template>

<script>
	import Item from "./Item";

	import sale from "./transactions/soldRow";

	import purchase from "./transactions/purchaseRow";

	export default
	{
		components:{Item,sale,purchase},

		props:["item"],

		data(){
			return {

			}
		},
		methods:{

			getDescription(detail)
			{
				return (detail.transaction.type=="sale")?'sold':'purchased';
			},

			getCurrentPrice(detail)
			{
				if (this.getDescription) {}
			},
		getTransactedPrice(detail)
		{

		}
	},
	computed:{
		unitName()
		{
			return this.item.bundle.unitPlural;
		}
	}
}
</script>
