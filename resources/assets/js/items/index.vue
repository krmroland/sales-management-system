<template>
	<div>
		<card>
			<h4 slot="title" class="text-info">Items Section</h4>
			<div class="d-flex justify-content-between align-items-center mb-4 box">
				<i class="fa fa-balance-scale fa-5x text-primary"></i>
				<switchery :buttons="buttons" @switched="page=$event"></switchery>
				<div class="btn-group">
					<button class="btn btn-outline-primary" @click="addingItems=true">
						<i class="fa fa-plus"></i>
						Register A Item
					</button>	
					<a class="btn btn-outline-primary"  href="/transactions?type=purchase">
						<i class="fa fa-shopping-basket"></i>
						Purchas Items
					</a>	
					<a class="btn btn-outline-primary"  href="/transactions?type=sale">
						<i class="fa fa-shopping-cart"></i>
						Sale Items
					</a>	
				</div>
				<i class="fa fa-shopping-basket fa-5x text-primary"></i>
			</div>
		</card>
			<item-summary></item-summary>
		<zoom>
			<component :is="page"></component>
		</zoom>
		<modal :show="addingItems" @closed="addingItems=false">
			<h4 slot="header">Add A new Item to the system</h4>
			<new-item @item:created="addingItems=false"></new-item>
		</modal>
	</div>
</template>

<script>
	import switchery from "../switch/switchery";

	import ItemSummary from "./summary";
	
	import allItems from "./all";

	import NewItem from "./create";

	import History from "../transactions/history";


	//import statistics from "./statistics";

	export default{
		components:{ItemSummary,switchery,allItems,NewItem,History},
		data(){
			return {
				
				addingItems:false,
				page:'allItems',
				buttons:[
				{
					icon:"fa fa-balance-scale",
					text:"allItems",
					key:"items",
					isActive:true,

				},
				{
					icon:"fa fa-history",
					text:"Transaction History",
					key:"history",

				},
				// {
				// 	icon:"fa fa-pie-chart",
				// 	text:"Item Satistics",
				// 	key:"statistics",

				// }

				]
			}
		}

	}

</script>