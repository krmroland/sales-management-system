<template>

	<card>
		<slot></slot>	
		<div class="d-flex align-items-center justify-content-between text-center text-muted box">
			<div>
				<p class="h5">Total Items</p>
				<p class="h3 text-info">{{summary.total_count|currency}}</p>
			</div>
			<div>
				<p class="h5">Invetory Before Sale</p>
				<p class="h3 text-info">{{summary.beforeSale|currency}}</p>
			</div>
			<div>
				<p class="h5">Invetory After Sale</p>
				<p class="h3 text-info">{{summary.afterSale|currency}}</p>
			</div>
			<div>
				<p class="h5">Expect Profit</p>
				<p class="h3 text-info">{{expectedProfit|currency}}</p>
			</div>
		</div>

	</card>

</template>
<script>
	
	export default
	{
		data()
		{
			return {
				summary:{},
				addingItems:false
			}
		},

		mounted()
		{
			this.fetchSummary();
			events.$on("item:updated",item=>this.fetchSummary());
			events.$on("item:deleted",item=>this.fetchSummary());
			events.$on("item:created",item=>{
				this.fetchSummary();
				this.addingItems=false;
			});
		},

		methods:{
			fetchSummary()
			{
				axios.get("/items/summary").then(({data})=>this.summary=data);
			}
		},

		computed:{
			expectedProfit()
			{
				return Number(this.summary.afterSale-this.summary.beforeSale);
			}
		}

	}
</script>